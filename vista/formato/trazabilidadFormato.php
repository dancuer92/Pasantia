<?php
session_start();
////Validamos si existe realmente una sesión activa o no 
if ($_SESSION["tipo"] !== "supervisor") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>

<html>
    <head>        
        <title>Trazabilidad Formato</title>

        <?php
        include 'head.php';
        ?>        
    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>

        <!--contenido-->
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">timeline</i> Trazabilidad del formato</h1>
            <div class="col-lg-7">   
                <form id="visualizarFormato" >
                </form>
                <!--<button id="modificarRegistro"type="button" class="btn btn-danger btn-lg center-block" onclick="">MODIFICAR</button>-->
            </div>

            <div class="col-lg-5">
                <div  class="btn-group btn-group-justified" role="group">
                    <a type="button" class="btn btn-default">Left</a>
                    <a type="button" class="btn btn-default">Middle</a>
                    <a type="button" class="btn btn-default">Right</a>
                </div>
            </div>
            <div id="res1"></div>
        </main>

        <!-- Pie de pagina-->
        <footer>
            <div class="text-center text-muted col-lg-12">
                <h6 >Copyright © Cerámica Italia S.A. 2015</h6>
                <h6 >Avda 3 Calle 23AN Zona Industrial. Cúcuta, Norte de Santander, Colombia.
                    <br>+57-7-5829800 - 018000111568</h6>                    
            </div>
        </footer>

        <!--script-->
        <?php
        include 'script.php';
        ?>
        <script>
            $(document).ready(function () {
                verFormato('analizar');
            });
        </script>
    </body>
</html>