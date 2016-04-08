<div id="desasignarFormato" class="modal" >
    <div class="s12">
        <div class="modal-content" >
            <h3>Desasignar Formato</h3>
            <div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="formatoDesasignar" type="hidden" name="formatoDesasignar" value="">
                        <input id="cod_usuarioDes" name="cod_usuarioDes" type="text" class="validate" required onkeyup="usuariosDesasignar()">
                        <label for="cod_usuarioDes">Nombre de Usuario</label>
                        <div id="usuariosD" class="collection">                            
                        </div>
                    </div>                    
                </div>

            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button id="desasignarFormatoButton" class="modal-action btn waves-effect waves-light hoverable"   disabled="true" onclick="btnDesasignar();">Desasignar
                <i class="material-icons right">send</i>
            </button>            
            <a class="modal-action modal-close waves-effect waves-red btn-flat hoverable">Cancelar
                <i class="material-icons right">cancel</i></a>
            <!--<a class="modal-trigger" href="#modalCambioPass">Reestablecer contraseña</a>-->
        </div>        
    </div>
</div>