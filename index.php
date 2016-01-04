
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Starter Template - Materialize</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="vista/util/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="vista/util/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link rel="shortcut icon" href="vista/util/images/corporativo/icono_ceramica.ico">

        <!--  Scripts-->
        <script src="vista/util/js/jquery-2.1.4.min.js"></script>
        <script src="vista/util/js/materialize.js"></script>
        <script src="vista/util/js/init.js"></script>

    </head>
    <body>       

        <!-- div de la barra de navegación fija, header-->
        <?php
        $logo = "vista/util/images/corporativo/logo_ceramica.png";
        $home = "index.php";
        include 'vista/home/navBar.php';
        ?>

        <!-- banner inicio de sesion-->
        <?php include 'vista/home/banner.php'; ?>

        <!-- modal-fixed-footer, inicio de sesion-->
        <?php include 'vista/home/modalInicioSesion.php'; ?>

        <!-- modal-fixed-footer, cambio contraseña-->
        <?php include 'vista/home/modalCambioPass.php'; ?>

        <!-- container, informacion de la pagina-->
        <?php include 'vista/home/containerPageInfo.php'; ?>        

        <!-- Footer de la pagina -->
        <?php
        $ruta = "vista/util/images/corporativo/";
        include 'vista/home/footer.php';
        ?>     


    </body>
</html>
