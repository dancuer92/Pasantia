<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

        <title>Sistema Integrado de Gestión a la calidad de Cerámica Italia S.A.</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" type="text/css">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" type="text/css">

        <!--<link href="../util/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
        <!--<link href="vista/util/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
        <link rel="shortcut icon" href="../util/images/corporativo/icono_ceramica.ico">

        <!--  Scripts-->
        <script src="../util/js/jquery-2.1.4.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>-->
        <script>
            $(document).ready(function () {
                $('#diligenciarFormato').DataTable();
            });
        </script>


    </head>
    <body>     
        <div  class="container">
            <table id="diligenciarFormato" class="highlight">
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
        </div>
    </body>


</html>