<?php
session_start();
////Validamos si existe realmente una sesión activa o no 
if ($_SESSION["tipo"] !== "supervisor" && $_SESSION["tipo"] !== "operario") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
//include '../../controlador/sesion/seguridadTiempo.php';
?>

<html>
    <head>
        <title>Diligenciar Formato</title>
        <?php
        include 'head.php';
        ?>
    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>
        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">keyboard</i> Diligenciar formato</h1>
            <div class="container center">
                <div id="fecha" class="right-block">
                    <p>
                        Fecha del sistema: 
                        <?php
                        date_default_timezone_set('America/Bogota');
                        $fechaSistema = date('Y/m/d H:i:s', time());
                        echo $fechaSistema;
                        ?>
                    </p>                    
                </div>
                <form id="visualizarFormato"></form>
                <div class="col-lg-12 col-sm-12 col-md-12 divMayor" id="guardarFormato">
                    <button class="btn btn-danger btn-lg center-block" id="saveFormato" data-toggle="modal" data-target="#myModal">GUARDAR</button>
                </div>
            </div>

            <div id="res1"></div>
        </main>
        <!-- Pie de pagina-->
        <footer>
            <?php
            include 'footer.php';
            ?>
        </footer>

        <!--Modal-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">¿Desea guardar la información?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Haga clic en CANCELAR si desea realizar algún cambio.<br>
                            Una vez hecho clic en ACEPTAR, tiene permiso para realizar modificaciones durante el turno</p>
                    </div>
                    <div class="modal-footer">
                        <!--<a type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</a>-->
                        <button class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                        <!--<a type="button" class="btn btn-danger" onclick="guardarDiligenciaFormato('registrar', '');">ACEPTAR</a>-->
                        <!--<button form="visualizarFormato" class="btn btn-danger" onclick="guardarDiligenciaFormato('registrar', '');">ACEPTAR</button>-->
                        <button class="btn btn-danger" onclick="guardarDiligenciaFormato('registrar', '');">ACEPTAR</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!--script--> 
        <?php
        include 'script.php';
        ?>
        <script>
            $(document).ready(function () {
                verFormato('diligenciar');
                sessionStorage.setItem('observaciones', '' );
                sessionStorage.setItem('user', '<?php echo $_SESSION["codigo"]?>' );
            });
        </script>
    </body>
</html>