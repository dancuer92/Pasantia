
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Sistema de registro de información de la calidad CISA</title>

        <!-- CSS  -->
        <link href="vista/util/css/material-icons.css" rel="stylesheet">
        <link href="vista/util/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="vista/util/css/toastr.css" type="text/css" rel="stylesheet"/>
        <!--<link href="vista/util/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>-->
        <link rel="shortcut icon" href="vista/util/images/corporativo/icono_ceramica.ico">
    </head>
    <body>       

        <!-- div de la barra de navegación fija, header-->
        <?php
        $logo = "vista/util/images/corporativo/logo_ceramica.png";
        $home = "index.php";
        include 'vista/index/navBar.php';
        ?>

        <!-- banner inicio de sesion-->
        <?php include 'vista/index/banner.php'; ?>

        <!-- modal-fixed-footer, inicio de sesion-->
        <?php include 'vista/index/modalInicioSesion.php'; ?>

        <!-- modal-fixed-footer, cambio contraseña-->
        <?php // include 'vista/index/modalCambioPass.php'; ?>

        <!-- container, informacion de la pagina-->
        <?php include 'vista/index/containerPageInfo.php'; ?>        

        <!-- Footer de la pagina -->
        <?php
        $ruta = "vista/util/images/corporativo/";
        include 'vista/index/footer.php';
        ?>        

        <!--  Scripts-->
        <script src="vista/util/js/jquery-2.1.4.min.js"></script>
        <script src="vista/util/js/materialize.js"></script>
        <script src="vista/util/js/init.js"></script>
        <script src="vista/util/js/toastr.js"></script>
        <script type="text/javascript">


            /**
             * Acción para enviar el formulario de inicio de sesión de un usuario
             * @param {type} param
             */
            $('#formIniUser').submit(function (event) {
                event.preventDefault();
                initUser();
            });

            function initUser() {
                var nombre = $('#nombre').val();
                var pass = $('#password').val();
                $("#loading").show();

                $.post("controlador/Sesion_controller.php", {nombre: nombre, pass: pass},
                function (mensaje) {
                    var msj;
                    switch (mensaje) {
                        case '-1':
                            msj = 'Nombre de usuario o contraseña incorrectos';
                            break;
                        case '0':
                            msj = 'Usuario inactivo en el sistema';
                            break;
                        case '1':
                            location.href = "vista/index.php";
                            msj = 'Inicio de sesión exitoso';
                            break;
                        case '2':
                            msj = 'Su contraseña ha caducado';
                            break;
                    }
                    toastr["info"](msj);
                    $("#loading").hide();
                });


            }
        </script>
    </body>
</html>
