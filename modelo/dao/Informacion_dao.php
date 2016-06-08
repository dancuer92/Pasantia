<?php

//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once '../modelo/dto/Informacion_dto.php';
require_once '../controlador/conexion/Conexion.php';

class Informacion_dao {

    private $mysqli;
    private $info;

    public function __construct() {
        $this->mysqli = new Conexion();
        $this->mysqli->set_charset('utf8');
        $this->info = new Informacion_dto();
    }

    public function guardarInfo($fecha_formato, $usuario, $cod_formato, $info, $observaciones) {
        $mensaje = '';
        $estado = 0;
        $formato = strtolower($cod_formato);
        $sql = "INSERT INTO `info_$formato`(`id`, `fecha_registro_sistema`, `fecha_formato_diligenciado`, `usuario`, `estado`, `informacion`, `observaciones`) VALUES (null,CURRENT_TIMESTAMP,?,?,?,?,?);";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("ssiss",$fecha_formato, $usuario, $estado, $info, $observaciones)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $this->info->crear('', $fecha_formato, $usuario, $estado, $info, $observaciones);
        } else {
            $this->info = null;
        }
        $sentencia->close();
        $this->mysqli->close();
        return $this->info;
    }

    public function mostrarInfo($formato) {
        $mensaje = '';
        $informacion = array();
        $formato = strtolower($formato);
//        echo $formato;

        $sql = "SELECT `fecha_registro_sistema`, `fecha_formato_diligenciado`, `usuario`, `estado`, `informacion`, `observaciones` FROM `info_$formato` ;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones);
            while ($sentencia->fetch()) {
                $this->info->crear($fecha_sistema, $fecha_formato, $usuario, $estado, $info, $observaciones);
                $informacion[] = $this->info->toJSON();
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $informacion;
    }

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
    
    public function modificarRegistroFormato($fecha_formato, $usuario, $formato, $info, $observaciones){
        $sql = "UPDATE `info_$formato` SET `usuario`=?,`estado`=`estado`+1,`informacion`=?,`observaciones`=?"
                . " WHERE `fecha_registro_sistema`=?";
        $filas = 0;

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if (!$sentencia->bind_param("ssss", $usuario, $info, $observaciones, $fecha_formato)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $filas = $sentencia->affected_rows;
        }

        $sentencia->close();
        $this->mysqli->close();
        return $filas;
    }
    
    public function buscarRegistro($formato, $fecha) {
        $mensaje = '';
        $formato = strtolower($formato);

        $sql = "SELECT `usuario`, `estado` FROM `info_$formato` WHERE `fecha_registro_sistema`=?;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }

        if (!$sentencia->bind_param("s", $fecha)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($usuario,$estado);
            while ($sentencia->fetch()) {
                $mensaje = $usuario.'-'.$estado;
            }
        }
        $sentencia->close();
//        $this->mysqli->close();
        return $mensaje;
    }
    
    public function mostrarInfoFechas($formato, $inicio, $fin) {
        $mensaje = '';
        $informacion='';
        $formato2 = strtolower($formato);
//        echo $formato;

        $sql = "SELECT `fecha_registro_sistema`, `informacion` FROM `info_$formato2` WHERE `fecha_registro_sistema` BETWEEN '$inicio 00:00:00' AND '$fin 23:59:59';";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.=$this->mysqli->error;
        }
        

        if ($sentencia->execute()) {
            $sentencia->bind_result($fecha_sistema, $info);
            while ($sentencia->fetch()) {
                $informacion.=$fecha_sistema."~".$info;
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $informacion;
    }

}
