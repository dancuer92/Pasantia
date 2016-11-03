<?php

//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once '../modelo/dto/Informacion_dto.php';
require_once '../controlador/conexion/Conexion.php';

/**
 * Clase para la representación de la información de un registro de un formato
 */
class Informacion_dao {

    private $mysqli;
    private $info;

    /**
     * Constructor por vacío
     */
    public function __construct() {
        $this->mysqli = new Conexion();
        $this->mysqli->set_charset('utf8');
        $this->info = new Informacion_dto();
    }

    /**
     * Método que permite guardar la información de un registro
     * @param type $fecha_formato
     * @param type $usuario
     * @param type $cod_formato
     * @param type $info
     * @param type $observaciones
     * @return type
     */
    public function guardarInfo($fecha_sistema, $fecha_formato, $usuario, $cod_formato, $info, $observaciones, $camposClave) {
        $mensaje = '';
        $estado = 0;
        $formato = strtolower($cod_formato);
        $sql = "INSERT INTO `info_$formato`(`id`, `fecha_registro_sistema`, `fecha_formato_diligenciado`, `usuario`, `estado`, `informacion`, `observaciones`, `campos_clave`) VALUES (null,?,?,?,?,?,?,?);";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("sssisss", $fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones, $camposClave)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $this->info->crear($fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones, $camposClave, '', '');
        } else {
            $this->info = null;
        }
        $sentencia->close();
//        $this->mysqli->close();
        return $this->info;
    }

    /**
     * Mètodo que guarda la información digitada por un usuario con el fin de evitar que pueda modificar la información de otro usuario.
     * @param type $usuario nombre del usuario en sesión
     * @param type $formato
     * @param type $fechaformato
     * @param type $info
     * @return type
     */
    public function guardarInfoUsuario($usuario, $formato, $fechaSistema, $info) {
        $mensaje = 'OK';
        $sql = "INSERT INTO `usuario_informacion`(`id_usuario`, `id_formato`, `id_registro`, `campos_digitados`) VALUES (?,?,?,?)";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje = $this->mysqli->error;
        }

        if (!$sentencia->bind_param("ssss", $usuario, $formato, $fechaSistema, $info)) {
            $mensaje = $this->mysqli->error;
        }
        if (!$sentencia->execute()) {
            $mensaje = $this->mysqli->error;
        }
        $sentencia->close();
        $this->mysqli->close();
        return $mensaje;
    }

    /**
     * Método que retorna un registro. esto implica sus datos de información de interés.
     * @param type $formato
     * @return type
     */
    public function mostrarInfo($formato) {
        $mensaje = '';
        $informacion = array();
        $formato = strtolower($formato);
//        echo $formato;

        $sql = "SELECT `fecha_registro_sistema`, `fecha_formato_diligenciado`, `usuario`, `estado`, `informacion`, `observaciones`, `campos_clave`,`fechas_modificaciones`,`usuarios_modificaciones` FROM `info_$formato` ;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones, $camposClave, $fechas_modificaciones, $usuarios_modificaciones);
            while ($sentencia->fetch()) {
                $this->info->crear($fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones, $camposClave, $fechas_modificaciones, $usuarios_modificaciones);
                $informacion[] = $this->info->toJSON();
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $informacion;
    }

    /**
     * Método para ver la el contenido de información de calidad de un registro
     * @param type $formato
     * @param type $fecha
     * @return type
     */
    public function verDatos($formato, $fecha) {
        $mensaje = '';
        $formato = strtolower($formato);

        $sql = "SELECT `informacion` FROM `info_$formato` WHERE `fecha_registro_sistema`=?;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $fecha)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($info);
            while ($sentencia->fetch()) {
                $mensaje = $this->info->setInformacion($info);
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $this->info;
    }

    /**
     * Método que permite modificar el contenido de un registro de un formato
     * @param type $fecha_formato
     * @param type $formato
     * @param type $info
     * @param type $observaciones
     * @return type
     */
    public function modificarRegistroFormato($fecha_formato, $formato, $info, $observaciones, $camposClave, $fechas_mod, $users_mod) {
        $sql = "UPDATE `info_$formato` SET `estado`=`estado`+1,`informacion`=?,`observaciones`=?, `campos_clave`=?, `fechas_modificaciones`=?, `usuarios_modificaciones`=? "
                . " WHERE `fecha_registro_sistema`=?";
        $filas = 0;

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("ssssss", $info, $observaciones, $camposClave, $fechas_mod, $users_mod, $fecha_formato)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $filas = $sentencia->affected_rows;
        }

        $sentencia->close();
//        $this->mysqli->close();
        return $filas;
    }
    
    /**
     * Método que cambia el estado del formato a cerrado una vez haya vencido los plazos para realizar una modificación
     * @param type $fecha_formato fecha del registro
     * @param type $formato formato trabajado
     * @return type entero si afecta o no al formato
     */
    public function cerrarRegistro($fecha_formato, $formato) {
        $sql = "UPDATE `info_$formato` SET `estado`=5 WHERE `fecha_registro_sistema`=?";
        $filas = 0;

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $fecha_formato)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $filas = $sentencia->affected_rows;
        }

        $sentencia->close();
