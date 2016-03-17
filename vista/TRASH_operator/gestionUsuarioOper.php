<div class="row">
    <div class="col s12">
        <div id="test1" class="col s12"><br>    
            <div class="col l3 row hide-on-med-and-down">
                <ul class="collection">
                    <li class="collection-item">
                        <a href="#MiPerfil" id="perfil"class=" colorTexto">
                            <i class="material-icons">account_box</i>
                            Mi perfil
                        </a>
                    </li>            
                    <li class="collection-item">
                        <a href="#CambiarContraseña" id="cambiar" class=" colorTexto">
                            <i class="material-icons">lock_open</i>
                            Cambiar contraseña
                        </a>
                    </li>
                </ul>               
            </div>
            <div class="col l9 m12 s12">
                <div class="collection">            
                    <?php
                    include_once './user/miPerfil.php';
                    include_once './user/cambiarPassword.php';
                    ?>

                </div>               
            </div>
        </div>
    </div>
</div>

<div class="fixed-action-btn hide-on-large-only" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Mi perfil"><i class="material-icons" id="perfilM" href="#MiPerfil">account_box</i></i></a></li>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Cambiar contraseña"><i class="material-icons" id="cambiarPasswordM" href="#CambiarPassword">lock_open</i></i></a></li>
    </ul>
</div>


