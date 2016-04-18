<?php
//header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION["estado"] !== "activo") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html> 
    <head> 
        <title>Administrador</title>      
        <!--import de la cabecera de la pagina -->
        <?php include './user/headHtml.php'; ?>

        <!-- Scripts de la pagina -->
        <?php
        include './user/scripts.php';
        ?>
        <script src="./util/js/jsUser.js"></script>
        <script src="./util/js/jsFormat.js"></script>
        <script>
            $(document).ready(function () {
                autocompletarFormato();
            })
        </script>

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
        <main>
            <?php
            $tipo = $_SESSION['tipo'];
            if ($tipo === 'asistente') {
                include './formato/gestionFormatoAsis.php';
            } else {
                include './formato/gestionFormato.php';
            }
            ?> 

        </main>
        <!-- Footer de la pagina -->
        <footer>
            <?php
            include './user/footer.php';
            ?>
        </footer>
    </body>
</html>