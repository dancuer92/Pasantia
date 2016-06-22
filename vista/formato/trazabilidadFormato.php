<?php
session_start();
////Validamos si existe realmente una sesión activa o no 
if ($_SESSION["tipo"] !== "supervisor") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>

<html>
    <head>        
        <title>Trazabilidad Formato</title>

        <?php
        include 'head.php';
        ?>        
    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>

        <!--contenido-->
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">timeline</i> Trazabilidad del formato</h1>
            <div class="col-lg-7 col-xs-12 col-md-7">
                <div class="form-inline" id="fechas">
                    <?php
                    date_default_timezone_set('America/Bogota');
                    $fechaMin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 1));
                    $fechaAct = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
                    ?>
                    <div class="form-group">
                        <label>Fecha de inicio del análisis</label>
                        <input type="date" id="fechaInicio" name="fechaInicio" min="<?php echo$fechaMin ?>" max="<?php echo $fechaAct ?>" value="<?php echo $fechaAct ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Fecha de finalización del análisis</label>
                        <input type="date" id="fechaFin" name="fechaFin" min="<?php echo$fechaMin ?>" max="<?php echo $fechaAct ?>" value="<?php echo $fechaAct ?>"/>
                    </div>
                    <button onclick="mostrarForm();">Consultar</button>
                </div>



                <form id="visualizarFormato" hidden>
                </form>
                <!--<button id="modificarRegistro"type="button" class="btn btn-danger btn-lg center-block" onclick="">MODIFICAR</button>-->
            </div>

            <!--            <div class="col-lg-5">
                            <div  class="btn-group btn-group-justified" role="group">
                                <a type="button" class="btn btn-default">Izquierda</a>
                                <a type="button" class="btn btn-default">Centro</a>
                                <a type="button" class="btn btn-default">Derecha</a>
                            </div>                
                        </div>-->
            <div class="col-lg-5" id="resultado"> 
                <div id="timeline" style="height: auto;"></div>
            </div>
            <div class="col-lg-5" id="res1"></div>
        </main>

        <!-- Pie de pagina-->
        <footer>
            <div class="col-lg-12" id="footer">
                <?php
                include 'footer.php';
                ?>
            </div>
        </footer>

        <!--script-->
        <?php
        include 'script.php';
        ?>
        <script type="text/javascript" src="../util/js/loader.js"></script>
        <script type="text/javascript">
                        google.charts.load('current', {'packages': ['timeline']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var container = document.getElementById('timeline');
                            var chart = new google.visualization.Timeline(container);
                            var dataTable = new google.visualization.DataTable();

                            dataTable.addColumn({type: 'string', id: 'President'});
                            dataTable.addColumn({type: 'date', id: 'Start'});
                            dataTable.addColumn({type: 'date', id: 'End'});
                            dataTable.addRows([
                                ['Washington', new Date(1789, 3, 30), new Date(1797, 2, 4)],
                                ['Adams', new Date(1797, 2, 4), new Date(1801, 2, 4)],
                                ['Jefferson', new Date(1801, 2, 4), new Date(1809, 2, 4)]]);

                            chart.draw(dataTable);
                        }


                        $(document).ready(function () {
                            verFormato('analizar');
                        });

                        var datos = new Array();

                        function mostrarForm() {
                            var fechaIni = $('#fechaInicio').val();
                            var fechaFin = $('#fechaFin').val();
                            var clave = $(this).attr('name');

                            var formato = sessionStorage.getItem('formato');
                            if (fechaFin < fechaIni) {
                                toastr["error"]('Fecha de finalización mayor que la fecha de inicio');
                            }
                            else {
                                var d = new Array();
                                toastr["info"]('Hacer lo correcto');
                                $('#visualizarFormato').show();
                                $.post("../../controlador/Formato_controller.php", {formato: formato, clave: clave, inicio: fechaIni, fin: fechaFin, opcion: "trazabilidadFormato"},
                                function (mensaje) {
                                    $('#resultado').html('');
                                    var matriz = mensaje.split("||");
                                    var index;
                                    for (index in matriz) {
                                        var arr = matriz[index].split("~");
                                        var i = arr[1];
                                        var info = i.split("&");
                                        var index2;
                                        var arregloInfo = new Array();
                                        for (index2 in info) {
                                            var dato = info[index2].split("=");
                                            var clave = dato[0];
                                            var valor = dato[1];
                                            arregloInfo[clave] = valor;
                                        }
                                    }
                                });
                                datos = d;
                            }
                        }



        </script>
    </body>
</html>