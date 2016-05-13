<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

        <title>Sistema Integrado de Gestión a la calidad de Cerámica Italia S.A.</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" type="text/css">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" type="text/css">-->
        <link rel="stylesheet" href="../util/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../util/css/formBuilder.css" type="text/css">
        <style>
            .hover{
                background-color:lightpink;
            }
        </style>

        <!--<link href="../util/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
        <!--<link href="vista/util/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
        <link rel="shortcut icon" href="../util/images/corporativo/icono_ceramica.ico">

        <!--  Scripts-->
        <script src="../util/js/jquery-2.1.4.min.js"></script>
<!--        <script src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>-->
        <script src="../util/js/bootstrap.js"></script>
        <script src="../util/js/formBuilder.js"></script>
        <script>
            $(document).ready(function () {
                $('#diligenciarFormato');
                $('.tooltipped').tooltip();
                $("td").hover(
                        function () {
                            $(this).addClass("hover");
                        },
                        function () {
                            $(this).removeClass("hover");
                        }
                );
            });




        </script>


    </head>
    <body>     
        <!--        <div  class="container">
                    <table id="diligenciarFormato" class=" responsive-table">
                        <thead>
                            <tr>
                                <th>Código del formato</th>
                                <th>Nombre del formato</th>
                                <th>Observaciones</th>
                                <th>Procedimiento</th>
                                <th>Jefe de procedimiento</th>
                                <th>Diligenciar</th>
                                <th>Asignar</th>
                                <th>Modificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>name1</td>
                                <td>observaciones1</td>
                                <td>procedimiento1</td>                        
                                <td>jefePro1</td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Diligenciar</a></td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Asignar</a></td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Modificar</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>name2</td>
                                <td>observaciones2</td>
                                <td>procedimiento2</td>                        
                                <td>jefePro2</td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Diligenciar</a></td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Asignar</a></td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Modificar</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>name3</td>
                                <td>observaciones3</td>
                                <td>procedimiento3</td>                        
                                <td>jefePro3</td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Diligenciar</a></td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Asignar</a></td>                        
                                <td><a class="btn-flat waves-effect waves-red hoverable">Modificar</a></td>
                            </tr>
                        </tbody>
                    </table>
        
                    <div class="row">
                        <div class="col s12">
                            <div id="test2" class="col s12">
                                <div class="col l3 row hide-on-med-and-down">
                                    <ul class="collection">            
                                        <li class="collection-item colorTexto">
                                            <i class="material-icons">search</i>Consultar formato
                                        </li>                    
                                    </ul>               
                                </div>
                                <div class="col l9 m12 s12">
                                    <div class="collection"><div id="consultarFormat" class="contenido">
                                            <div class="s12 m4" id="formConsFormat" method="POST" action=""> 
                                                <div class="" >
                                                    <h3><i class="material-icons prefix" style="font-size: 2.92rem">search</i> Consultar Formato</h3>
                                                    <div class="input-field col s12 m12 l12">
                                                        <i class="material-icons prefix">description</i>
                                                        <input id="cod_formato" name="cod_formato" type="text" maxlength="15" class="validate" required onkeyup="autocompletarFormato();">
                                                        <label for="cod_formato">Seleccione un formato</label>                           
                                                    </div>
                                                    <div class="col s12 m12 l12">
                                                        <ul id="tabla_formatos" class="collection">
                                                            <li class="collection-item avatar">
                                                                <div class="col l2 m3 s12">
                                                                    <a class="left grey-text text-lighten-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="VER" ><i class="large material-icons">description</i></a>
                                                                </div>
                                                                <div class="col l10 m9 s12">
                                                                    <p><strong>Test</strong></p>
                                                                    <p> Formato de prueba</p>
                                                                    <p> Observaciones foprmato</p>
                                                                    <p> Proccess</p>
                                                                    <p> Boss</p>
                                                                </div>
                                                                <a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Asignar" ><i class="material-icons">input</i></a>
                                                                <a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Desasignar" ><i class="material-icons">visibility_off</i></a>
                                                            </li>
                                                            <li class="collection-item avatar">
                                                                <div class="col l2 m3 s12">
                                                                    <a class="left grey-text text-lighten-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="VER" ><i class="large material-icons">description</i></a>
                                                                </div>
                                                                <div class="col l10 m9 s12">
                                                                    <p><strong>Test</strong></p>
                                                                    <p> Formato de prueba</p>
                                                                    <p> Observaciones foprmato</p>
                                                                    <p> Proccess</p>
                                                                    <p> Boss</p>
                                                                </div>
                                                                <a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Asignar" ><i class="material-icons">input</i></a>
                                                                <a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Desasignar" ><i class="material-icons">visibility_off</i></a>
                                                            </li>
                                                            <li class="collection-item avatar">
                                                                <div class="col l2 m3 s12">
                                                                    <a class="left grey-text text-lighten-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="VER" ><i class="large material-icons">description</i></a>
                                                                </div>
                                                                <div class="col l10 m9 s12">
                                                                    <p><strong>Test</strong></p>
                                                                    <p> Formato de prueba</p>
                                                                    <p> Observaciones foprmato</p>
                                                                    <p> Proccess</p>
                                                                    <p> Boss</p>
                                                                </div>
                                                                <a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Asignar" ><i class="material-icons">input</i></a>
                                                                <a class="btn-floating red hoverable tooltipped modal-trigger right" data-position="top" data-delay="50" data-tooltip="Desasignar" ><i class="material-icons">visibility_off</i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div>               
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <form method="post" action="Tabla.php">
                        <div class="formato form-group ui-state-default ">
                            <label >Untitled </label>
                            <input id="untitled" name="untitled" type="datetime-local" required/>
                        </div>
                        <button type="submit">send</button>
                    </form>
                </div>-->


        <div id="master-container" class="container">
            <div class="col-lg-4 col-sm-12 col-md-12 divMayor">
                <div id="pestañas">
                    <!-- Nav tabs -->
                    <ul id="myTabs" class="nav nav-tabs" role="tablist">
                        <li  role="presentation" class="active"><a id="pestañaElementos" href="#elementos" aria-controls="elementos" role="tab" data-toggle="tab">Elementos</a></li>
                        <li  role="presentation"><a id="pestañaPropiedades" href="#propiedades" aria-controls="propiedades" role="tab" data-toggle="tab">Propiedades</a></li>
                        <li role="presentation"><a id="pestañaFormulario" href="#formulario" aria-controls="formulario" role="tab" data-toggle="tab">Formulario</a></li>
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="elementos">                            
                            <div class="col-sm-6">
                                <button class="btn btn-default  btn-block new-element" data-type="element-text" style="width: 100%;">Campo de texto</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-paragraph-text" style="width: 100%;">Área de texto</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-multiple-choice" style="width: 100%;">Opciones</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-date" style="width: 100%;">Fecha</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-section-break" style="width: 100%;">Separador</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-default  btn-block new-element" data-type="element-number" style="width: 100%;">Campo numérico</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-checkboxes" style="width: 100%;">C. de verificación</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-dropdown" style="width: 100%;">Lista desplegable</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-time" style="width: 100%;">Hora</button>
                                <button class="btn btn-default  btn-block new-element" data-type="element-table" style="width: 100%;">Tabla</button>
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
                            <div id="celdas">

                            </div>
                            <br>
                            <div>
                                <button class="btn btn-danger btn-block" id="eliminar" name="eliminar" onclick="eliminar();">Eliminar elemento</button>
                            </div>                            
                        </div>
                        <div role="tabpanel" class="tab-pane" id="formulario">                    
                            <div>
                                <label>Detalle de la modificación</label>
                                <textarea type="text" class="form-control" id="detForm" placeholder="Indique aquí la naturaleza del cambio y demas detalles de la modificación del contenido."></textarea>
                            </div>
                            <div>
                                <label>Observaciones del formato</label>
                                <textarea type="text" class="form-control" id="obsForm" placeholder="Escribir la nueva versión del formato"></textarea>
                            </div>
                        </div>
                    </div>

                </div>               
            </div>
            <div class="col-lg-8 col-sm-12 col-md-12 divMayor" id="formBuilder">
                <table id="encabezado" style="width:100%;">
                    <tr>
                        <td ><h2> Nombre: Test</h2></td>
                        <td ><h2> Codigo: 001</h2></td>                    
                        <td ><img class="img-responsive" src="../util/images/corporativo/logo_ceramica.png" alt="Cerámica Italia"></td>
                    </tr>
                </table>
            </div>    
        </div>

    </body>


</html>