<?php

header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../modelo/dao/Formato_dao.php';
require_once '../modelo/dto/Formato_dto.php';
require_once '../modelo/dao/Usuario_dao.php';
require_once '../modelo/dto/Usuario_dto.php';
require_once '../modelo/dao/Informacion_dao.php';
require_once '../modelo/dto/Informacion_dto.php';

class Negocio {

    private $formato;
    private $usuario;
    private $info;

    public function __construct() {
        $this->formato = new Formato_dao();
        $this->usuario = new Usuario_dao();
        $this->info = new Informacion_dao();
    }

    public function iniciar_sesion($nombre, $password) {
        $usuario = $this->usuario->iniciar_sesion($nombre, $password);
        $mensaje = '';

        if ($usuario->estado_usuario == 'activo') {
            $mensaje = ('location: ../vista/index.php');
        } else {
            $mensaje = ('location: ../index.php');
        }

        $_SESSION['nombre'] = $usuario->nombre_usuario;
        $_SESSION['codigo'] = $usuario->codigo_usuario;
        $_SESSION['estado'] = $usuario->estado_usuario;
        $_SESSION['tipo'] = $usuario->tipo_usuario;
        return $mensaje;
    }

    public function registrar_usuario($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {
        $usuario = $this->usuario->registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        if (!is_null($usuario)) {
            return 'Usuario registrado con éxito';
        } else {
            return 'El usuario no ha sido registrado en el sistema';
        }
    }

    public function buscar_usuario($consultaBusqueda, $opc, $formato) {
        $usuarios = array();
        $usuarios = $this->usuario->buscar($consultaBusqueda, $opc, $formato);
        if (count($usuarios) == 0) {
            $usuarios = null;
        } else {
            return $usuarios;
        }
    }

    public function editar_usuario($clave, $valor, $cod) {
        $mensaje = $this->usuario->editar($clave, $valor, $cod);
        return $mensaje;
    }

    public function cargar_usuario($codigo) {
        $usuario = $this->usuario->cargar($codigo);
        if (!is_null($usuario)) {
            return $usuario->toJSON();
        } else {
            return null;
        }
    }

    public function cambiar_password_usuario($newPass, $prevPass, $cod) {
        $bandera = $this->usuario->cambiar($newPass, $prevPass, $cod);
        $msj = '';
        switch ($bandera) {
            case "0": $msj = 'La contraseña no ha sido actualizada, por favor vuelva a intetarlo';
                break;
            case "1": $msj = 'La contraseña ha sido actualizada';
                break;
            case "2": $msj = 'La contraseña anterior no coincide en la base de datos';
                break;
        }
        return $msj;
    }

    public function cargarFormatos($formato, $tipo, $codigo) {

        $formatos = $this->formato->cargarFormatos($formato, $tipo, $codigo);
        if (!is_null($formatos)) {
            return $formatos;
        } else {
            return null;
        }
    }

    public function guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html) {
        $formato = $this->formato->guardarFormato($codigo, $nombre, $procedimiento, $director, $frecuencia, $tipo, $descripcion, $html);
//        echo $formato;
        if (!is_null($formato)) {
            $this->formato->crearTablaInfo($codigo);
            return 'Formato registrado con éxito';
        } else {
            return 'El formato no ha sido registrado en el sistema porque fue registrado anteriormente';
        }
    }

    public function asignarFormato($usuario, $formato) {
        $bandera = $this->formato->asignarDesasignarFormato($usuario, $formato, 1);
        if ($bandera > 0) {
            return 'El formato ' . $formato . ' ha sido asignado al usuario ' . $usuario;
        } else {
            return 'El formato ha sido asignado anteriormente';
        }
    }

    public function desasignarFormato($usuario, $formato) {
        $bandera = $this->formato->asignarDesasignarFormato($usuario, $formato, 0);
        if ($bandera > 0) {
            return 'El formato ' . $formato . ' ha sido desasignado del usuario ' . $usuario;
        } else {
            return 'El usuario no tiene dicho formato asignado';
        }
    }

