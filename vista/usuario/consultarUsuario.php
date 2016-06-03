<!--<form  class="s12 m4" method="POST">-->
<div id="consultarUser" class="contenido">
    <div class="center" >
        <h3><i class="material-icons prefix" style="font-size: 2.92rem">search</i> Consultar Usuario</h3>
        <div class="input-field col s12 m12 l12">
            <i class="material-icons prefix">person_pin</i>
            <input type="hidden" name="codigoBuscar" id="codigoBuscar" value="<?php echo $_SESSION['codigo'] ?>">
            <input type="text" name="busquedaUsuario" id="busquedaUsuario" value="" maxlength="30" autocomplete="off" onKeyUp="buscarUsuario();"/> 
            <label for="busquedaUsuario">Usuario de red o nombre del usuario</label>                                                      
        </div> 
    </div>
    <div id="resultadoBusquedaUsuario"></div>
</div>   
<!--</form>-->

<!-- modal-fixed-footer -->
<div id="modalCambioContraseña" class="modal center" >
    <div id="modalCambio" class="s12" method="POST">
        <div class="modal-content">
            <h4>Cambio contraseña de usuario</h4>
            <div>
                <div class="row">                    
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock_open</i>
                        <input id="password_usuario" name="password_usuario" length="50" type="text" pattern="(?=.*[0-9])(?=.*[^-+._,*/])(?=.*[^a-z]).{8,50}" title="La contraseña debe ser mayor a ocho(8) caracteres y debe contener al menos un número y un caracter especial(+ - . _ , * /)" class="validate" required>
                        <!--<input id="password" name="password" type="text" class="validate" required>-->
                        <label for="password_usuario">Nueva contraseña</label>                                                      
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Footer de Inicio de sesión-->
        <div class="modal-footer">
<!--            <a id="c<buttonambiarContraseña" class="modal-action btn red waves-effect waves-light hoverable colorButton" type="submit"name="action">Cambiar-->
            <a id="cambiarContraseña" class="modal-action btn waves-effect waves-light hoverable" onclick="passAdmin()">Cambiar
                <i class="material-icons right">send</i>
            </a>            
            <a class="modal-action modal-close waves-effect waves-red btn-flat hoverable colorFlat">Cancelar
                <i class="material-icons right">cancel</i></a>
            <!--<a class="modal-trigger" href="#modalCambioPass">Reestablecer contraseña</a>-->
        </div>        
    </div>
</div>