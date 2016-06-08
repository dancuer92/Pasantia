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

            <div class="col-lg-5">
                <div  class="btn-group btn-group-justified" role="group">
                    <a type="button" class="btn btn-default">Izquierda</a>
                    <a type="button" class="btn btn-default">Centro</a>
                    <a type="button" class="btn btn-default">Derecha</a>
                </div>
                <div id="resultado">                    
                </div>
            </div>
            <div id="res1"></div>
        </main>

        <!-- Pie de pagina-->
        <footer>
            <div class="text-center text-muted col-lg-12">
                <h6 >Copyright © Cerámica Italia S.A. 2015</h6>
                <h6 >Avda 3 Calle 23AN Zona Industrial. Cúcuta, Norte de Santander, Colombia.
                    <br>+57-7-5829800 - 018000111568</h6>                    
            </div>
        </footer>

        <!--script-->
        <?php
        include 'script.php';
        ?>
        <script>
            $(document).ready(function () {
                verFormato('analizar');
            });
            var datos;

            function mostrarForm() {
                var fechaIni = $('#fechaInicio').val();
                var fechaFin = $('#fechaFin').val();
                var clave = $(this).attr('name');
                console.log(fechaIni);
                console.log(fechaFin);

                var formato = sessionStorage.getItem('formato');
                if (fechaFin < fechaIni) {
                    toastr["error"]('Fecha de finalización mayor que la fecha de inicio');
                }
                else {
                    toastr["info"]('Hacer lo correcto');
                    $('#visualizarFormato').show();
                    $.post("../../controlador/Formato_controller.php", {formato: formato, clave: clave, inicio: fechaIni, fin: fechaFin, opcion: "trazabilidadFormato"},
                    function (mensaje) {
                        $('#resultado').html('');
                        datos = mensaje;
                    });
                }
            }

            $('#visualizarFormato').on('click', 'input[type="button"]', function () {
                $('#resultado').append(datos);
            });

        </script>
    </body>
</html>