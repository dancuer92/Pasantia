<div id="test2" class="col s12"><br>    
    <div class="col l3 row hide-on-med-and-down">
        <ul class="collection">
            <li class="collection-item">
                <a href="#RegistrarFormato" id="registrarF" class=" colorTexto">
                    <i class="material-icons">note_add</i>
                    Crear formato
                </a>
            </li>            
            <li class="collection-item">
                <a href="#ModificarFormato" id="modificarF" class=" colorTexto">
                    <i class="material-icons">build</i>
                    Modificar formato
                </a>
            </li>            
            <li class="collection-item">
                <a href="#AsignarFormato" id="asignarF" class=" colorTexto">
                    <i class="material-icons">input</i>
                    Asignar formato
                </a>
            </li>
            <li class="collection-item">
                <a href="#ConsultarFormato" id="consultarF" class=" colorTexto" >
                    <i class="material-icons">search</i>
                    Consultar formato
                </a>
            </li>
            <li class="collection-item">
                <a href="#DiligenciarFormato" id="diligenciarF" class=" colorTexto" >
                    <i class="material-icons">keyboard</i>
                    Diligenciar formato
                </a>
            </li>
        </ul>               
    </div>
    <div class="col l9 m12 s12">
        <div class="collection">            
            <?php
            include_once './formato/registrarFormato.php';
//            include_once 'modificarFormato.php';
            include_once './formato/asignarFormato.php';
            include_once './formato/consultarFormato.php';
//            include_once 'diligenciarFormato.php';
            ?>
        </div>
    </div>               
</div>

<div id="mobileFormatos" class="fixed-action-btn hide-on-large-only " style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large red">
        <i class="large material-icons">description</i>
    </a>
    <ul>
        <li><a id="registrarFM" href="#RegistrarFormato" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Crear formato"><i class="material-icons" >note_add</i></a></li>
        <li><a id="modificarFM" href="#ModificarFormato" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Modificar formato"><i class="material-icons" >build</i></a></li>
        <li><a id="asignarFM" href="#AsignarFormato" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Asignar Formato"><i class="material-icons" >input</i></a></li>
        <li><a id="consultarFM" href="#ConsultarFormato" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Consultar formato"><i class="material-icons" >search</i></a></li>
        <li><a id="diligenciarFM" href="#DiligenciarFormato" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Diligenciar formato"><i class="material-icons" >keyboard</i></a></li>
    </ul>
</div>