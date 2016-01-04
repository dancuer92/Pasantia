<!--<form  class="s12 m4" method="POST">-->
<div class="center" >
    <h3><i class="material-icons prefix" style="font-size: 2.92rem">search</i> Consultar Usuario</h3>
    <div class="input-field col s12 m12 l12">
        <i class="material-icons prefix">person_pin</i>
        <!--<input type="hidden" name="opcion" id="opcion" value="buscar">-->
        <input type="text" name="busquedaUsuario" id="busquedaUsuario" value="" placeholder="" maxlength="30" autocomplete="off" onKeyUp="buscarUsuario();"/> 
        <label for="busquedaUsuario">Número de identificación o nombre del usuario a buscar</label>                                                      
    </div> 
</div>   
<!--</form>-->
<div id="resultadoBusquedaUsuario"></div>
<script>
    $('#busCli').click(function () {
        $('.contenido').hide();
        $('#buscarUsuario').show();
        $('#busquedaUsuario').val('');
        $("#resultadoBusquedaUsuario").html("");
    });

    function buscarUsuario() {
        var textoBusqueda = $("#busquedaUsuario").val();
        if (textoBusqueda != "") {
            $.post("../../controlador/sesion/controladorUsuario.php", {valorBusqueda: textoBusqueda, opcion: "buscar"},
            function (mensaje) {
                $("#resultadoBusquedaUsuario").html(mensaje);
            });
        } else {
            $("#resultadoBusquedaUsuario").html("");
            Materialize.toast('Favor digitar el número de documento', 3000, 'rounded');
        }
    }
    ;

    function estadoUsuario(item, estado) {
        var codUser = item;
        var codigo =<?php echo $_SESSION['codigo'] ?>;        

        if (estado != '1' && codUser !== codigo) {
            $.post("../../controlador/sesion/controladorUsuario.php", {valor: 0, clave: "estado_usuario", codigo: codUser, opcion: "editar"},
            function (mensaje) {
                $("#resultadoBusquedaUsuario").html("<p>El usuario " + codUser + " ya se encuentra INACTIVO</p>");
                Materialize.toast('El usuario ha sido desactivado', 3000, 'rounded');
            });
        }
        else if (estado != '0' && codUser !== codigo) {
            $.post("../../controlador/sesion/controladorUsuario.php", {valor: 1, clave: "estado_usuario", codigo: codUser, opcion: "editar"},
            function (mensaje) {
                $("#resultadoBusquedaUsuario").html("<p>El usuario " + codUser + " ya se encuentra ACTIVO</p>");
                Materialize.toast('El usuario ha sido activado', 3000, 'rounded');
            });
        }
        else {
            $("#resultadoBusquedaUsuario").html("<p>Para desactivar su cuenta tiene que hacerlo a través de la cuenta de otro usuario administrador del sistema</p>");
            Materialize.toast('El usuario no ha podido ser activado o desactivado', 3000, 'rounded');
        }
        $('#busquedaUsuario').val('');
    }
    ;
</script>