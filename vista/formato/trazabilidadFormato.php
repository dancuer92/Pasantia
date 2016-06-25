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
            <div id="chart-container">FusionCharts XT will load here!</div>
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
        <script type="text/javascript" src="../util/js/fusioncharts.js"></script>
        <script type="text/javascript" src="../util/js/fusioncharts-jquery-plugin.js"></script>

        <script type="text/javascript">
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
                                        console.log(arregloInfo);
                                        d[i] = new Array(arr[0], arregloInfo);
                                    }
                                });
                                datos = d;
                            }

                        }
                        ;

                        $('#visualizarFormato').on('click', 'input[type="button"]', function () {
                            console.log(datos);
                            var input = $(this);
                            var label = input.parent('div').children('label').text();
                            var clave = input.attr('name');
                            var mensaje = '<h3>Se ha seleccionado ' + label + ' para su análisis</h3><br>';
                            var arregloInfo = new Array();
                            for (var index in datos) {
//                                arregloInfo = datos[index][1];
                                arregloInfo[index] = new Array(datos[index][0], datos[index][1][clave]);
                                mensaje += datos[index][0] + '~' + datos[index][1][clave] + '<br>';
                            }
                            $('#resultado').html(mensaje);
                            timeLine(label, arregloInfo);
                        });


                        function timeLine(titulo, info) {
                            var fechaIni = $('#fechaInicio').val();
                            var fechaFin = $('#fechaFin').val();
                            var categoria = '[';
                            var tarea = '[';
                            var procesos = new Array();
                            for (var index in info) {
                                var f = new Date(info[index][0]);
                                var dd = (f.getDate() < 10 ? '0' : '') + f.getDate();
                                var mm = ((f.getMonth() + 1) < 10 ? '0' : '') + (f.getMonth() + 1);
                                var fecha1 = f.getFullYear() + '-' + mm + '-' + dd + ' 00:00:00';
                                var fecha2 = f.getFullYear() + '-' + mm + '-' + dd + ' 23:59:59';
                                categoria += '{"start":"' + fecha1 + '", "end":"' + fecha2 + '", "label":"' + f.getFullYear() + '-' + mm + '-' + dd + '"},';
                                tarea += '{"processid":"' + info[index][1] + '","start":"' + fecha1 + '","end":"' + fecha2 + '","label":"' + info[index][0] + '", "id":"'+index+'","height":"25%","toppadding": "22%"},';


                                var flag = false;
                                for (var p in procesos) {
                                    if (procesos[p] === info[index][1]) {
                                        flag = true;
                                        break;
                                    }
                                }
                                if (!flag) {
                                    procesos.push(info[index][1]);
                                }


                            }
                            tarea += ']';
                            tarea = tarea.replace(',]', ']');
                            var tareas = JSON.parse(tarea);
//                            console.log(tarea);

                            categoria += ']';
                            categoria = categoria.replace(',]', ']');
                            var categorias = JSON.parse(categoria);
//                            console.log(categoria);

                            var process = '[';
                            for (var p in procesos) {
                                process += '{"label": "' + procesos[p] + '","id": "' + procesos[p] + '"},';
                            }
                            process += ']';
                            process = process.replace(',]', ']');
                            var pro = JSON.parse(process);
//                            console.log(process);


                            $("#chart-container").insertFusionCharts({
                                type: 'gantt',
                                renderAt: 'chart-container',
                                width: '650',
                                height: '400',
                                dataFormat: 'json',
                                dataSource: {
                                    "chart": {
                                        "caption": "Se ha seleccionado " + titulo + " para su análisis",
                                        "subcaption": "Desde " + fechaIni + " hasta " + fechaFin,
                                        "dateformat": "yyyy-mm-dd hh:mn:ss",
                                        "outputDateFormat": "ddds mnl, yyyy hh12:mn ampm",
                                        "canvasBorderAlpha": "30",
                                        "theme": "fint"
                                    },
                                    "categories": [{
                                            "category": categorias
                                        }],
                                    "processes": {
                                        "fontsize": "12",
                                        "isbold": "1",
                                        "align": "left",
                                        "headertext": titulo,
                                        "headerfontsize": "14",
                                        "headervalign": "middle",
                                        "headeralign": "left",
                                        "process": pro
                                    },
                                    "tasks": {
                                        "showlabels": "1",
                                        "task": tareas
                                    }
                                }
                            });
                        }
                        ;
        </script>
    </body>
</html>