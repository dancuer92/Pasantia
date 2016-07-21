<?php

//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Controlador de usuario que requiere la clase Facade y permite entre otras cosas registrar, buscar, cargar, cambiar, 
 * asignar y desasignar un usuario
 */

//identificador de sesión activa
session_start();
require_once '../modelo/facade/Facade.php';

//Opción recibida desde la vista
$opcion = $_POST['opcion'];

$Usuario_controller = new Usuario_controller();

//Selección de la función de acuerdo a la opción
switch ($opcion) {
    case "registrar_usuario":
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['numDoc'];
        $password = $_POST['pass'];
        $correo = $_POST['correo'];
        $cargo = $_POST['cargo'];
        $departamento = $_POST['departamento'];
        $telefono = $_POST['telefono'];
        $rol_usuario = (int) $_POST['rol'];
        $estado = (int) $_POST['estado'];
        $Usuario_controller->registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        break;
    case "buscar":
        $consultaBusqueda = $_POST['valorBusqueda'];
        $Usuario_controller->buscar_usuario($consultaBusqueda);
        break;
    case "editar":
        $clave = $_POST['clave'];
        $valor = $_POST['valor'];
        $cod = $_POST['codigo'];
        $Usuario_controller->editar_usuario($clave, $valor, $cod);
        break;
    case "cargar":
        $codigo = $_SESSION['codigo'];
        $Usuario_controller->cargar_usuario($codigo);
        break;
    case "cambiar":
        $newPass = $_POST['passNew'];
        $prevPass = $_POST['passAnt'];
        $cod = $_POST['codigo'];
        $Usuario_controller->cambiar_password_usuario($newPass, $prevPass, $cod);
        break;
    case "asignar":
        $cod = $_POST['codigo'];
        $Usuario_controller->autocompletar_usuario($cod, 'asignar', '');
        break;
    case "desasignar":
        $cod = $_POST['codigo'];
        $formato = $_POST['formato'];
        $Usuario_controller->autocompletar_usuario($cod, 'desasignar', $formato);
        break;
}

/**
 * Clase usuario controller
 */
class Usuario_controller {

    private $facade;

    /**
     * Constructor vacío
     */
    public function __construct() {
        $this->facade = new Facade();
    }

