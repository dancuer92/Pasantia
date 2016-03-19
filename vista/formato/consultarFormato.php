
<div id="consultarFormat" class="contenido">
    <form class="s12 m4" id="formConsFormat" method="POST" action=""> 
        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">search</i> Consultar Formato</h3>
            <div class="input-field col s12 m12 l12">
                <i class="material-icons prefix">description</i>
                <input id="cod_formato" name="cod_formato" type="text" maxlength="15" class="validate" required onkeyup="autocompletarFormato();">
                <label for="cod_formato">Seleccione un formato</label>                           
            </div>
            <div class="col s12 m12 l12">
                <ul id="tabla_formatos" class="collection"></ul>
            </div>
        </div>
    </form>
</div>
<?php
    include './formato/modalAsignar.php';
?>