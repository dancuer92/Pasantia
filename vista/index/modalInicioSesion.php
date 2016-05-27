<!-- modal-fixed-footer -->
<div id="modalInicioSesion" class="modal" >
    <form class="s12" action="controlador/Sesion_controller.php" method="post">
        <div class="modal-content" >
            <h4>Inicio de sesión</h4>
            <div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="nombre" name="nombre" type="text" class="validate" pattern="[a-z]{1,30}" title="Favor digitar un nombre válido" required>
                        <label for="nombre">Usuario</label>                            
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <!--<input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[+-._,*/])(?=.*[a-z]).{8,}" title="La contraseña debe ser mayor a ocho(8) caracteres y debe contener al menos un número y un caracter especial(+-._,*/)" class="validate" required>-->
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Contraseña</label>                                                      
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Footer de Inicio de sesión-->
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light hoverable colorButton" type="submit" name="action">Ingresar
                <i class="material-icons right">send</i>
            </button>            
            <a class="modal-action modal-close waves-effect waves-red btn-flat hoverable colorFlat">Cancelar
                <i class="material-icons right">cancel</i></a>
            <!--<a class="modal-trigger" href="#modalCambioPass">Reestablecer contraseña</a>-->
        </div>        
    </form>
</div>

