$(document).ready(function () {
    cargarPerfil();
    $(".button-collapse").sideNav();
    $('ul.tabs').tabs();
    $(".dropdown-button").dropdown();
    $('select').material_select();
    $('#mobileFormatos').show();
    $('#mobileUsuarios').show();


    /*
     $('#registrarF').click(function () {
     $('.contenido').hide();
     $('#registrarFormat').show();
     });
     $('#registrarFM').click(function () {
     $('.contenido').hide();
     $('#registrarFormat').show();
     });
     $('#modificarF').click(function () {
     $('.contenido').hide();
     $('#modificarFormat').show();
     });
     $('#modificarFM').click(function () {
     $('.contenido').hide();
     $('#modificarFormat').show();
     });
     $('#asignarF').click(function () {
     $('.contenido').hide();
     $('#asignarFormat').show();
     });
     $('#asignarFM').click(function () {
     $('.contenido').hide();
     $('#asignarFormat').show();
     });
     $('#consultarF').click(function () {
     $('.contenido').hide();
     $('#consultarFormat').show();
     });
     $('#consultarFM').click(function () {
     $('.contenido').hide();
     $('#consultarFormat').show();
     });
     $('#diligenciarF').click(function () {
     $('.contenido').hide();
     $('#diligenciarFormat').show();
     });
     $('#diligenciarFM').click(function () {
     $('.contenido').hide();
     $('#diligenciarFormat').show();
     });
     
     
     
     
     //consultarUsuario.php
     $('#busCli').click(function () {
     $('.contenido').hide();
     $('#buscarUsuario').show();
     $('#busquedaUsuario').val('');
     $("#resultadoBusquedaUsuario").html("");
     });*/

});

function cargarPerfil() {
    $('#guardar').hide();
    $.post("../controlador/Usuario_controller.php", {opcion: "cargar"},
    function (mensaje) {
        $('#myProfile').html(mensaje);
    });
}

function modificarPerfil() {
    $('#modificarPerfil').hide();
    $('#guardar').show();
    $('#profile :disabled').prop('disabled', false);
    $('#profile :input').css('font-style', 'italic');
    $('#profile :input').css('border', '1px solid');
}
function guardarModificacionesPerfil() {
    $('#guardar').hide();
    $('#modificarPerfil').show();
    $('#profile :input').prop('disabled', true);
    $('#profile :input').css('font-style', 'normal');
    $('#profile :input').css('border', 'none');
}

function edit(item, cod) {
    var x = '#' + item;
    var valor = $(x).val();
    if (valor !== '') {
        $.post("../controlador/Usuario_controller.php", {valor: valor, clave: item, codigo: cod, opcion: "editar"},
        function () {
            Materialize.toast('Campo actualizado con éxito', 5000, 'rounded');
        });
    }
    else {
        $(x).focus();
        Materialize.toast('Favor diligenciar el campo', 5000, 'rounded');
    }
}

function limpiar() {
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
}

//consultarUsuario.php
function buscarUsuario() {
    var textoBusqueda = $("#busquedaUsuario").val();
    if (textoBusqueda != "") {
        $.post("../controlador/Usuario_controller.php", {valorBusqueda: textoBusqueda, opcion: "buscar"},
        function (mensaje) {
            $("#resultadoBusquedaUsuario").html(mensaje);
        });
    } else {
        $("#resultadoBusquedaUsuario").html("");
        Materialize.toast('Favor digitar el número de documento', 5000, 'rounded');
    }
}
;

