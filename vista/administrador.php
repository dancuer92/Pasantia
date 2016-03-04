<?php
include("../controlador/sesion/seguridadUsuarioAdmin.php");
$codigo_sesion = $_SESSION['codigo'];
?>
<html>
    <head> 
        <title>Administrador</title> 

        <!--import de la cabecera de la pagina -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Starter Template - Materialize</title>

        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="util/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="util/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link rel="shortcut icon" href="util/images/corporativo/icono_ceramica.ico">

        <!-- Scripts de la pagina -->
        <script src="util/js/jquery-2.1.4.min.js"></script>
        <script src="util/js/materialize.js"></script> 
        <script src="util/js/jsAdmin.js"></script>

    </head> 
    <body>
        <header id="encabezado">
            <?php
            $logo = "util/images/corporativo/logo_ceramica.png";
            $home = "../index.php";
            include 'header.php';
            ?>
        </header>


        <main class="container">
            <div class="section">
                <!--   Icon Section   -->
                <div class="row" id="administrador">
                    <div class="col s12 m6">
                        <a href="">
                            <div class="icon-block">
                                <h2 class="center"><i class="material-icons">group</i></h2>
                                <h5 class="center">GESTIÓN DE USUARIOS</h5>
                                <p class="flow-text">Módulo para la modificación del perfil, cambio de contraseña, el registro y consulta de usuarios. </p>
                            </div>
                        </a>
                    </div>

                    <div class="col s12 m6">
                        <a href="">
                            <div class="icon-block">
                                <h2 class="center"><i class="material-icons">description</i></h2>
                                <h5 class="center">GESTIÓN DE FORMATOS</h5>
                                <p class="flow-text">Módulo para el registro de formatos, asignación de formatos a usuarios, consulta de formatos y diligenciamiento de formatos. </p>
                            </div>
                        </a>
                    </div>           

                </div>
                <br><br>

                <div class="section">

                </div>
            </div>
        </main>

        <footer id="footer">
            <?php
            $ruta = "util/images/corporativo/";
            include 'footer.php';
            ?>
        </footer>
    </body>
</html>