//        $this->mysqli->close();
        return $filas;
    }

    /**
     * Método que permite buscar un registro de un formato por la fecha de creación en el sistema.
     * @param type $formato
     * @param type $fecha
     * @return string
     */
    public function buscarRegistro($formato, $fecha) {
        $mensaje = '';
        $formato = strtolower($formato);

        $sql = "SELECT `usuarios_modificaciones`, `estado`, `observaciones`, `fechas_modificaciones` FROM `info_$formato` WHERE `fecha_registro_sistema`=?;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $fecha)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($usuarios, $estado, $observaciones, $fechas);
            while ($sentencia->fetch()) {
                $mensaje = $usuarios . '-' . $estado . '-' . $observaciones . '-' . $fechas;
            }
        }
        $sentencia->close();
//        $this->mysqli->close();
        return $mensaje;
    }

    /**
     * Busca los registros dentro de un rango de fechas.
     * @param type $formato
     * @param type $inicio
     * @param type $fin
     * @return string
     */
    public function mostrarInfoFechas($formato, $inicio, $fin) {
        $mensaje = '';
        $informacion = '';
        $formato2 = strtolower($formato);
//        echo $formato;

        $sql = "SELECT `fecha_registro_sistema`, `informacion` FROM `info_$formato2` WHERE `fecha_registro_sistema` BETWEEN '$inicio 00:00:00' AND '$fin 23:59:59';";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }


        if ($sentencia->execute()) {
            $sentencia->bind_result($fecha_sistema, $info);
            while ($sentencia->fetch()) {
                $informacion.=$fecha_sistema . "~" . $info . "||";
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $informacion;
    }

    /**
     * Cambia el nombre de la tabla de informacion del formato, esto se produce por modificar el codigo del formato que está almacenado en la BD
     * @param type $nuevoNombre
     */
    public function cambiarNombreTablaInfo($formato, $nuevoNombre) {
        $mensaje = '';
        $new = strtolower($nuevoNombre);
        $sql = "Rename table info_$formato to info_$new;";
        $mensaje = $this->mysqli->query($sql);
        if (!$mensaje) {
            return $this->mysqli->error;
        }
        $this->mysqli->close();
        return $mensaje;
    }

    /**
     * Busca los campos que el usuario ingresó por primera vez o los que ha modificado en un registro del formato
     * @param type $usuario usuario en sesión
     * @param type $formato formato trabajado
     * @param type $fecha fecha del registro
     * @return type una cadena con los campos digitados por el usuario.
     */
    public function buscarCamposUsuario($usuario, $formato, $fecha) {
        $mensaje = '';
        $sql = "SELECT `campos_digitados` FROM `usuario_informacion` WHERE `id_usuario`=? AND `id_formato`=? AND `id_registro`=?;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("sss", $usuario, $formato, $fecha)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($campos);
            while ($sentencia->fetch()) {
                $mensaje = $campos;
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $mensaje;
    }
    
    /**
     * Actualizar los campos digitados por un usuario si ya habia hecho anteriormente una modificación
     * @param type $usuario usuario en sesion 
     * @param type $formato formato trabajado
     * @param type $fecha fecha del registro
     * @param type $info informacion diligenciada
     * @return type entero que indica si realiza o no la n¿modificacion.
     */
    public function actualizarCamposUsuario($usuario,$formato,$fecha,$info){
        $sql = "INSERT INTO `usuario_informacion` (`id_usuario`,`id_formato`,`id_registro`,`campos_digitados`) "
                . "VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE `campos_digitados`=? ;";
        $filas = 0;

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("sssss", $usuario, $formato, $fecha, $info,$info)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $filas = $sentencia->affected_rows;
        }

        $sentencia->close();
        $this->mysqli->close();
        return $filas;
    }

}
