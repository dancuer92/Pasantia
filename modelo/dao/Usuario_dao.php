<?php

//header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../modelo/dto/Usuario_dto.php';
require_once '../controlador/conexion/Conexion.php';

/**
 * Clase para la gestión de los usuarios en la BD 
 */
class Usuario_dao {

    private $mysqli;
    private $usuario;

    /**
     * Constructor de la clase por defecto
     */
    public function __construct() {
        $this->mysqli = new Conexion();
        mysqli_set_charset($this->mysqli, 'utf8');
        $this->usuario = new Usuario_dto();
    }

    /**
     * Método que comrpueba el inicio de sesión de un usuario garantizando que existe y está activo.
     * retorna información del usuario para almacenar en la sesión
     * @param type $nombre
     * @param type $password
     * @return \Usuario_dto
     */
    public function iniciar_sesion($nombre, $password) {
        $usuario = new Usuario_dto();

        $sql = "SELECT u.nombre_usuario, u.apellido_usuario , u.codigo_usuario, 
            u.rol_usuario, u.estado_usuario, u.caducidad_usuario 
            FROM usuario u WHERE u.codigo_usuario=? AND u.password_usuario =?;";

        //PREPARAMOS EL PROCEDIMIENTO
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        //LE PASAMOS LOS PARAMETROS; "SS" SIGNIFICA QUE SON STRINGS
        if (!$sentencia->bind_param("ss", $nombre, $password)) {
            echo $this->mysqli->error;
        }

        //EJECUTAMOS LA CONSULTA
        if (!$sentencia->execute()) {
            print $this->mysqli->error;
            die("Falló la ejecucion de la consulta");
        }
        if ($sentencia->execute()) {
            $sentencia->bind_result($nombre_usuario, $apellido_usuario, $codigo_usuario, $rol_usuario, $estado_usuario, $caducidad_usuario);
            while ($sentencia->fetch()) {
                $usuario->sesion($nombre_usuario, $apellido_usuario, $codigo_usuario, $rol_usuario, $estado_usuario, $caducidad_usuario);
            }
        }

//        echo $this->mysqli->host_info;
        $sentencia->close();
        $this->mysqli->close();
//        echo $formato->toJSON().'DAO';

        return $usuario;
    }

