$(document).ready(function () {
    $(".button-collapse").sideNav();
    $('ul.tabs').tabs();
    $(".dropdown-button").dropdown();
    $('select').material_select();
    $('#mobileFormatos').hide();
    $('#mobileUsuarios').show();
    $('.contenido').hide();
    $('#miPerfil').show();

    $('#perfil').click(function () {
        $('.contenido').hide();
        $('#miPerfil').show();
    });
    $('#perfilM').click(function () {
        $('.contenido').hide();
        $('#miPerfil').show();
    });
    $('#cambiar').click(function () {
        $('.contenido').hide();
        $('#cambiarPassword').show();
    });
    $('#cambiarPasswordM').click(function () {
        $('.contenido').hide();
        $('#cambiarPassword').show();
    });
    $('#registrar').click(function () {
        $('.contenido').hide();
        $('#registrarUser').show();
    });
    $('#registrarM').click(function () {
        $('.contenido').hide();
        $('#registrarUser').show();
    });
    $('#consultar').click(function () {
        $('.contenido').hide();
        $('#consultarUser').show();
    });
    $('#consultarM').click(function () {
        $('.contenido').hide();
        $('#consultarUser').show();
    });
//consultarUsuario.php
    $('#busCli').click(function () {
        $('.contenido').hide();
        $('#buscarUsuario').show();
        $('#busquedaUsuario').val('');
        $("#resultadoBusquedaUsuario").html("");
    });


});



function limpiar() {
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
}
//consultarUsuario.php
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
    var codigo = $('#codigoBuscar').val();

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
//registrarUsuario.php
function registrarUser() {
    var codigo = $('#codigo').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var numDoc = $('#numDoc').val();
    var correo = $('#correo').val();
    var pass = $('#pass').val();
    var cargo = $('#cargo').val();
    var departamento = $('#departamento').val();
    var telefono = $('#telefono').val();
    var rol = $('#tipoUser').val();
    var estado = $('#estado').val();

    if (confirmPass()) {
        if (codigo != "" && nombre != "" && apellido != "" && numDoc != "" && correo != "" &&
                pass != "" && cargo != "" && departamento != "" && telefono != "" && rol != "" && estado != "") {
            $.post("../../controlador/sesion/controladorUsuario.php", {codigo: codigo, nombre: nombre,
                apellido: apellido, numDoc: numDoc, correo: correo, pass: pass, cargo: cargo,
                departamento: departamento, telefono: telefono, rol: rol, estado: estado, opcion: "registrar"},
            function (mensaje) {
                $('#regUserForm').html(mensaje);
                Materialize.toast(mensaje, 3000, 'rounded');
                limpiar();
            });
        } else {
            $('#regUserForm').html('Favor digitar todos los campos');
            Materialize.toast('Favor digitar todos los campos', 3000, 'rounded');
        }
    }
    else {
        Materialize.toast('Favor confirmar el password', 3000, 'rounded');
        $('#confirmPass').focus();
    }

}
;

function confirmPass() {
    var pass = $('#pass').val();
    var confirm = $('#confirmPass').val();
    if (pass.length === 0 || confirm.length === 0) {
        Materialize.toast('Los campos de password no pueden quedar vacios', 3000, 'rounded');
        return false;
    }
    if (pass === confirm) {
        return true;
    }
    else {
        return false;
    }
}
;



