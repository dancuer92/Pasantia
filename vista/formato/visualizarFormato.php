<?php
session_start();

if (!isset($_SESSION["tipo"])) {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>
<html>
    <head>        
        <title>Visualizar Formato</title>
        <?php
        include 'head.php';
        ?>
    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">visibility</i> Ver formato</h1>
            <div class="container">
                <form id="visualizarFormato">                    
                </form>
                <div class="col-lg-12 col-sm-12 col-md-12 divMayor " id="atras">
                    <a class=" btn btn-default btn-lg " onclick="window.history.back();" >ATRAS</a>
                    <a class=" btn btn-danger btn-lg " onclick="printDiv('visualizarFormato');">IMPRIMIR</a>
                </div>
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
        <!--script-->
        <?php
        include 'script.php';
        ?>        
        <script>
            $(document).ready(function () {
                verFormato('ver');
            });
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    </body>
</html>