    public function visualizarFormato($formato, $tipo, $codigo) {
        $html = '';
        $formatos = $this->formato->cargarFormatos($formato, $tipo, $codigo);

        if (!is_null($formatos)) {
            foreach ($formatos as $formato) {
                $array = json_decode($formato, true);
                $html = $array['codigo_html'];
            }
            return $html;
        } else {
            return null;
        }
    }

    public function modificarFormato($usuario, $formato, $detalle, $observaciones, $html) {
        $msj = '';
        $buscar_modificacion = $this->formato->buscar_modificacion($formato);
//        if (count($buscar_modificacion) <= 1) {
//            echo count($buscar_modificacion);
//        } else {
//            return 0;
//        }
        if ($buscar_modificacion <= 1) {
            echo $buscar_modificacion;
            $flag = $this->formato->modificarFormato($usuario, $formato, $detalle, $observaciones, $html);
            if ($flag > 0) {
                return 'El formato ha sido modificado';
            } else {
                return 'El formato no ha podido ser modificado';
            }
        } else {
            return 'El formato ya fue modificado el día de hoy, pruebe mañana nuevamente.';
        }
    }

    public function historialFormato($formato) {
        return $this->formato->historialFormato($formato);
    }

    public function diligenciarFormato($fechaFormato, $usuario, $formato, $info, $observaciones) {
        $msj = '';
        $info2 = $this->validarInformacion($info);
        if (is_null($info2)) {
            return 'Por favor ingrese los datos correspondientes al formato';
        }
        if ($fechaFormato == '---') {
            date_default_timezone_set('America/Bogota');
            $fechaFormato = date('Y/m/d', time());
//            echo date('Y/m/d H:i:s', time());
        }

        $informacion = $this->info->guardarInfo($fechaFormato, $usuario, $formato, $info2, $observaciones);
        if (!is_null($informacion)) {
            $msj = 'Información registrada con éxito';
        } else {
            $msj = 'La información no ha sido registrada en el sistema';
        }
        return $msj;
    }

    public function validarInformacion($info2) {
        $info = urldecode($info2);
        $arr = explode('&', $info);
        $msj = '';
        foreach ($arr as $var) {
            $arreglo2 = explode('=', $var);
            if ($arreglo2[1] != '') {
                $msj.=$var . ';';
            }
        }
        return $msj;
    }

    public function mostrarRegistrosFormato($formato) {
        $informacion = array();
        $informacion = $this->info->mostrarInfo($formato);
        if (count($informacion) == 0) {
            $informacion = null;
        } else {
            return $informacion;
        }
        return $informacion;
    }

    public function verDatos($formato, $fecha) {
        $json = $this->info->verDatos($formato, $fecha);
        return $json;
    }

    public function modificarRegistroFormato($fechaFormato, $usuario, $formato, $info, $observaciones, $tipo) {

        $f = (int) $this->formato->buscarDiasModificacion($formato);

        date_default_timezone_set('America/Bogota');
        $fechaSistema = date('Y/m/d H:i:s', time());

        $ff = new DateTime($fechaFormato);
        $fs = new DateTime($fechaSistema);

//        echo $ff->format('Y/m/d H:i:s');
//        echo $fs->format('Y/m/d H:i:s');

        $diferencia = $ff->diff($fs);
        $d = $diferencia->format('%d');

        if ($d <= $f) {
            if ($tipo == 'supervisor') {
                echo 'Aqui va el codigo de modificar registro por el supervisor';
            } else {
                $u = $this->info->buscarRegistro($formato, $fechaFormato);
                echo $u,' ',$usuario;
                if ($usuario === $u) {
                    echo 'Aqui va el codigo de modificar registro por el operario';
                }
                else{
                    echo 'No puede modificar el formato porque usted no lo ha diligenciado inicialmente.';
                }
            }
            echo "<br>El formato puede ser modificado";
        } else {
            echo "el formato no puede ser modificado";
        }





////        echo $info;
//        $info2 = $this->validarInformacion($info);
////        echo $info;
//        if (is_null($info2)) {
//            return 'Por favor ingrese los datos correspondientes al formato';
//        }
//        $flag = $this->info->modificarRegistroFormato($fechaFormato, $usuario, $formato, $info2,$observaciones);
//        if ($flag > 0) {
//            return 'El registro ha sido modificado';
//        } else {
//            return 'El registro no ha podido ser modificado';
//        }
    }

}
