<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

        <title>Sistema Integrado de Gestión a la calidad de Cerámica Italia S.A.</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" type="text/css">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" type="text/css">
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
        <script src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
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
        <div  class="container">
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
        </div>
    </body>


</html>