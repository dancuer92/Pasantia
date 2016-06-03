$(document).ready(function () {
    cargarPerfil();
    $(".button-collapse").sideNav();
    $('ul.tabs').tabs();
    $(".dropdown-button").dropdown();
    $('select').material_select();
    $('#mobileFormatos').show();
    $('#mobileUsuarios').show();
});

$('#formRegUser').submit(function (event) {
    event.preventDefault();
    registrarUser();
});

$('#formCamPass').submit(function (event) {
    event.preventDefault();
    cambiarPass();
});

$('#modalCambio').submit(function (event) {
    event.preventDefault();
    var cod = sessionStorage.getItem('usuario');    
    edit('password_usuario',cod);
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
    var patron = $(x).attr('pattern');
    var titulo = $(x).attr('title');
    var re = new RegExp(patron);
    var res = (re.test(valor)); 
    console.log(res);

    if(item==='password_usuario' || item==='correo_usuario'){
        res=!res;
    }    
    console.log(re);
    console.log(valor);    
    console.log(res);

    if (!res && valor !== '') {
        $.post("../controlador/Usuario_controller.php", {valor: valor, clave: item, codigo: cod, opcion: "editar"},
        function () {
            toastr["success"]("Campo actualizado con éxito");
        });
    }
    else {
        $(x).focus();
        toastr["error"](titulo);
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
            $('.tooltipped').tooltip();
//            $('.modal-trigger').leanModal();
        });
    } else {
        $("#resultadoBusquedaUsuario").html("");
        toastr["info"]('Digitar un número de documento o nombre');
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
                toastr["success"]("El usuario ha sido desactivado");
            });
        }
        else if (estado != '0') {
            $.post("../controlador/Usuario_controller.php", {valor: 1, clave: "estado_usuario", codigo: codUser, opcion: "editar"},
            function () {
                $("#resultadoBusquedaUsuario").html("<p>El usuario " + codUser + " ya se encuentra ACTIVO</p>");
                toastr["success"]("El usuario ha sido activado");
            });
        }
    }
    else {
        $("#resultadoBusquedaUsuario").html("<strong>Para desactivar su cuenta tiene que hacerlo a través de la cuenta de otro usuario administrador del sistema</strong>");
        toastr["error"]("El usuario no ha podido ser activado o desactivado");
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
//        if (codigo != "" && nombre != "" && apellido != "" && numDoc != "" && correo != "" &&
//                pass != "" && cargo != "" && departamento != "" && telefono != "" && rol != "" && estado != "") {
        $.post("../controlador/Usuario_controller.php", {codigo: codigo, nombre: nombre,
            apellido: apellido, numDoc: numDoc, correo: correo, pass: pass, cargo: cargo,
            departamento: departamento, telefono: telefono, rol: rol, estado: estado, opcion: "registrar_usuario"},
        function (mensaje) {
            $('#regUserForm').html(mensaje);
            toastr["info"](mensaje);
            limpiar();
        });
//        } else {
//            $('#regUserForm').html('Favor digitar todos los campos');
//            Materialize.toast('Favor digitar todos los campos', 5000, 'rounded');
//        }
    }
    else {
        toastr["info"]("Favor confirmar el password");
        $('#confirmPass').focus();
    }

}
;

function crearPass() {
    var pass = $('#pass').val();
    var confirm = $('#confirmPass').val();
    if (pass.length === 0 || confirm.length === 0) {
        toastr["info"]("Los campos de password no pueden quedar vacios");
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
            console.log(mensaje);
//            var msj;
//            switch (mensaje) {
//                case 0:
//                    msj = 'La contraseña no ha sido actualizada, por favor vuelva a intetarlo';
//                    toastr["error"](msj);
//                    break;
//                case 1:
//                    msj = 'La contraseña ha sido actualizada';
//                    toastr["success"](msj);
//                    break;
//                case 2:
//                    msj='La contraseña anterior no coincide en la base de datos';
//                    toastr["info"](msj);
//                    break;
//            }
            toastr["info"](mensaje);
            $('#cambiarContraseña').html(mensaje);
            limpiar();
        });
    }
}

function cambiarPassAdmin(cod) {
    $('#modalCambioContraseña').openModal();
    $('#password_usuario').val('');
    sessionStorage.setItem('usuario', cod);
}
;

function passAdmin(){
    var cod = sessionStorage.getItem('usuario');    
    edit('password_usuario',cod);
}

function passConfirm() {
    var passAnt = $('#passAnt').val();
    var pass = $('#passNew').val();
    var confirm = $('#passConfirm').val();
    if (pass.length === 0 || confirm.length === 0) {
        toastr["info"]('Favor digitar los campos vacíos');
        $('#passNew').focus();
        return false;
    }
    else if (pass !== confirm) {
        toastr["info"]('Favor verificar la nueva contraseña');
        $('#passConfirm').focus();
        return false;
    }
    else if (passAnt === pass) {
        toastr["info"]('Contraseña igual a la anterior, ¡Favor cambiarla!');
        $('#passNew').focus();
        return false;
    }
    else if (passAnt === "") {
        toastr["info"]('Favor escribir contraseña anterior');
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
        toastr["error"]("Error seleccionando un usuario");
    }
}

function usuariosDesasignar() {
    var formato = $('#formatoDesasignar').val();
    $('#desasignarFormatoButton').attr('disabled', true);
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#cod_usuarioDes').val();
    if (keyword.length >= min_length && keyword !== "") {
        $.post("../controlador/Usuario_controller.php", {formato: formato, codigo: keyword, opcion: "desasignar"},
        function (mensaje) {
            $('#usuariosD').html(mensaje);
        });
    } else {
        $('#usuariosD').html('');
        toastr["error"]("Error seleccionando un usuario");
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

