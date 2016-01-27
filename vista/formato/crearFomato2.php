<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Crear Formato</title>

        <link rel="shortcut icon" href="../../vista/util/images/corporativo/icono_ceramica.ico">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/style.css" type="text/css">

        <script type="text/javascript" src="../../vista/util/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="bootstrap-3.3.6-dist/js/bootstrap.js"></script>
        <script type="text/javascript" src="bootstrap-3.3.6-dist/js/formBuilder.js"></script>



    </head>
    <body>
        <div id="master-container" class="container">
            <div class="col-lg-4 col-sm-12 col-md-12">
                <div>
                    <!-- Nav tabs -->
                    <ul id="myTabs" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#elementos" aria-controls="elementos" role="tab" data-toggle="tab">Elementos</a></li>
                        <li role="presentation"><a href="#propiedades" aria-controls="propiedades" role="tab" data-toggle="tab">Propiedades</a></li>
                        <li role="presentation"><a href="#formulario" aria-controls="formulario" role="tab" data-toggle="tab">Formulario</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="elementos">
                            <br><br>
                            <div class="col-sm-6">
                                <button class="button new-element" data-type="element-text" style="width: 100%;">Single Line Text</button>
                                <button class="button new-element" data-type="element-paragraph-text" style="width: 100%;">Paragraph Text</button>
                                <button class="button new-element" data-type="element-multiple-choice" style="width: 100%;">Multiple Choice</button>
                                <button class="button grey new-element" data-type="element-section-break" style="width: 100%;">Section Break</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="button new-element" data-type="element-number" style="width: 100%;">Number</button>
                                <button class="button new-element" data-type="element-checkboxes" style="width: 100%;">Checkboxes</button>
                                <button class="button new-element" data-type="element-dropdown" style="width: 100%;">Dropdown</button>
                                <button class="button new-element" data-type="element-table" style="width: 100%;">Table</button>
                            </div></div>
                        <div role="tabpanel" class="tab-pane" id="propiedades">
                            <br><br>
                            <div id="titulo">
                                <label>Título del campo</label>
                                <input type="text" class="form-control" id="field-label" value="Untitled" />
                            </div><br>
                            <div id="requerido">
                                <label>Este campo será obligatorio</label> <input type="checkbox"/>                                    
                                
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="formulario">Formulario</div>
                    </div>

                </div>               
            </div>
            <div class="col-lg-8 col-sm-12 col-md-12" id="formBuilder">

            </div>
        </div>
        <script>

        </script>

    </body>

</html>
