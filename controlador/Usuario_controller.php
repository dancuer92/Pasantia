<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../modelo/facade/Facade.php';

$opcion = $_POST['opcion'];

$Usuario_controller = new Usuario_controller();

if ($opcion == "registrar_usuario") {
    $codigo = (int) $_POST['codigo'];
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
}

if ($opcion == "buscar") {
    $consultaBusqueda = $_POST['valorBusqueda'];
    $Usuario_controller->buscar_usuario($consultaBusqueda);
}

if ($opcion == "editar") {
    $clave = $_POST['clave'];
    $valor = $_POST['valor'];
    $cod = $_POST['codigo'];
    $Usuario_controller->editar_usuario($clave, $valor, $cod);
}

if ($opcion == 'cargar') {
    $codigo = $_SESSION['codigo'];
    $Usuario_controller->cargar_usuario($codigo);
}

if ($opcion == 'cambiar') {
    $newPass = $_POST['passNew'];
    $prevPass = $_POST['passAnt'];
    $cod = $_POST['codigo'];
    $Usuario_controller->cambiar_password_usuario($newPass, $prevPass, $cod);
}

if ($opcion == 'autocompletar') {
    $cod = $_POST['codigo'];
    $Usuario_controller->autocompletar_usuario($cod);
}

class Usuario_controller {

    private $facade;

    public function __construct() {
        $this->facade = new Facade();
    }

    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        $msj = $this->facade->registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        echo $msj;
    }

    public function buscar_usuario($consultaBusqueda) {
        $mensaje = '';
        $usuarios = $this->facade->buscar_usuario($consultaBusqueda);
        if (is_null($usuarios)) {
            $mensaje = '<p>No hay ningún usuario con ese criterio de búsqueda</p>';
        } else {
            foreach ($usuarios as $user) {
                $usuario = json_decode($user, true);

                $mensaje.='<div class="col s12 m7 l4">            
                <div class="card">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Código: ' . $usuario['codigo_usuario'] . '<i class="material-icons right">more_vert</i></span>
                        <p>' . $usuario['nombre_usuario'] . ' ' . $usuario['apellido_usuario'] . '</p>
                        <p>' . $usuario['cargo_usuario'] . '</p>
                        <p>Área: ' . $usuario['departamento_usuario'] . '</p>                        
                        <p>Telefono: ' . $usuario['telefono_usuario'] . '</p>
                        <p>Correo: ' . $usuario['correo_usuario'] . '</p>';
                if ($usuario["estado_usuario"] == "activo") {
                    $mensaje.='<p>Tipo de Usuario: ' . $usuario['tipo_usuario'] . ' Activo</p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">¿Desea desactivar el usuario?<i class="material-icons right">close</i></span>
                            <p><a id="act/desac" class="waves-effect waves-red btn-flat hoverable" onclick="estadoUsuario(' . $usuario['codigo_usuario'] . ',' . 0 . ')">Aceptar</a></p>                    
                        </div>                 
                    </div>               
                </div>';
                } else {
                    $mensaje.='<p>Tipo de Usuario: ' . $usuario['tipo_usuario'] . ' Inactivo</p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">¿Desea activar el usuario?<i class="material-icons right">close</i></span>
                            <p><a id="act/desac" class="waves-effect waves-red btn-flat hoverable" onclick="estadoUsuario(' . $usuario['codigo_usuario'] . ',' . 1 . ')">Aceptar</a></p>                    
                        </div>                 
                    </div> 
                </div>';
                }
            }
        }
        echo $mensaje;
    }

    public function editar_usuario($clave, $valor, $cod) {
        $this->facade->editar_usuario($clave, $valor, $cod);
    }

    public function cargar_usuario($codigo) {
        $json = $this->facade->cargar_usuario($codigo);
        $mensaje = '';
        if (!is_null($json)) {
            $array = json_decode($json, true);
            $mensaje.='<h5> <strong>Código de usuario: </strong>' . $array['codigo_usuario'] . '</h5>
                        <h5> <strong>Nombre: </strong> <input id="nombre_usuario" disabled value="' . $array['nombre_usuario'] . '" onblur="edit(&nombre_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Apellido: </strong><input id="apellido_usuario" disabled value="' . $array['apellido_usuario'] . '" onblur="edit(&apellido_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Cédula: </strong><input id="cedula_usuario" disabled value="' . $array['cedula_usuario'] . '" onblur="edit(&cedula_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Correo: </strong><input id="correo_usuario" disabled value="' . $array['correo_usuario'] . '" onblur="edit(&correo_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Cargo: </strong><input id="cargo_usuario" disabled value="' . $array['cargo_usuario'] . '" onblur="edit(&cargo_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Departamento o área de trabajo:</strong> <input id="departamento_usuario" disabled value=" ' . $array['departamento_usuario'] . '" onblur="edit(&departamento_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Teléfono:</strong> <input id="telefono_usuario" disabled value="' . $array['telefono_usuario'] . '" onblur="edit(&telefono_usuario&,&' . $array['codigo_usuario'] . '&)"></h5>
                        <h5> <strong>Tipo de usuario en el sistema: </strong>' . $array['tipo_usuario'] . '</h5>';
        }

        $mensaje2 = str_replace("&", "'", $mensaje);
        echo $mensaje2;
    }

    public function cambiar_password_usuario($newPass, $prevPass, $cod) {
        $msj = $this->facade->cambiar_password_usuario($newPass, $prevPass, $cod);
        echo $msj;
    }

    public function autocompletar_usuario($codigo) {
        $mensaje = '';
        $usuarios = $this->facade->buscar_usuario($codigo);
        if (is_null($usuarios)) {
            $mensaje = '<p>No hay ningún usuario con ese criterio de búsqueda</p>';
        } else {
            foreach ($usuarios as $user) {
                $array = json_decode($user, true);
                
                $mensaje = '<div class="card" onclick="setU(&' . $array["codigo_usuario"] . '&)">
                    <div class="card-content">
                        <p><strong>Código: </strong>' . $array["codigo_usuario"] . '</p>
                        <p><strong>Nombre: </strong>' . $array["nombre_usuario"] . '</p>
                        <p><strong>Apellido: </strong>' . $array["apellido_usuario"] . '</p>
                        <p><strong>Cargo: </strong>' . $array["cargo_usuario"] . '</p>                        
                        <p><strong>Área: </strong>' . $array["departamento_usuario"] . '</p>
                        <p><strong>Telefono: </strong>' . $array["telefono_usuario"] . '</p>              
                        <p><strong>Correo: </strong>' . $array["correo_usuario"] . '</p>
                        <p><strong>Tipo de usuario: </strong>' . $array["tipo_usuario"] . '</p></div></div>';
                break;
            }
        }
        
        $mensaje = str_replace("&", "'", $mensaje);
        echo $mensaje;
    }

}
?>


