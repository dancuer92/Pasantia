<?php
session_start();
if ($_SESSION["estado"] !== "activo") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../index.php");
    exit();
}
?>
<html> 
    <head> 
    <head> 
        <title>Inicio</title>      
        <!--import de la cabecera de la pagina -->
        <?php include './user/headHtml.php'; ?>

        <!-- Scripts de la pagina -->
        <?php
        include './user/scripts.php';
        ?>
        <script src="./util/js/jsUser.js"></script>
        <script src="./util/js/jsFormat.js"></script>

    </head> 

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

</body> 
</html>