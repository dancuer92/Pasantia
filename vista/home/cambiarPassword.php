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
<script>
    function cambiarPass() {
        var passNew = $('#passNew').val();
        var passAnt = $('#passAnt').val();
        var codigo = $('#codigoSesion').val();

        if (passConfirm()) {
            $.post("../../controlador/sesion/controladorUsuario.php", {codigo: codigo, passAnt: passAnt, passNew: passNew, opcion: "cambiar"},
            function (mensaje) {
                $('#cambiarContraseña').html(mensaje);
                Materialize.toast(mensaje, 3000, 'rounded');
                limpiar();
            });
        }
    }
    ;

    function passConfirm() {
        var passAnt = $('#passAnt').val();
        var pass = $('#passNew').val();
        var confirm = $('#passConfirm').val();
        if (pass.length === 0 || confirm.length === 0) {
            Materialize.toast('Favor digitar los campos vacíos', 3000, 'rounded');
            $('#passNew').focus();
            return false;
        }
        else if (pass !== confirm) {
            Materialize.toast('Favor verificar la nueva contraseña', 3000, 'rounded');
            $('#passConfirm').focus();
            return false;
        }
        else if (passAnt === pass) {
            Materialize.toast('Contraseña igual a la anterior, ¡favor cambiarla!', 3000, 'rounded');
            $('#passNew').focus();
            return false;
        }
        else if (passAnt === "") {
            Materialize.toast('Favor escribir contraseña anterior', 3000, 'rounded');
            $('#passAnt').focus();
            return false;
        }
        else {
            return true;
        }
    }
    ;

</script>