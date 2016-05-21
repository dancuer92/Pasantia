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
        <title>Mostrar Registro</title>

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
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">find_in_page</i> Mostrar registro del formato</h1>
            <div class="container center">   
                <form id="visualizarFormato" >
                </form>
                <button id="modificarRegistro"type="button" class="btn btn-danger btn-lg center-block" onclick="modificarDiligenciaFormato();">MODIFICAR</button>
                <button id="guardarRegistro" type="button" class="btn btn-danger btn-lg center-block" onclick="guardarMR();">GUARDAR</button>
            </div>
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

        <!--script-->
        <?php
            include 'head.php';
        ?>
        <script>
            $(document).ready(function () {
                cargarRegistro();
                $('#guardarRegistro').hide();
            });
        </script>
    </body>
</html>