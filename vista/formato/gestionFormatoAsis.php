<div class="row">
    <div class="col s12">
        <div id="test2" class="col s12"><br>    
            <div class="col l3 row hide-on-med-and-down">
                <ul class="collection">                    
                    <li class="collection-item">
                        <a href="?ConsultarFormato" id="consultarF" class=" colorTexto" >
                            <i class="material-icons">search</i>
                            Consultar formato
                        </a>
                    </li>            
                    <li class="collection-item" >
                        <a href="?RegistrarFormato" id="registrarF" class=" colorTexto">
                            <i class="material-icons">note_add</i>
                            Crear formato
                        </a>
                    </li>
                </ul>               
            </div>
            <div class="col l9 m12 s12">
                <div class="collection">
                    <?php
                    $seccion = basename($_SERVER['QUERY_STRING']);
                    if (empty($seccion)) {
                        include './formato/consultarFormato.php';
                    } else {
                        $imp = 0;
                        switch ($seccion) {
                            case 'ConsultarFormato':
                                $imp = 1;
                                include './formato/consultarFormato.php';
                                break;
                            case 'RegistrarFormato':
                                $imp = 1;
                                include './formato/registrarFormato.php';
                                break;
                        }
                        if ($imp === 0) {
                            include './user/pageNotFound.php';
//                            echo $seccion . (': No existe esta sección');
                        }
                    }
                    ?>                     
                </div>
            </div>               
        </div>

        <div id="mobileFormatos" class="fixed-action-btn hide-on-large-only " style="bottom: 45px; right: 24px;">
            <a class="btn-floating btn-large red">
                <i class="large material-icons">description</i>
            </a>
            <ul>
                <li><a href="?ConsultarFormato" id="consultarFM" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Consultar formato"><i class="material-icons" >search</i></a></li>
                <li><a href="?RegistrarFormato" id="registrarFM" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Crear formato"><i class="material-icons" >note_add</i></a></li>
            </ul>
        </div>
    </div>
</div>

