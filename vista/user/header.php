<div class="navbar-fixed">
    <nav>
        <!--  div de la barra de navegación móvil -->
        <div class="nav-wrapper "  id="navbarUsers">            
            <a href="#" data-activates="mobile-demo" class="button-collapse waves-effect waves-light"><i class="material-icons" style="color: #DE0000">menu</i></a>
            <a href="index.php" class="brand-logo waves-effect waves-light"><img class="responsive-img" src="<?php echo $logo ?>" alt="Cerámica Italia" ></a>


            <ul class="right hide-on-med-and-down"> 
                <li><a href="index.php" class="waves-effect waves-light colorTexto" style="font-size: 1.2rem;"> Inicio</a></li>
                <li><a href="usuario.php" class="waves-effect waves-light colorTexto" style="font-size: 1.2rem;"> Usuario</a></li>
                <li><a href="formato.php" class="waves-effect waves-light colorTexto" style="font-size: 1.2rem;"> Formato</a></li>
                <li><a href="ayuda.php" target="_blank" class="waves-effect waves-light colorTexto" style="font-size: 1.2rem;"> Ayuda</a></li>
                <!-- Dropdown Trigger -->
                <li>                    
                    <a class="dropdown-button colorTexto" data-beloworigin="true" href="#!" data-activates="dropdown1">
                        <strong ><?php echo($_SESSION['nombre']); ?></strong>
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>                
            </ul>


            <ul class="side-nav " id="mobile-demo">
                <li><a href="index.php" class="waves-effect waves-light "> Inicio</a></li>
                <li><a href="usuario.php" class="waves-effect waves-light "> Usuario</a></li>
                <li><a href="formato.php" class="waves-effect waves-light "> Formato</a></li>
                <li><a href="ayuda.php" target="_blank" class="waves-effect waves-light "> Ayuda</a></li>
                <li class="divider"></li>
                <li><a class="waves-effect waves-red " href="../controlador/sesion/logoutUsuario.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
</div>

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content " >   
    <li><a href="../controlador/sesion/logoutUsuario.php">Cerrar sesión</a></li>
</ul>