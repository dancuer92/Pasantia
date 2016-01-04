<?php
include("../../controlador/sesion/seguridadUsuarioAdmin.php");
$codigo_sesion = $_SESSION['codigo'];
?>
<html> 
    <head> 
        <title>Administrador</title>      
        <!--import de la cabecera de la pagina -->
        <?php include '../home/headHtml.php'; ?>
        <!-- Scripts de la pagina -->
        <?php
        include '../home/scripts.php';
        ?>
        <script src="../util/js/jsAdmin.js"></script>

    </head> 
    <body>   
        <!--div de la barra de navegación fija, header-->
        <?php
        $logo = "../util/images/corporativo/logo_ceramica.png";
        $home = "../../index.php";
        include '../home/header.php';
        ?>

        <!--div de pestañas de navegación-->
        <?php
        include '../home/tab.php';
        ?>

        <!-- Footer de la pagina -->
        <?php
//        $ruta="../util/images/corporativo/";
//        include '../home/footer.php';
        ?>

    </body> 
</html>

