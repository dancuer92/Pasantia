<?php
//session_start();
?>


<div class="navbar-fixed">
    <nav>
        <!--  div de la barra de navegación móvil -->
        <div class="nav-wrapper"  id="navbarUsers">
            <a href="#" data-activates="mobile-demo" class="button-collapse waves-effect waves-light"><i class="material-icons" style="color: #DE0000">menu</i></a>
            <a href="<?php echo $home ?>" class="brand-logo waves-effect waves-light"><img class="responsive-img" src="<?php echo $logo ?>" alt="Cerámica Italia" ></a>

            <ul class="right hide-on-med-and-down">
                <!-- Dropdown Trigger -->
                <li>
                    <a class="dropdown-button colorTexto" data-beloworigin="true" href="#!" data-activates="dropdown1">
                        <strong ><?php echo($_SESSION['nombre']); ?></strong>
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
            </ul>


            <ul class="side-nav colorTexto" id="mobile-demo">
                <li class="divider"></li>
                <li><a class="waves-effect waves-red colorTexto" href="../../controlador/sesion/logoutUsuario.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
</div>

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content colorTexto" >   
    <li><a href="../../controlador/sesion/logoutUsuario.php">Cerrar sesión</a></li>
</ul>