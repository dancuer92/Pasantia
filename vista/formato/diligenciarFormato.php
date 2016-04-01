<?php
session_start();
//Validamos si existe realmente una sesión activa o no 
if ($_SESSION["tipo"] !== "admin") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Crear Formato</title>

        <link rel="shortcut icon" href="../util/images/corporativo/icono_ceramica.ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../util/css/bootstrap.css" type="text/css">

        <script type="text/javascript" src="../util/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../util/js/bootstrap.js"></script>
        <script type="text/javascript" src="../util/js/jsFormat.js"></script>
        <script>
            $(document).ready(function(){
                cargarPagina();
            });
        </script>



    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './head.php'; ?>
        </header>
        <main>
            <div id="diligenciarFormato" class="container center">
                <?php // echo $_POST['ref_formato']; echo 'hola'?>
            </div>
        </main>
        <!-- Pie de pagina-->
        <footer>
            <div class="text-center text-muted">
                <h6 >Copyright © Cerámica Italia S.A. 2015</h6>
                <h6 >Avda 3 Calle 23AN Zona Industrial. Cúcuta, Norte de Santander, Colombia.
                    <br>+57-7-5829800 - 018000111568</h6>                    
            </div>
        </footer>
    </body>
</html>