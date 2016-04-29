<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
//echo $_SESSION["tipo"];
//Validamos si existe realmente una sesión activa o no 
if ($_SESSION["tipo"] !== "asistente") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>
<html>
    <head>
        <title>Crear Formato</title>
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
        <script type="text/javascript" src="../util/js/jsFormat.js"></script>
        <script>
            $(document).ready(function () {
                $('#formulario').hide();
                $('#pestañaFormulario').hide();                
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
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">note_add</i> Crear formato</h1>
            <input type="hidden" id="codigoFormato" name="codigoFormato" value="<?php echo $_POST['codigoFormato'] ?>"/>
            <input type="hidden" id="nombreFormato" name="nombreFormato" value="<?php echo $_POST['nombreFormato'] ?>"/>
            <input type="hidden" id="procedimientoFormato" name="procedimientoFormato" value="<?php echo $_POST['procedimiento'] ?>"/>
            <input type="hidden" id="directorProcedimiento" name="directorProcedimiento" value="<?php echo $_POST['directorProcedimiento'] ?>"/>
            <input type="hidden" id="frecuenciaFormato" name="frecuenciaFormato" value="<?php echo $_POST['frecuenciaFormato'] ?>"/>
            <input type="hidden" id="tipoFormato" name="tipoFormato" value="<?php echo $_POST['tipoFormato'] ?>"/>
            <input type="hidden" id="descripcionFormato" name="descripcionFormato" value="<?php echo $_POST['descripcionFormato'] ?>"/>
            <?php include_once './panel_main.php'; ?>
            <div class="col-lg-12 col-sm-12 col-md-12 divMayor" id="guardarFormato">
                <button class="btn btn-danger btn-lg center-block" id="saveFormato" onclick="guardarRegistroFormato();">GUARDAR FORMATO</button>
            </div>
            <div id="res1"></div>
        </main>    

        <!-- Pie de pagina -->
        <footer>
            <?php include_once './panel_footer.php'; ?>
        </footer>

    </body> 

</html>
