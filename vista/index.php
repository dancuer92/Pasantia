<?php
//header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION["estado"] !== "activo") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../index.php");
    exit();
}
//include '../controlador/sesion/seguridadTiempo.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html> 
    <head> 
        <title>Inicio</title>      
        <!--import de la cabecera de la pagina -->
        <?php include './user/headHtml.php'; ?>       

    </head> 

    <body>   
        <!--div de la barra de navegación fija, header-->
        <header>
            <?php
            $logo = "./util/images/corporativo/logo_ceramica.png";
            $home = "../index.php";
            include './user/header.php';
            ?>
        </header>
        <!--div de pestañas de navegación-->
        <main>
            <?php
            include './user/content.php';
            ?>
        </main>
        <!-- Footer de la pagina -->
        <footer>
            <?php
            include './user/footer.php';
            ?>
        </footer>

        <!-- Scripts de la pagina -->
        <?php
        include './user/scripts.php';
        ?>

        <script>
            $(document).ready(function () {
//                consultarCaducidad();
                $(".button-collapse").sideNav();
            });
        </script>

    </body> 
</html>