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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <link rel="shortcut icon" href="../../vista/util/images/corporativo/icono_ceramica.ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../util/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../util/css/formBuilder.css" type="text/css">
        <link rel="stylesheet" href="../util/css/style.css" type="text/css">
        <script type="text/javascript" src="../util/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../util/js/bootstrap.js"></script>
        <script type="text/javascript" src="../util/js/formBuilder.js"></script>
        <script type="text/javascript" src="../util/js/jquery-ui.js"></script>    
    </head>
    <body>
        <header>
            <?php include './panel_header.php'; ?> 
        </header>
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">history</i> Historial de modificaciones en el formato</h1>

            <div id="master-container" class="container">

                <div class="table-responsive">
                    <table class="table  table-hover">
                        <thead>
                            <tr>
                                <th data-field="fecha"> Fecha</th>
                                <th data-field="observaciones"> Observaciones  del formato</th>
                                <th data-field="usuario"> Usuario de la modificación</th>
                                <th data-field="detalle"> Detalle de la modificación</th>
                                <th data-field="opciones">opc</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <tr>
                                <td>' . $array["cod_formato"] . '</td>
                                <td>' . $array["nombre"] . '</td>
                                <td>' . $array["observaciones"] . '</td>
                                <td>' . $array["procedimiento"] . '</td>                        
                                <td>
                                    <a class="hoverable" href="#Diligenciar"> Ver</a>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>               
            </div>
        </main>
        <footer>
            <?php include './panel_footer.php'; ?>
        </footer>
    </body>
</html>