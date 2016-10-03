<?php
session_start();
////Validamos si existe realmente una sesión activa o no 

if ($_SESSION["tipo"] !== "supervisor" && $_SESSION["tipo"] !== "operario") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
include '../../controlador/sesion/seguridadTiempo.php';
?>
<html>
    <head>        
        <title>Mostrar Registro</title>

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
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">find_in_page</i> Mostrar registro del formato</h1>
            <div class="container center">   
                <form id="visualizarFormato" >
                </form>
                <button id="modificarRegistro" class="btn btn-danger btn-lg center-block" onclick="modificarDiligenciaFormato();">MODIFICAR</button>
                <button id="guardarRegistro" class="btn btn-danger btn-lg center-block" onclick="guardarMR();">GUARDAR</button>
            </div>
            <div id="res1"></div>
        </main>

        <!-- Pie de pagina-->
        <footer>
            <?php
            include 'footer.php';
            ?>
        </footer>

        <!--script-->
        <?php
        include 'script.php';
        ?>
        <script>
            var valorAnterior;
            $(document).ready(function () {
//                debugger;
//                console.log('pendiente de entrar');
                cargarRegistro2();
//                console.log('salio del metodo de mostrar')
                $('#guardarRegistro').hide();                
                sessionStorage.setItem('observaciones', '');
            });
            
            $('#visualizarFormato').on('click', 'input', function () {                
                valorAnterior = $(this).val();
//                console.log(valorAnterior);
            });

            $("#visualizarFormato").on('change', 'input', function () {
                var observaciones = sessionStorage.getItem('observaciones');
                var nombre = $(this).attr("name");
                var valorNuevo = $(this).val();
                if (valorNuevo !== valorAnterior) {
                    if (valorAnterior === '') {
                        valorAnterior = 'NULO';
                    }
                    if (valorNuevo === '') {
                        valorNuevo = 'NULO';
                    }
                    var observacion = " Se ha actualizado el campo: " + nombre + ", cuyo valor anterior es: " + valorAnterior + ", y su valor actual es: " + valorNuevo + ". ";
                    observaciones += observaciones + observacion;
                    sessionStorage.setItem('observaciones', observacion);
//                    console.log(observacion);
                }
            });
        </script>
    </body>
</html>