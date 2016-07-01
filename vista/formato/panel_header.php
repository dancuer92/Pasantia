<nav id="barraNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
            </button>
            <a class="navbar-brand" onclick="window.history.back();">Volver atrás</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
            <ul class="nav navbar-nav navbar-right"> 
                <li><a href="../index.php" > Inicio</a></li>
                <li><a href="../usuario.php" > Usuario</a></li>
                <li><a href="../formato.php" > Formato</a></li>
                <li><a href="../ayuda.php" target="_blank"> Ayuda</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: xx-large;"><strong><?php echo $_SESSION['nombre'] ?><span class="caret"></span></strong></a>
                    <ul class="dropdown-menu">                        
                        <li><a href="../../controlador/sesion/logoutUsuario.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


