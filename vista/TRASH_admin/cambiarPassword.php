<div id="cambiarPassword" class="contenido">
    <form class="s12 m4" id="formRegUser" method="post">
        <input id="codigoSesion" name="codigoSesion" type="hidden" value="<?php echo $_SESSION['codigo']; ?>">

        <div class="center" >
            <h3><i class="material-icons prefix" style="font-size: 2.92rem">lock_open</i> Cambiar contraseña</h3>
            <div>
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">lock_open</i>
                        <input id="passAnt" name="passAnt" type="password" maxlength="30" class="validate" required>
                        <label for="passAnt">Contraseña anterior</label>                           
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="passNew" name="passNew" type="password" maxlength="30" class="validate" required>
                        <label for="passNew">Nueva contraseña</label>                           
                    </div>
                    <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">lock</i>
                        <input id="passConfirm" name="passConfirm" type="password" maxlength="30" class="validate" required>
                        <label for="passConfirm">Confirmar nueva contraseña</label>                                                      
                    </div>
                </div>
            </div>         
            <a id="cambiarPass" class="btn waves-effect waves-light hoverable" onclick="cambiarPass()">Cambiar
                <i class="material-icons right">send</i>
            </a>           
            <a class="waves-effect waves-red btn-flat hoverable" onclick="limpiar()">Limpiar
                <i class="material-icons right">cancel</i></a>        
        </div>
    </form>
    <div id="cambiarContraseña"></div>

</div>
