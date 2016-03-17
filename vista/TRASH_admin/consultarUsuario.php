<!--<form  class="s12 m4" method="POST">-->
<div id="consultarUser" class="contenido">
    <div class="center" >
        <h3><i class="material-icons prefix" style="font-size: 2.92rem">search</i> Consultar Usuario</h3>
        <div class="input-field col s12 m12 l12">
            <i class="material-icons prefix">person_pin</i>
            <input type="hidden" name="codigoBuscar" id="codigoBuscar" value="<?php echo $_SESSION['codigo'] ?>">
            <input type="text" name="busquedaUsuario" id="busquedaUsuario" value="" placeholder="" maxlength="30" autocomplete="off" onKeyUp="buscarUsuario();"/> 
            <label for="busquedaUsuario">Número de identificación o nombre del usuario a buscar</label>                                                      
        </div> 
    </div>
    <div id="resultadoBusquedaUsuario"></div>
</div>   
<!--</form>-->

