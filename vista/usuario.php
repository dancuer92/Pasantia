<?php
//header("Content-Type: text/html;charset=utf-8");
session_start();
if ($_SESSION["estado"] !== "activo") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../index.php");
    exit();
}
include '../controlador/sesion/seguridadTiempo.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html> 
    <head> 
        <title><?php echo $_SESSION['tipo']; ?></title>      
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
        <!--contenido de la página-->
        <main>
            <?php
            $tipo = $_SESSION['tipo'];            
            if ($tipo === 'administrador') {
                include './usuario/gestionUsuarioAdmin.php';
            }
            else{            
                include './usuario/gestionUsuario.php';
            }
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
        <script src="./util/js/jsUser.js"></script>
    </body>
</html>