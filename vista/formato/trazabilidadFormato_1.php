<?php
session_start();
////Validamos si existe realmente una sesión activa o no 
if ($_SESSION["tipo"] !== "supervisor") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
include '../../controlador/sesion/seguridadTiempo.php';
?>

<html>
    <head>        
        <title>Trazabilidad completa de registros</title>

        <?php
        include 'head.php';
        ?>       
        <link rel="stylesheet" href="../util/css/datatables.css" type="text/css">
    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>

        <!--contenido-->
        <main>
            <input type="hidden" id="fechaInicio" name="fechaInicio" value="<?php echo $_POST['fechaInicio'] ?>"/>
            <input type="hidden" id="fechaFin" name="fechaFin" value="<?php echo $_POST['fechaFin'] ?>"/>            
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">timeline</i> Trazabilidad completa de registros</h1>
            <div class="col-lg-12 col-xs-12 col-md-12 center" hidden>
                <form id="visualizarFormato">
                </form>                
            </div>
            <input id="ver" type="button" onclick="trazabilidadCompleta();" value="Ver"/>
            <div class="col-lg-12 col-xs-12 col-md-12">
                <table id="tableRes">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-lg-12 col-xs-12 col-md-12" id="divRes" hidden></div>
            <br>
            <div class="col-lg-12 col-xs-12 col-md-12">
                <button id="btnExportTablaGeneral">Exportar la tabla a Excel</button>
            </div> 
        </main>

        <!-- Pie de pagina-->
        <footer>
            <div class="col-lg-12 col-xs-12 col-md-12" id="footer">
                <?php
                include 'footer.php';
                ?>
            </div>
        </footer>

        <!--script-->
        <?php
        include 'script.php';
        ?>
        <script type="text/javascript" src="../util/js/fusioncharts.js"></script>
        <script type="text/javascript" src="../util/js/fusioncharts-jquery-plugin.js"></script>
        <script type="text/javascript" src="../util/js/analisis.js"></script>
        <script type="text/javascript" src="../util/js/datatables.js"></script>
        <script type="text/javascript" src="../util/js/tablesorter.js"></script>
        <script type="text/javascript">
                $(document).ready(function () {
                    verFormato('diligenciar');
                    mostrarForm();
                });
                $("#btnExportTablaGeneral").click(function (e) {
                    window.open('data:application/vnd.ms-excel,' + $('#divRes').html());
                    e.preventDefault();
                });

        </script>
    </body>
</html>