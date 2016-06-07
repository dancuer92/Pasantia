<?php
session_start();
////Validamos si existe realmente una sesión activa o no 

if ($_SESSION["tipo"] !== "supervisor" && $_SESSION["tipo"] !== "operario") {
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión)
    header("Location: ../../index.php");
    exit();
}
?>

<html>
    <head>

        <title>Registros Formato</title>
        <?php
        include 'head.php';
        ?>
        <link rel="stylesheet" type="text/css" href="../util/css/datatables.css"/>        
    </head>
    <body>
        <!-- Encabezado-->
        <header>
            <?php include_once './panel_header.php'; ?>
        </header>

        <main>
            <h1 class="titulo"><i class="material-icons prefix" style="font-size: 43px">find_in_page</i> Mostrar histórico de registros del formato</h1>
            <div id="master-container" class="container">
                <!--<div class="table-responsive">-->
                <table id="mostrarRegFormato" class="table table-hover compact cell-border">
                    <thead>
                        <tr>
                            <th>Fecha del sistema</th>
                            <th>Usuario</th>
                            <th>Fecha del formato</th>
                            <th>Estado del registro</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>  
                <!--</div>-->
            </div>
        </main>

        <!-- Pie de pagina-->
        <footer>
            <div class="text-center text-muted">
                <h6 >Copyright © Cerámica Italia S.A. 2015</h6>
                <h6 >Avda 3 Calle 23AN Zona Industrial. Cúcuta, Norte de Santander, Colombia.
                    <br>+57-7-5829800 - 018000111568</h6>                    
            </div>
        </footer>

        <!--script-->
        <?php
        include 'script.php';
        ?>
        <script type="text/javascript" src="../util/js/datatables.js"></script>
        <script>
            $(document).ready(function () {
                var formato = sessionStorage.getItem('formato');
                var mensaje = sessionStorage.getItem('mensaje');
                console.log(mensaje);
                if (mensaje !== null) {
                    toastr["info"](mensaje);
                    sessionStorage.removeItem('mensaje');
                }
                $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "mostrarRegistrosFormato"},
                function (mensaje) {
                    $('#mostrarRegFormato tbody').append(mensaje);
                    
                    $('#mostrarRegFormato').DataTable({
                        responsive: true,
                        order: [[0, "desc"]],
                        language: {
                            processing: "Procesando",
                            lengthMenu: "Mostrar _MENU_ registros por página",
                            zeroRecords: "Registros no encontrados",
                            info: "Mostrar página _PAGE_ de _PAGES_",
                            infoEmpty: "No hay registros disponibles",
                            infoFiltered: "(Búsqueda realizada en _MAX_ registros)",
                            search: "Buscar",
                            paginate: {
                                first: "Primero",
                                last: "Último",
                                next: "Siguiente",
                                previous: "Anterior"
                            },
                            oAria: {
                                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                                sortDescending: ": Activar para ordenar la columna de manera descendente"
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>