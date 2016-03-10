<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../modelo/dto/Formato_dto.php';
require_once '../controlador/conexion/Conexion.php';

class Formato_dao {

    private $formato_dto;
    private $mysqli;

    public function __construct() {
        $this->formato_dto = new Formato_dto();
        $this->mysqli = new Conexion();
    }

    function cargarFormatos($formato) {
        $mensaje = "";  

        $sql = "SELECT `cod_formato`, `nombre`, `observaciones`, `procedimiento`, `jefe_procedimiento`, `descripcion_contenido`, `frecuencia_uso` "
                . "FROM `formato` "
                . "WHERE `cod_formato` COLLATE latin1_spanish_ci LIKE '%$formato%'  OR `nombre` COLLATE latin1_spanish_ci LIKE '%$formato%' LIMIT 1;";


        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.= $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($cod_formato, $nombre, $observaciones, $procedimiento, $jefe_procedimiento, $descripcion_contenido, $frecuencia_uso);
            while ($sentencia->fetch()) {
                $mensaje.='<h5> <strong>Código de usuario: </strong>' . $cod_formato . '</h5>
                        <h5> <strong>Nombre: </strong> <input id="nombre_usuario" disabled value="' . $nombre . '" onblur="edit(&nombre_usuario&)"></h5>
                        <h5> <strong>Apellido: </strong><input id="apellido_usuario" disabled value="' . $observaciones . '" onblur="edit(&apellido_usuario&)"></h5>
                        <h5> <strong>Cédula: </strong><input id="cedula_usuario" disabled value="' . $procedimiento . '" onblur="edit(&cedula_usuario&)"></h5>
                        <h5> <strong>Correo: </strong><input id="correo_usuario" disabled value="' . $jefe_procedimiento . '" onblur="edit(&correo_usuario&)"></h5>
                        <h5> <strong>Cargo: </strong><input id="cargo_usuario" disabled value="' . $descripcion_contenido . '" onblur="edit(&cargo_usuario&)"></h5>
                        <h5> <strong>Departamento o área de trabajo:</strong> <input id="departamento_usuario" disabled value=" ' . $frecuencia_uso . '" onblur="edit(&departamento_usuario&)"></h5>';
                
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        $mensaje = str_replace("&", "'", $mensaje);
        echo $mensaje;
    }

    public function imprimirFormato($codigo_formato) {
        $this->formato_dto->setCod_formato($codigo_formato);
        return $this->formato_dto->toString();
    }

}
