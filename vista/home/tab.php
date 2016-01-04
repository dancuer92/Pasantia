<div class="row">
    <div class="col s12 ">
        <ul class="tabs flow-text" >
            <li class="tab col s3 " >
                <a id="testUsers" class="active icon-block" href="#test1"><i class="material-icons prefix" >people</i> usuarios</a>   
            </li>
            <li class="tab col s3">                        
                <a  id="testFormats" href="#test2" class="icon-block"><i class="material-icons prefix">description</i> formatos</a>
            </li>
        </ul>
    </div>

    <!--seccion de usuarios-->
    <?php
    $tipo = $_SESSION['tipo'];
    if ($tipo === 'admin') {
        include '../admin/gestionUsuarioAdmin.php';
        include '../admin/gestionFormatoAdmin.php';        
    }
    if ($tipo === 'operator') {
        include '../operator/gestionUsuarioOper.php';
        ?><div id="test2" class="col s12">Formatos Oper</div><?php
    }
    ?>        
</div>

<script>
    $('#testUsers').click(function () {
        $('#mobileFormatos').hide();
        $('#mobileUsuarios').show();
    });
    $('#testFormats').click(function () {        
        $('#mobileUsuarios').hide();
        $('#mobileFormatos').show();
    });
</script>