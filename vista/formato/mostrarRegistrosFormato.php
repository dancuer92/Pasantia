<?php
session_start();
////Validamos si existe realmente una sesión activa o no 

if ($_SESSION["tipo"] !== "supervisor" && $_SESSION["tipo"] !== "operario") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Mostrar Registros Formato</title>

        <link rel="shortcut icon" href="../../vista/util/images/corporativo/icono_ceramica.ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../util/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../util/css/formBuilder.css" type="text/css">
        <link rel="stylesheet" href="../util/css/style.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="../util/css/datatables.css"/>


        <script type="text/javascript" src="../util/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../util/js/bootstrap.js"></script>
        <script type="text/javascript" src="../util/js/formBuilder.js"></script>
        <script type="text/javascript" src="../util/js/jquery-ui.js"></script> 
        <script type="text/javascript" src="../util/js/jsFormat.js"></script> 
        <script type="text/javascript" src="../util/js/datatables.js"></script>


        <script>
            $(document).ready(function () {
                var formato = sessionStorage.getItem('formato');
                console.log(formato);                

                $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "mostrarRegistrosFormato"},
                function (mensaje) {
                    $('#mostrarRegFormato tbody').append(mensaje);
                    $('#mostrarRegFormato').DataTable({responsive:true});
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
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">find_in_page</i> Mostrar registros del formato</h1>
            <div class="container center">
                <table id="mostrarRegFormato" class="table table-hover">
                    <thead>
                        <tr>
                            <td>Fecha de registro en el sistema</td>
                            <td>Usuario encargado</td>
                            <td>Estado del registro</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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