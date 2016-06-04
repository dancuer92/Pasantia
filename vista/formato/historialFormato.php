<?php
session_start();
if ($_SESSION["tipo"] !== "asistente") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>
<html>
    <head>
        <title>Historial Formato</title>
        <?php
            include 'head.php';
        ?>
        <link rel="stylesheet" href="../util/css/datatables.css" type="text/css">
        
    </head>
    <body>
        <!--encabezado-->
        <header>
            <?php include './panel_header.php'; ?> 
        </header>
        <!--contenido-->
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">history</i> Historial de modificaciones en el formato</h1>
            <div id="master-container" class="container">
                <!--<div class="table-responsive">-->
                    <table id="tabla_historial" class="table  table-hover compact cell-border">
                        <thead>
                            <tr>
                                <th data-field="fecha"> Fecha de modificación</th>
                                <th data-field="detalle"> Naturaleza del cambio</th>
                                <th data-field="usuario"> Usuario de la modificación</th>
                                <th data-field="observaciones"> Versión  del formato</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                <!--</div>-->               
            </div>
        </main>
        <!--pie de pagina-->
        <footer>
            <?php include './panel_footer.php'; ?>           
        </footer>
        
        <!--script-->
        <?php
            include 'script.php';
        ?>
        <script type="text/javascript" src="../util/js/datatables.js"></script>
        <script>
            $(document).ready(function () {
                var formato = sessionStorage.getItem('formato');
                cargarHistorial(formato);
            });
        </script>
    </body>
</html>