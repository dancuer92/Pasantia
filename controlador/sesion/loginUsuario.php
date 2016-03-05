<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

if (!$mysqli = new mysqli("localhost", "root", "", "pasantia")) {
    die("Error al conectarse a la base de datos");
}

$nombre = $_POST['nombre']; //TOMAMOS usuario DE TEXTO FORMULARIO
$apellido = $_POST['apellido']; //TOMAMOS password.
//$clave_codificada = ($apellido);   //PUEDES CODIFICAR TU password CON FUNCIONES COMO BASE64_ENCODE ETC.

print_r($nombre);
print_r($apellido);
echo "<br>";

require_once('../conexion/conexionMySqli.php');
//require_once('../../vista/admin/homeAdmin.php');

try {
    //preparacion de la consulta
    $sql = "SELECT usuario.nombre_usuario, usuario.apellido_usuario , usuario.codigo_usuario, 
    usuario.rol_usuario, usuario.estado_usuario
    FROM usuario WHERE usuario.nombre_usuario=? AND usuario.apellido_usuario =?";


    //PREPARAMOS EL PROCEDIMIENTO
    if (!$sentencia = $mysqli->prepare($sql)) {
        print $mysqli->error;
    }

    //LE PASAMOS LOS PARAMETROS; "SS" SIGNIFICA QUE SON STRINGS
    if (!$sentencia->bind_param("ss", $nombre, $apellido)) {
        print $mysqli->error;
    }

    //EJECUTAMOS LA CONSULTA
    if (!$sentencia->execute()) {
        print $mysqli->error;
        die("Fallo en la ejecucion");
    }

//    print_r($sentencia);
//    echo "<br>";

    $resultado = $sentencia->get_result();
    print_r($resultado);
    echo "<br>";

    $fila_recuperada = $resultado->fetch_array(MYSQLI_ASSOC);
    $nombre_usuario = $fila_recuperada['nombre_usuario'];
    $codigo_usuario = $fila_recuperada['codigo_usuario'];
    $tipo = $fila_recuperada['rol_usuario'];
    $estado = $fila_recuperada['estado_usuario'];
    print_r($fila_recuperada);
    echo "<br>";


    //SI EL PARAMETRO RESULT ES MAYOR A 0, QUIERE DECIR QUE ENCONTRAMOS UN usuario CON LOS CRITERIOS DE BUSQUEDA.
    if (!empty($fila_recuperada)) {
//        $fila_recuperada = $resultado->fetch(MYSQLI_ASSOC);
        print_r($fila_recuperada);
        echo "<br>";

        $_SESSION['nombre'] = $nombre_usuario; //CREAMOS UNA SESSION CON EL nombre DE LA PERSONA PARA MOSTRARLO           
        $_SESSION['codigo']=$codigo_usuario;

        //ADMIN, EN NUESTRA TABLA usuarios, ADMIN LO IDENTIFICAMOS CON 1.
        if ($tipo == 1 && $estado == 1) {
            $_SESSION['estado'] = "activo";
            $_SESSION['tipo'] = "admin"; //CREAMOS UNA SESION administrador
            // Retornamos a la página inicial de administrador
            header('location: ../../vista/administrador.php');
            
        } else if ($tipo == 0 && $estado == 1) {
            $_SESSION['estado'] = "activo";
            $_SESSION['tipo'] = "operator"; //CREAMOS UNA SESION administrador
            // Retornamos a la página inicial de operario
            header('location: ../../vista/operario.php');
//            header('location: ../index.php');
//            print 'usuario no admin';
            
        } else {
            header('location: ../../index.php');
        }
    } else {
//        header('location: ../../index.php');
        print 'Usuario no registrado'; // EN CASO DE EL PARAMETRO OUT RESULT SER 0 MANDA MENSAJE  usuario NO REGISTRADO
    }

    $mysqli->close();
} catch (Exception $e) {
    print 'Hubo un error';
}




//// Output the compiled query
//debug($sql, $params);
//
//function debug($statement, array $params = [])
//{
//    $statement = preg_replace_callback(
//        '/[?]/',
//        function ($k) use ($params) {
//            static $i = 0;
//            return sprintf("'%s'", $params[$i++]);
//        },
//        $statement
//    );
//
//    echo '<pre>Query Debug:<br>', $statement, '</pre>';
//}
?>