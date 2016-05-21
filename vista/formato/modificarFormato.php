<?php
//echo $_SESSION["tipo"];
//Validamos si existe realmente una sesión activa o no 
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
        <?php
            include 'head.php';
        ?>
        


    </head>
    <body>
        <!-- Encabezado -->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>

        <!-- Contenido -->
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">edit</i> Modificar formato</h1>
            
            <?php include_once './panel_main.php'; ?>
            <div class="col-lg-12 col-sm-12 col-md-12 divMayor" id="guardarFormato">
                <button class="btn btn-danger btn-lg center-block" id="saveFormato" onclick="guardarModificacionFormato();">GUARDAR FORMATO</button>
            </div>
            <div id="res1"></div>
        </main>    

        <!-- Pie de pagina -->
        <footer>
            <?php include_once './panel_footer.php'; ?>
        </footer>
        
        <!--script-->
        <?php
            include 'script.php';
        ?>
        <script>
            $(document).ready(function () {
                var formato = sessionStorage.getItem('formato');
                console.log(formato);
                $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
                function (mensaje) {
                    $('#formBuilder').html(mensaje);
                });
            });
        </script>

    </body> 

</html>
