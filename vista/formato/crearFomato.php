<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
//Validamos si existe realmente una sesión activa o no 
if ($_SESSION["tipo"] !== "admin") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Crear Formato</title>

        <link rel="shortcut icon" href="../../vista/util/images/corporativo/icono_ceramica.ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../util/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../util/css/formBuilder.css" type="text/css">

        <script type="text/javascript" src="../util/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="../util/js/bootstrap.js"></script>
        <script type="text/javascript" src="../util/js/formBuilder.js"></script>
        <script type="text/javascript" src="../util/js/jquery-ui.js"></script>



    </head>
    <body>

        <input id="codigoFormato" name="codigoFormato" type="hidden" value="<?php echo $_POST['codigoFormato']; ?>">
        <input id="nombreFormato" name="nombreFormato" type="hidden" value="<?php echo $_POST['nombreFormato']; ?>">
        <input id="procedimientoFormato" name="procedimientoFormato" type="hidden" value="<?php echo $_POST['procedimiento']; ?>">
        <input id="directorFormato" name="directorFormato" type="hidden" value="<?php echo $_POST['directorProcedimiento']; ?>">
        <input id="frecuenciaFormato" name="frecuenciaFormato" type="hidden" value="<?php echo $_POST['frecuenciaFormato']; ?>">
        <input id="descripcionFormato" name="descripcionFormato" type="hidden" value="<?php echo $_POST['descripcionFormato']; ?>">

        <!-- Encabezado-->
        <header>
            <?php include_once './head.php'; ?>
        </header>


        <div id="master-container" class="container">
            <div class="col-lg-4 col-sm-12 col-md-12 divMayor">
                <div id="pestañas">
                    <!-- Nav tabs -->
                    <ul id="myTabs" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#elementos" aria-controls="elementos" role="tab" data-toggle="tab">Elementos</a></li>
                        <li role="presentation"><a href="#propiedades" aria-controls="propiedades" role="tab" data-toggle="tab">Propiedades</a></li>
                        <li role="presentation"><a href="#formulario" aria-controls="formulario" role="tab" data-toggle="tab">Formulario</a></li>
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="elementos">                            
                            <div class="col-sm-6">
                                <button class="btn btn-default  btn-block new-element" data-type="element-text" style="width: 100%;">Single Line Text</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-paragraph-text" style="width: 100%;">Paragraph Text</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-multiple-choice" style="width: 100%;">Multiple Choice</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-section-break" style="width: 100%;">Section Break</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-default  btn-block new-element" data-type="element-number" style="width: 100%;">Number</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-checkboxes" style="width: 100%;">Checkboxes</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-dropdown" style="width: 100%;">Dropdown</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-table" style="width: 100%;">Table</button>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="propiedades">
                            <br>
                            <div id="titulo">
                                <label>Nombre del campo</label>
                                <input type="text" class="form-control" id="cambiarTitulo" value="" onkeyup="cambiarTitulo();" onblur="limpiarTitulo();"/>
                            </div>
                            <br>
                            <div id="requerido">
                                <label>Este campo será obligatorio</label> <input id="obligatorio" value="false" type="checkbox"/> 
                            </div>
                            <br>
                            <div id="opciones">                                
                            </div>
                            <br>
                            <div>
                                <button class="btn btn-danger btn-block" id="eliminar" name="eliminar" onclick="eliminar();">Eliminar elemento</button>
                            </div>                            
                        </div>
                        <div role="tabpanel" class="tab-pane" id="formulario">Formulario</div>
                    </div>

                </div>               
            </div>
            <div class="col-lg-8 col-sm-12 col-md-12 divMayor" id="formBuilder">
                <table id="encabezado" style="width:100%;text-align: center">
                    <tr>
                    <td ><h2> Nombre: <?php echo $_POST['nombreFormato']; ?></h2></td>
                    <td ><h2> Codigo: <?php echo $_POST['codigoFormato']; ?> </h2></td>                    
                    <td ><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-12 col-sm-12 col-md-12 divMayor" id="guardarFormato">
                <button class="btn btn-success btn-lg center-block" id="saveFormato" onclick="guardarFormato();">GUARDAR FORMATO</button>
            </div>
        </div>
        <div id="res1">

        </div>

        <!-- Pie de pagina-->
        <footer>
            <div class="text-center text-muted">
                <h6 >Copyright © Cerámica Italia S.A. 2015</h6>
                <h6 >Avda 3 Calle 23AN Zona Industrial. Cúcuta, Norte de Santander, Colombia.
                    <br>+57-7-5829800 - 018000111568</h6>                    
            </div>
        </footer>

    </body>
    <script>
        console.log($('hidden'));
    </script>

</html>