    /**
     * Método que permite registrar un usuario en el sistema.
     * retorna null si el usuario no pudo ser registrado en la BD
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
     * @return type
     */
    public function registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado) {

        $mensaje = '';
        $sql = "INSERT INTO `usuario`(`codigo_usuario`, `nombre_usuario`, `apellido_usuario`, `cedula_usuario`, "
                . "`password_usuario`, `correo_usuario`, `cargo_usuario`, `departamento_usuario`, `telefono_usuario`, "
                . "`rol_usuario`, `estado_usuario`) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?);";

        //PREPARAMOS EL PROCEDIMIENTO
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        //LE PASAMOS LOS PARAMETROS; "SS" SIGNIFICA QUE SON STRINGS
        if (!$sentencia->bind_param("sssssssssii", $codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado)) {
            echo $this->mysqli->error;
        }

        //EJECUTAMOS LA CONSULTA
        if ($sentencia->execute()) {
            $this->usuario->registrar($codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado);
        } else {
            $this->usuario = NULL;
        }
        $sentencia->close();
        $this->mysqli->close();
        return $this->usuario;
    }

    /**
     * Método que permite buscar un usuario en el sistema, o buscar los usuarios para que sean asignados a un formato,
     * o los usuarios que estén asignados a un formato
     * retorna un arreglo de usuarios
     * @param type $consultaBusqueda
     * @param type $opc
     * @param type $formato
     * @return type
     */
    public function buscar($consultaBusqueda, $opc, $formato) {
        $usuarios = array();
        $sql = "";
        if ($opc === 'asignar') {
            $sql = "SELECT u.codigo_usuario, u.nombre_usuario, u.apellido_usuario, u.correo_usuario, u.cargo_usuario, "
                    . "u.departamento_usuario, u.telefono_usuario, u.rol_usuario, u.estado_usuario, u.fecha_registro, u.caducidad_usuario "
                    . "FROM usuario u WHERE (u.rol_usuario=0 OR u.rol_usuario=3) AND( "
                    . "u.codigo_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR u.nombre_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR u.apellido_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR concat(u.nombre_usuario,' ',u.apellido_usuario) COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%') "
                    . "LIMIT 6;";
        } else if ($opc === 'desasignar') {
            $sql = "SELECT u.codigo_usuario, u.nombre_usuario, u.apellido_usuario, u.correo_usuario, u.cargo_usuario, "
                    . "u.departamento_usuario, u.telefono_usuario, u.rol_usuario, u.estado_usuario, u.fecha_registro, u.caducidad_usuario  "
                    . "FROM usuario u, usuario_formato uf WHERE uf.id_formato='$formato' AND uf.accion='asignado' AND u.codigo_usuario=uf.id_usuario "
                    . "AND (u.rol_usuario=0 OR u.rol_usuario=3)"
                    . "AND (u.codigo_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR u.nombre_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR u.apellido_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR concat(u.nombre_usuario,' ',u.apellido_usuario) COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%') "
                    . "LIMIT 6;";
        } else {
            $sql = "SELECT u.codigo_usuario, u.nombre_usuario, u.apellido_usuario, u.correo_usuario, u.cargo_usuario, "
                    . "u.departamento_usuario, u.telefono_usuario, u.rol_usuario, u.estado_usuario, u.fecha_registro, u.caducidad_usuario  "
                    . "FROM usuario u WHERE u.codigo_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR u.nombre_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR u.apellido_usuario COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "OR concat(u.nombre_usuario,' ',u.apellido_usuario) COLLATE utf8_spanish_ci LIKE '%$consultaBusqueda%' "
                    . "LIMIT 9;";
        }
        if (!$sentencia = $this->mysqli->prepare($sql)) {
            echo $this->mysqli->error;
        }

        if ($sentencia->execute()) {
            $sentencia->bind_result($codigo_usuario, $nombre_usuario, $apellido_usuario, $correo_usuario, $cargo_usuario, $departamento_usuario, $telefono_usuario, $rol_usuario, $estado_usuario, $fecha_registro, $caducidad_usuario);
            while ($sentencia->fetch()) {
                $this->usuario->registrar($codigo_usuario, $nombre_usuario, $apellido_usuario, '', '', $correo_usuario, $cargo_usuario, $departamento_usuario, $telefono_usuario, $rol_usuario, $estado_usuario, $caducidad_usuario);
                $usuarios[] = $this->usuario->toJSON();
            }
        }
        $sentencia->close();
        $this->mysqli->close();
//        echo $formato->toJSON().'DAO';
        return $usuarios;
    }

    /**
     * método que permite modificar la información de un usuario en la BD
     * retorna un true si la consulta se realizó correctamente
     * @param type $clave
     * @param type $valor
     * @param type $cod
     * @return type
     */
    public function editar($clave, $valor, $cod) {
        $sql;
        if ($clave === 'password_usuario') {
            //Zona horaria y fecha actual
            date_default_timezone_set('America/Bogota');
            $fechaSistema = strtotime(date('Y/m/d H:i:s', time()));
            $fechaCaducidad = date('Y-m-d H:i:s',strtotime('+3 months', $fechaSistema));
            $sql = "UPDATE usuario u SET u.password_usuario=?, u.caducidad_usuario='".$fechaCaducidad."' WHERE u.codigo_usuario=? ;";
        } else {
            $sql = "UPDATE usuario u SET u." . $clave . "=? WHERE u.codigo_usuario=? ;";
        }        

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.= $this->mysqli->error;
        }
        if (!$sentencia->bind_param("ss", $valor, $cod)) {
            $mensaje.= $this->mysqli->error;
        }
        $mensaje = $sentencia->execute();
        $sentencia->close();
        $this->mysqli->close();
        return $mensaje;
    }

    /**
     * Método que permite cargar la información del perfil del usuario que inicia sesión
     * Retorna un usuario_dto
     * @param type $codigo
     * @return type
     */
    public function cargar($codigo) {
        $sql = "SELECT u.codigo_usuario, u.nombre_usuario, u.apellido_usuario, u.cedula_usuario, u.correo_usuario, u.cargo_usuario,"
                . "u.departamento_usuario, u.telefono_usuario, u.rol_usuario, u.caducidad_usuario "
                . "FROM usuario u WHERE u.codigo_usuario = ?";


        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.= $this->mysqli->error;
        }
        if (!$sentencia->bind_param("s", $codigo)) {
            $mensaje.= $this->mysqli->error;
        }
        if ($sentencia->execute()) {
            $sentencia->bind_result($codigo_usuario, $nombre_usuario, $apellido_usuario, $cedula_usuario, $correo_usuario, $cargo_usuario, $departamento_usuario, $telefono_usuario, $rol_usuario, $caducidad_usuario);
            while ($sentencia->fetch()) {
                $this->usuario->registrar($codigo_usuario, $nombre_usuario, $apellido_usuario, $cedula_usuario, '', $correo_usuario, $cargo_usuario, $departamento_usuario, $telefono_usuario, $rol_usuario, 1, $caducidad_usuario);
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $this->usuario;
    }

    /**
     * Método para actualizar la contraseña de un usuario en la BD
     * retorna 0 si hubo un error en la operación
     * retorna 1 si la contraseña fue actualizada
     * retorna 2 si la contraseña anterior no coincide
     * @param type $newPass
     * @param type $prevPass
     * @param type $cod
     * @return string
     */
    public function cambiar($newPass, $prevPass, $cod) {
        $sql = "UPDATE usuario u SET u.password_usuario=? WHERE u.password_usuario=? AND u.codigo_usuario=? ;";

        if (!$sentencia = $this->mysqli->prepare($sql)) {
            $mensaje.= $this->mysqli->error;
        }
        if (!$sentencia->bind_param("sss", $newPass, $prevPass, $cod)) {
            $mensaje.= $this->mysqli->error;
        }
        if (!$sentencia->execute()) {
            $mensaje = "0";
        } else {
            $mensaje = "1";
            if ($sentencia->affected_rows === 0) {
                $mensaje = "2";
            }
        }
        $sentencia->close();
        $this->mysqli->close();
        return $mensaje;
    }

}
