<?php
session_start();
////Validamos si existe realmente una sesión activa o no 
//if ($_SESSION["tipo"] !== "admin") {
//    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
//    header("Location: ../../index.php");
//    exit();
//}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Diligenciar Formato</title>

        <link rel="shortcut icon" href="../../vista/util/images/corporativo/icono_ceramica.ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../util/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../util/css/formBuilder.css" type="text/css">
        <link rel="stylesheet" href="../util/css/style.css" type="text/css">

        <script type="text/javascript" src="../util/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../util/js/bootstrap.js"></script>
        <script type="text/javascript" src="../util/js/formBuilder.js"></script>
        <script type="text/javascript" src="../util/js/jquery-ui.js"></script> 
        <script type="text/javascript" src="../util/js/jsFormat.js"></script> 


        <script>
            $(document).ready(function () {
                var formato = sessionStorage.getItem('formato');
                console.log(formato);
                $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
                function (mensaje) {
                    $('#diligenciarFormato').prepend(mensaje);
                    $('input').attr('disabled', false);
                    $('div').css('border-style','none');
                    $('textarea').attr('disabled',false);
                });
            });
        </script>



    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">keyboard</i> Crear formato</h1>
            <div class="container center">
                <form id="diligenciarFormato">
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 divMayor" id="guardarFormato">
                <button class="btn btn-success btn-lg center-block" id="saveFormato" onclick="guardarDiligenciaFormato();">GUARDAR</button>
            </div>
            </form>
            <div id="res1"></div>
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