    /**
     * Método que permite registrar un usuario en el sistema. entre sus datos se encuentran, código, nombre,apellido,cedula,password,correo, 
     * cargo, departamento, telefono, tipo de usuario y estado.
     * @param type $codigo
     * @param type $nombre
     * @param type $apellido
     * @param type $cedula
     * @param type $password
     * @param type $correo
     * @param type $cargo
     * @param type $departamento
     * @param type $telefono
     * @param type $rol_usuario
     * @param type $estado
     */
    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        //retorna un mensaje de respuesta d ela operación
        $msj = $this->facade->registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        echo $msj;
    }

    /**
     * Permite realizar una búsqueda filtrada en la base de datos de un usuario.
     * recibe el nombre o el código del usuario.
     * @param type $consultaBusqueda
     */
    public function buscar_usuario($consultaBusqueda) {
        $mensaje = '';
        //se obtienen el usuario o los usuarios con posibles coicidencias de la base de datos en un JSON
        $usuarios = $this->facade->buscar_usuario($consultaBusqueda, '', '');
        //se valida si existen usuarios
        if (is_null($usuarios)) {
            $mensaje = '<p>No hay ningún usuario con ese criterio de búsqueda</p>';
        } else {
            //se recorre todo el JSON de usuarios
            foreach ($usuarios as $user) {
                //Se decodifica el JSON en un arreglo
                $usuario = json_decode($user, true);

                //Se clasifican y se ordenan los usuarios en unas tarjetas de identificación html
                $mensaje.='<div class="col s12 m7 l4">            
                <div class="card">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Código: ' . $usuario['codigo_usuario'] . '<i class="material-icons right">more_vert</i></span>
                        <p>' . $usuario['nombre_usuario'] . ' ' . $usuario['apellido_usuario'] . '</p>
                        <p>' . $usuario['cargo_usuario'] . '</p>
                        <p>Área: ' . $usuario['departamento_usuario'] . '</p>                        
                        <p>Telefono: ' . $usuario['telefono_usuario'] . '</p>
                        <p>Correo: ' . $usuario['correo_usuario'] . '</p>
                        <p>Caducidad contraseña: ' . $usuario['caducidad_usuario'] . '</p>';
                if ($usuario["estado_usuario"] == "activo") {
                    $mensaje.='<p>Tipo de Usuario: ' . $usuario['tipo_usuario'] . ' Activo</p>';
                    $mensaje.=$this->btnCambiar($usuario['codigo_usuario']);
                    $mensaje.='</div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">¿Desea desactivar el usuario?<i class="material-icons right">close</i></span>
                            <p><a id="act/desac" class="waves-effect waves-red btn-flat hoverable" onclick="estadoUsuario(&' . $usuario['codigo_usuario'] . '&,' . 0 . ')">Aceptar</a></p>                    
                        </div>                 
                    </div>               
                </div>';
                } else {
                    $mensaje.='<p>Tipo de Usuario: ' . $usuario['tipo_usuario'] . ' Inactivo</p>';
                    $mensaje.=$this->btnCambiar($usuario['codigo_usuario']);
                    $mensaje.='</div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">¿Desea activar el usuario?<i class="material-icons right">close</i></span>
                            <p><a id="act/desac" class="waves-effect waves-red btn-flat hoverable" onclick="estadoUsuario(&' . $usuario['codigo_usuario'] . '&,' . 1 . ')">Aceptar</a></p>                    
                        </div>                 
                    </div> 
                </div>';
                }
            }
        }
        $mensaje = str_replace("&", "'", $mensaje);
        echo $mensaje;
    }

    /**
     * Mpetodo que permite agregar el botón de cambio de contraseña desde un usuario administrador de contraseña.
     * Recibe el código del usuario.
     * retorna un string con el código html.
     * @param type $cod
     * @return type
     */
    private function btnCambiar($cod) {
        $mensaje = '';
        if ($cod !== $_SESSION['codigo']) {
            $mensaje.='<a onclick="cambiarPassAdmin(&' . $cod . '&);" class="btn-floating red waves-effect waves-red hoverable tooltipped" data-position="right" data-delay="50" data-tooltip="Cambiar contraseña"><i class="material-icons right">lock_open</i></a>';
        }
        return $mensaje = str_replace("&", "'", $mensaje);
    }

    /**
     * Método para editar la contraseña de un usuario desde el lado del administrador
     * La clave corresponde al campo de la contraseña, el valor será la nueva contraseña y el código es el usuario.
     * @param type $clave
     * @param type $valor
     * @param type $cod
     */
    public function editar_usuario($clave, $valor, $cod) {
        //método que edita la contraseña en la base de datos.
        $this->facade->editar_usuario($clave, $valor, $cod);
    }

    /**
     * Método que carga el perfil de cada usuario una vez inicia sesión.
     * @param type $codigo
     */
    public function cargar_usuario($codigo) {
        //se consulta el usuario en la base de datos.
        $json = $this->facade->cargar_usuario($codigo);
        $mensaje = '';
        if (!is_null($json)) {
            //Se transforma los datos obtenidos del JSON al código html
            $array = json_decode($json, true);
            $mensaje.='<h5> <strong>Código de usuario: </strong>' . $array['codigo_usuario'] . '</h5>
                        <h5> <strong>Nombre: </strong> <input id="nombre_usuario" pattern="[^a-zA-ZÁaÉéÍíÓóÚÜúü\s]{1,30}" title="Digitar sólo letras" disabled value="' . $array['nombre_usuario'] . '" onblur="edit(&nombre_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Apellido: </strong><input id="apellido_usuario" pattern="[^a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,30}" title="Digitar sólo letras" disabled value="' . $array['apellido_usuario'] . '" onblur="edit(&apellido_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Cédula: </strong><input id="cedula_usuario" pattern="[^0-9]{1,15}" title="Digitar sólo números" disabled value="' . $array['cedula_usuario'] . '" onblur="edit(&cedula_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Correo: </strong><input id="correo_usuario" pattern="[a-z0-9._+-]+[@][a-z0-9.-]+[\.][a-z]{2,3}$" title="Digitar correo. Ejemplo: ejemplo@cisa.com" disabled value="' . $array['correo_usuario'] . '" onblur="edit(&correo_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Cargo: </strong><input id="cargo_usuario" pattern="[^a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,30}" title="Digitar sólo letras" disabled value="' . $array['cargo_usuario'] . '" onblur="edit(&cargo_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Departamento o área de trabajo: </strong><input id="departamento_usuario" pattern="[^a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,30}" title="Digitar sólo letras" disabled value="' . $array['departamento_usuario'] . '" onblur="edit(&departamento_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Teléfono:</strong> <input id="telefono_usuario" pattern="[^0-9]{1,15}" title="Digitar sólo números" disabled value="' . $array['telefono_usuario'] . '" onblur="edit(&telefono_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Tipo de usuario en el sistema: </strong>' . $array['tipo_usuario'] . '</h5>';
        }

        $mensaje2 = str_replace("&", "'", $mensaje);
        echo $mensaje2;
    }
    
    /**
     * Método que permite cambiar la contraseña de un usuario
     * recibe la contraseña anterior, y la nueva contraseña.
     * @param type $newPass
     * @param type $prevPass
     * @param type $cod
     */
    public function cambiar_password_usuario($newPass, $prevPass, $cod) {
        //Retorna un mensaje de respuesta de la operación.
        $msj = $this->facade->cambiar_password_usuario($newPass, $prevPass, $cod);
        echo $msj;
    }

    /**
     * Método que devuelve una lista para autocompletar un usuario de acuerdo a una búsqueda filtrada
     * para asignar o desasignar un usuario de un formato
     * recibe el código de usuario y la opción si es asignar o desasignar
     * @param type $codigo
     * @param type $opc
     * @param type $formato
     */
    public function autocompletar_usuario($codigo, $opc, $formato) {
        $mensaje = '';
        //Se busca el usuario de acuerdo a un criterio de búsqueda o los usuarios que coincidan con ese criterio.
        $usuarios = $this->facade->buscar_usuario($codigo, $opc, $formato);
        if (is_null($usuarios)) {
            $mensaje = '<p>No hay ningún usuario con ese criterio de búsqueda</p>';
        } else {
            foreach ($usuarios as $user) {
                $array = json_decode($user, true);
                $msj = '';
                //cadena html que depende de la opción de la función
                if ($opc == 'asignar') {
                    $msj = "setA('" . $array['codigo_usuario'] . "')";
                } else {
                    $msj = "setD('" . $array['codigo_usuario'] . "')";
                }

                $mensaje .= '<a class="collection-item black-text" onclick="' . $msj . '"><strong>Código: </strong>'
                        . $array["codigo_usuario"] . '. <strong>Usuario: </strong>' . $array["nombre_usuario"] . ' ' . $array["apellido_usuario"] . '</a>';
            }
        }
        echo $mensaje;
    }

}
?>



