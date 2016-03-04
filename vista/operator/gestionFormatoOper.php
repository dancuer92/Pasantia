<div id="formato" class="col s12"><br>    
    <div class="col l3 row hide-on-med-and-down">
        <ul class="collection">            
            <li class="collection-item">
                <a href="?ConsultarFormato" id="consultarFormat" class=" colorTexto" >
                    <i class="material-icons">search</i>
                    Consultar formato
                </a>
            </li>
            <li class="collection-item">
                <a href="?DiligenciarFormato" id="diligenciarFormat" class=" colorTexto" >
                    <i class="material-icons">keyboard</i>
                    Diligenciar formato
                </a>
            </li>
        </ul>               
    </div>
    <div class="col l9 m12 s12">
        <div class="collection">
            <?php
            $seccion = basename($_SERVER['QUERY_STRING']);
            if (empty($seccion)) {
                include '../home/miPerfil.php';
            } else {
                $imp = 0;
                switch ($seccion) {                    
                    case '?ConsultarFormato':
                        $imp = 1;
                        include 'registrarUsuario.php';
                        break;
                    case '?DiligenciarFormato':
                        $imp = 1;
                        include 'consultarUsuario.php';
                        break;
                }
                if ($imp === 0) {
                    echo $seccion + (': No existe esta sección');
                }
            }
            ?>
<!--            <div id="miPerfil" class="contenido">
                <?php // include_once '../home/miPerfil.php' ?>
                
            </div>              
            <div id="cambiarPassword" class="contenido">
                <?php // include_once '../home/cambiarPassword.php' ?>
            </div>
            <div id="registrarUser" class="contenido">
                <?php // include_once 'registrarUsuario.php' ?>
            </div>
            <div id="consultarUser" class="contenido">
                <?php // include_once 'consultarUsuario.php' ?>
            </div>-->
        </div>               
    </div>
</div>

<div id="mobileFormatos" class="fixed-action-btn hide-on-large-only " style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">description</i>
    </a>
    <ul>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Crear ó modificar formato"><i class="material-icons" id="perfilM" href="#Formato">build</i></a></li>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Asignar Formato"><i class="material-icons" id="cambiarPasswordM" href="#AsignarFormato">input</i></a></li>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Consultar formato"><i class="material-icons" id="registrarM" href="#ConsultarFormato">search</i></a></li>
        <li><a class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Diligenciar formato"><i class="material-icons" id="consultarM" href="#DiligenciarFormato">keyboard</i></a></li>
    </ul>
</div>