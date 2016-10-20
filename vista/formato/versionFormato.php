<?php
//echo $_SESSION["tipo"];
//Validamos si existe realmente una sesión activa o no 
session_start();
if ($_SESSION["tipo"] !== "asistente") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
//include '../../controlador/sesion/seguridadTiempo.php';
?>
<html>
    <head>        
        <title>Versión Formato</title>
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
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">visibility</i> Ver versión del formato</h1>
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
            <?php
            include 'footer.php';
            ?>
        </footer>
        <!--script-->
        <?php
        include 'script.php';
        ?>        
        <script>
            $(document).ready(function () {
                verVersionFormato();
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