function estadoUsuario(item, estado) {
    var codUser = item;
    var codigo = $('#codigoBuscar').val();

    if (codUser != codigo) {
        if (estado != '1') {
            $.post("../controlador/Usuario_controller.php", {valor: 0, clave: "estado_usuario", codigo: codUser, opcion: "editar"},
            function () {
                $("#resultadoBusquedaUsuario").html("<p>El usuario " + codUser + " ya se encuentra INACTIVO</p>");
                Materialize.toast('El usuario ha sido desactivado', 5000, 'rounded');
            });
        }
        else if (estado != '0') {
            $.post("../controlador/Usuario_controller.php", {valor: 1, clave: "estado_usuario", codigo: codUser, opcion: "editar"},
            function () {
                $("#resultadoBusquedaUsuario").html("<p>El usuario " + codUser + " ya se encuentra ACTIVO</p>");
                Materialize.toast('El usuario ha sido activado', 5000, 'rounded');
            });
        }
    }
    else {
        $("#resultadoBusquedaUsuario").html("<strong>Para desactivar su cuenta tiene que hacerlo a través de la cuenta de otro usuario administrador del sistema</strong>");
        Materialize.toast('El usuario no ha podido ser activado o desactivado', 5000, 'rounded');
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

    if (crearPass()) {
        if (codigo != "" && nombre != "" && apellido != "" && numDoc != "" && correo != "" &&
                pass != "" && cargo != "" && departamento != "" && telefono != "" && rol != "" && estado != "") {
            $.post("../controlador/Usuario_controller.php", {codigo: codigo, nombre: nombre,
                apellido: apellido, numDoc: numDoc, correo: correo, pass: pass, cargo: cargo,
                departamento: departamento, telefono: telefono, rol: rol, estado: estado, opcion: "registrar_usuario"},
            function (mensaje) {
                $('#regUserForm').html(mensaje);
                Materialize.toast(mensaje, 5000, 'rounded');
                limpiar();
            });
        } else {
            $('#regUserForm').html('Favor digitar todos los campos');
            Materialize.toast('Favor digitar todos los campos', 5000, 'rounded');
        }
    }
    else {
        Materialize.toast('Favor confirmar el password', 5000, 'rounded');
        $('#confirmPass').focus();
    }

}
;

function crearPass() {
    var pass = $('#pass').val();
    var confirm = $('#confirmPass').val();
    if (pass.length === 0 || confirm.length === 0) {
        Materialize.toast('Los campos de password no pueden quedar vacios', 5000, 'rounded');
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

function cambiarPass() {
    var passNew = $('#passNew').val();
    var passAnt = $('#passAnt').val();
    var codigo = $('#codigoSesion').val();

    if (passConfirm()) {
        $.post("../controlador/Usuario_controller.php", {codigo: codigo, passAnt: passAnt, passNew: passNew, opcion: "cambiar"},
        function (mensaje) {
            $('#cambiarContraseña').html(mensaje);
            Materialize.toast(mensaje, 5000, 'rounded');
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
        Materialize.toast('Favor digitar los campos vacíos', 5000, 'rounded');
        $('#passNew').focus();
        return false;
    }
    else if (pass !== confirm) {
        Materialize.toast('Favor verificar la nueva contraseña', 5000, 'rounded');
        $('#passConfirm').focus();
        return false;
    }
    else if (passAnt === pass) {
        Materialize.toast('Contraseña igual a la anterior, ¡Favor cambiarla!', 5000, 'rounded');
        $('#passNew').focus();
        return false;
    }
    else if (passAnt === "") {
        Materialize.toast('Favor escribir contraseña anterior', 5000, 'rounded');
        $('#passAnt').focus();
        return false;
    }
    else {
        return true;
    }
}

function autocompletarUsuario() {
    $('#asignarFormatoButton').attr('disabled', true);
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#cod_usuario').val();
    if (keyword.length >= min_length && keyword !== "") {
        $.post("../controlador/Usuario_controller.php", {codigo: keyword, opcion: "asignar"},
        function (mensaje) {
            $('#usuarios').html(mensaje);
        });
    } else {
        $('#usuarios').html('');
        Materialize.toast("Error seleccionando un usuario", 3000, 'rounded');
    }
}

function usuariosDesasignar() {
    var formato=$('#formatoDesasignar').val();
    $('#desasignarFormatoButton').attr('disabled', true);
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#cod_usuarioDes').val();
    if (keyword.length >= min_length && keyword !== "") {
        $.post("../controlador/Usuario_controller.php", {formato:formato, codigo: keyword, opcion: "desasignar"},
        function (mensaje) {
            $('#usuariosD').html(mensaje);
        });
    } else {
        $('#usuariosD').html('');
        Materialize.toast("Error seleccionando un usuario", 3000, 'rounded');
    }
}

function setA(value) {
    $('#cod_usuario').val(value);
    var mensaje = '<strong>Usuario ' + value + ' seleccionado para asignar</strong>';
    $('#usuarios').html(mensaje);
    $('#asignarFormatoButton').attr('disabled', false);
}
;

function setD(value) {
    $('#cod_usuarioDes').val(value);
    var mensaje = '<strong>Usuario ' + value + ' seleccionado para asignar</strong>';
    $('#usuariosD').html(mensaje);
    $('#desasignarFormatoButton').attr('disabled', false);
}

