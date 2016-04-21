<div class="row">
    <div class="col s12">
        <div id="test1" class="col s12"><br>    
            <div class="col l3 row hide-on-med-and-down">
                <ul class="collection">
                    <li class="collection-item">
                        <a href="?MiPerfil" id="perfil" class=" colorTexto">
                            <i class="material-icons">account_box</i>
                            Mi perfil
                        </a>
                    </li>            
                    <li class="collection-item">
                        <a href="?CambiarPassword" id="cambiar" class=" colorTexto">
                            <i class="material-icons">lock_open</i>
                            Cambiar contraseña
                        </a>
                    </li>
                    <li class="collection-item">
                        <a href="?RegistrarUsuario" id="registrar" class=" colorTexto" >
                            <i class="material-icons">person_add</i>
                            Registrar usuario
                        </a>
                    </li>
                    <li class="collection-item">
                        <a href="?ConsultarUsuario" id="consultar" class=" colorTexto" >
                            <i class="material-icons">search</i>
                            Consultar usuario
                        </a>
                    </li>
                </ul>               
            </div>
            <div class="col l9 m12 s12">
                <div class="collection" style="overflow: visible">
                    <?php
                    $seccion = basename($_SERVER['QUERY_STRING']);
                    if (empty($seccion)) {
                        include './usuario/miPerfil.php';
                    } else {
                        $imp = 0;
                        switch ($seccion) {
                            case 'MiPerfil':
                                $imp = 1;
                                include './usuario/miPerfil.php';
                                break;
                            case 'CambiarPassword':
                                $imp = 1;
                                include './usuario/cambiarPassword.php';
                                break;
                            case 'RegistrarUsuario':
                                $imp = 1;
                                include './usuario/registrarUsuario.php';
                                break;
                            case 'ConsultarUsuario':
                                $imp = 1;
                                include './usuario/consultarUsuario.php';
                                break;
                        }
                        if ($imp === 0) {
                            include './user/pageNotFound.php';
                        }
                    }
                    ?> 
                </div>
            </div>               
        </div>
    </div>
</div>

<div id="mobileUsuarios" class="fixed-action-btn hide-on-large-only" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">group</i>
    </a>
    <ul>
        <li><a id="perfilM" href="?MiPerfil" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Mi perfil"><i class="material-icons" >account_box</i></a></li>
        <li><a id="cambiarM" href="?CambiarPassword" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Cambiar contraseña"><i class="material-icons" >lock_open</i></a></li>
        <li><a id="registrarM" href="?RegistrarUsuario" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Registrar Usuario"><i class="material-icons" >person_add</i></a></li>
        <li><a id="consultarM" href="?ConsultarUsuario" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Consultar usuario"><i class="material-icons" >search</i></a></li>
    </ul>
</div>

