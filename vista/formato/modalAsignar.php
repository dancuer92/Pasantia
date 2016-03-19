<div id="asignarFormato" class="modal" >
    <div class="s12">
        <div class="modal-content" >
            <h3>Asignar Formato</h3>
            <div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="formatoAsignar" type="hidden" name="formatoAsignar" value="">
                        <input id="cod_usuario" name="cod_usuario" type="text" class="validate" required onkeyup="autocompletarUsuario()">
                        <label for="cod_usuario">Nombre de Usuario</label>
                        <div id="usuarios" class="collection">                            
                        </div>
                    </div>                    
                </div>

            </div>
        </div>

        <!-- Modal Footer de Inicio de sesión-->
        <div class="modal-footer">
            <button id="asignarFormatoButton" class="modal-action btn waves-effect waves-light hoverable"   disabled="true" onclick="btnAsignar();">Asignar
                <i class="material-icons right">send</i>
            </button>            
            <a class="modal-action modal-close waves-effect waves-red btn-flat hoverable">Cancelar
                <i class="material-icons right">cancel</i></a>
            <!--<a class="modal-trigger" href="#modalCambioPass">Reestablecer contraseña</a>-->
        </div>        
    </div>
</div>