<!DOCTYPE html>
<?php
//echo $_SESSION["tipo"];
//Validamos si existe realmente una sesión activa o no 
session_start();
if ($_SESSION["tipo"] !== "asistente") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
include '../../controlador/sesion/seguridadTiempo.php';
?>
<html>
    <head>
        <title>Crear Formato</title>
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
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">note_add</i> Crear formato</h1>
            <input type="hidden" id="codigoFormato" name="codigoFormato" value="<?php echo $_POST['codigoFormato'] ?>"/>
            <input type="hidden" id="nombreFormato" name="nombreFormato" value="<?php echo $_POST['nombreFormato'] ?>"/>
            <input type="hidden" id="procedimientoFormato" name="procedimientoFormato" value="<?php echo $_POST['procedimiento'] ?>"/>
            <input type="hidden" id="directorProcedimiento" name="directorProcedimiento" value="<?php echo $_POST['directorProcedimiento'] ?>"/>
            <input type="hidden" id="frecuenciaFormato" name="frecuenciaFormato" value="<?php echo $_POST['frecuenciaFormato'] ?>"/>
            <input type="hidden" id="tipoFormato" name="tipoFormato" value="<?php echo $_POST['tipoFormato'] ?>"/>
            <input type="hidden" id="versionFormato" name="versionFormato" value="<?php echo $_POST['versionFormato'] ?>"/>
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

        <!-- Script -->
        <?php
        include 'script.php';
        ?>  
        <script>
            $(document).ready(function () {
                $('#formulario').hide();
                $('#pestañaFormulario').hide();
            });
        </script>

    </body> 

</html>
