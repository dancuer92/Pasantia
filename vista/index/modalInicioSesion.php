<!-- modal-fixed-footer -->
<div id="modalInicioSesion" class="modal" >
    <form class="s12" action="controlador/Sesion_controller.php" method="post">
        <div class="modal-content" >
            <h3>Inicio de sesión</h3>
            <div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="nombre" name="nombre" type="text" class="validate" required>
                        <label for="nombre">Usuario</label>                            
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Contraseña</label>                                                      
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Footer de Inicio de sesión-->
        <div class="modal-footer">
            <button class="modal-action btn waves-effect waves-light hoverable" type="submit" name="action">Ingresar
                <i class="material-icons right">send</i>
            </button>            
            <a class="modal-action modal-close waves-effect waves-red btn-flat hoverable">Cancelar
                <i class="material-icons right">cancel</i></a>
            <!--<a class="modal-trigger" href="#modalCambioPass">Reestablecer contraseña</a>-->
        </div>        
    </form>
</div>

