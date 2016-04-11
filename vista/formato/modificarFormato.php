<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if ($_SESSION["tipo"] !== "asistente") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>

<html>
    <head>
        <title>Modificar Formato</title>
        <?php include './head.php'?>
        <script>
            $(document).ready(function () {
                var formato = sessionStorage.getItem('formato');
                console.log(formato);
                $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "diligenciarFormato"},
                function (mensaje) {
                    $('#formBuilder').html(mensaje);
                });
            });
        </script>


    </head>
    <body>
        <!-- Encabezado -->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>
        
        <!-- Contenido -->
        <main>
            <?php include_once './panel_main.php'; ?>
        </main>    

        <!-- Pie de pagina -->
        <footer>
            <?php include_once './panel_footer.php'; ?>
        </footer>

    </body> 

</html>
