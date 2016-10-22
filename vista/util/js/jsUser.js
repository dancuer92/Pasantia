/**
 * Cargo el perfil de usuario
 * @param {type} param
 */
$(document).ready(function () {
    cargarPerfil();
    $(".button-collapse").sideNav();
    $('ul.tabs').tabs();
    $(".dropdown-button").dropdown();
    $('select').material_select();
    $('#mobileFormatos').show();
    $('#mobileUsuarios').show();
});

/**
 * Acción para enviar el formulario de registro de un usuario
 * @param {type} param
 */
$('#formRegUser').submit(function (event) {
    event.preventDefault();
    registrarUser();
});

/**
 * Acción para enviar el formulario de cambiar contraseña
 */
$('#formCamPass').submit(function (event) {
    event.preventDefault();
    cambiarPass();
});

/**
 * Acción para el cambio de contraseña de un usuario.
 */
$('#modalCambio').submit(function (event) {
    event.preventDefault();
    var cod = sessionStorage.getItem('usuario');
    edit('password_usuario', cod);
});

function consultarCaducidad() {
    $.post("../controlador/Usuario_controller.php", {opcion: "caducidad"},
    function (mensaje) {
        //Muestro el tiempo de caducidad de la cuenta.
        $('#caducidad').html(mensaje);
    });
}

/**
 * método para cargar el perfil de un usuario
 * @returns {undefined}
 */
function cargarPerfil() {
    //Oculto el botón de guardar
    $('#guardar').hide();
    //Cargo la información de la BD
    $.post("../controlador/Usuario_controller.php", {opcion: "cargar"},
    function (mensaje) {
        //Muestro el perfil de usuario
        $('#myProfile').html(mensaje);
    });
}

/**
 * Método para modificar la información del usuario
 * @returns {undefined}
 */
function modificarPerfil() {
    //Oculto el botón de modificar y muestro el de guardar
    $('#modificarPerfil').hide();
    $('#guardar').show();
    //Activo los campos editables y les cambio algunas propiedades
    $('#profile :disabled').prop('disabled', false);
    $('#profile :input').css('font-style', 'italic');
    $('#profile :input').css('border', '1px solid');
}

/**
 * Cerrar e inhabilitar la modificación del perfil de un usuario
 * @returns {undefined}
 */
function guardarModificacionesPerfil() {
    //Ocultar el botón de guardar y muestro el de modificar
    $('#guardar').hide();
    $('#modificarPerfil').show();
    //Se inhabilitan loos campos de entrada
    $('#profile :input').prop('disabled', true);
    $('#profile :input').css('font-style', 'normal');
    $('#profile :input').css('border', 'none');
}

/**
 * Editar la información de un campo en algún usuario
 * @param {type} item
 * @param {type} cod
 * @returns {undefined}
 */
function edit(item, cod) {
    //Se toma la clave y el valor a modificar
    var x = '#' + item;
    var valor = $(x).val();
    //Se toma el dominio del campo
    var patron = $(x).attr('pattern');
    //Se toma la descripción del campo
    var titulo = $(x).attr('title');
    //Se crea y se compara con la expresión regular tomada del dominio del campo
    var re = new RegExp(patron);
    var res = (re.test(valor));
    console.log(res);

    //Si es password o correo se niega el resultado
    if (item === 'password_usuario' || item === 'correo_usuario') {
        res = !res;
    }
    console.log(re);
    console.log(valor);
    console.log(res);

    //Se valida el resultado de la comparación
    if (!res && valor !== '') {
        $.post("../controlador/Usuario_controller.php", {valor: valor, clave: item, codigo: cod, opcion: "editar"},
        function () {
            //Se muestra el resultado de la operación
            toastr["success"]("Campo actualizado con éxito");
        });
    }
    else {
        //se muestra el mensaje de error
        $(x).focus();
        toastr["error"](titulo);
    }
}

/**
 * Se reinician todos los campos 
 * @returns {undefined}
 */
function limpiar() {
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
}

/**
 * Método para buscar un usuario en el sistema
 * @returns {undefined}
 */
//consultarUsuario.php
function buscarUsuario() {
    //se toma el valor del campo para la búsqueda en la BD
    var textoBusqueda = $("#busquedaUsuario").val();
    //Si es diferente de vacío
    if (textoBusqueda != "") {
        //Se realiza la búsqueda en la BD
        $.post("../controlador/Usuario_controller.php", {valorBusqueda: textoBusqueda, opcion: "buscar"},
        function (mensaje) {
            $("#resultadoBusquedaUsuario").html(mensaje);
            $('.tooltipped').tooltip();
//            $('.modal-trigger').leanModal();
        });
    } else {
        //Se muestra el mensaje de error
        $("#resultadoBusquedaUsuario").html("");
        toastr["info"]('Digitar un número de documento o nombre');
    }
}
;

/**
 * Método para activar y desactivar un usuario en el sistema
 * recibe el código del usuario y el estado del usuario.
 * @param {type} item
 * @param {type} estado
 * @returns {undefined}
 */
function estadoUsuario(item, estado) {
    //
    var codUser = item;
    var codigo = $('#codigoBuscar').val();

    //se valida que el usuario no sea el mismo del inicio de sesión
    if (codUser != codigo) {
        //Si el usuario está activo
        if (estado != '1') {
            //Se desactiva el usuario
            $.post("../controlador/Usuario_controller.php", {valor: 0, clave: "estado_usuario", codigo: codUser, opcion: "editar"},
            function () {
                //Se muestra el mensaje
                $("#resultadoBusquedaUsuario").html("<p>El usuario " + codUser + " ya se encuentra INACTIVO</p>");
                toastr["success"]("El usuario ha sido desactivado");
            });
        }
        //Si el usuario está inactivo 
        else if (estado != '0') {
            //Se activa el usuario
            $.post("../controlador/Usuario_controller.php", {valor: 1, clave: "estado_usuario", codigo: codUser, opcion: "editar"},
            function () {
                //Se muestra el mensaje
                $("#resultadoBusquedaUsuario").html("<p>El usuario " + codUser + " ya se encuentra ACTIVO</p>");
                toastr["success"]("El usuario ha sido activado");
            });
        }
    }
    else {
        //Se muestra el mensaje de error si es el mismo usuario que inició sesión
        $("#resultadoBusquedaUsuario").html("<strong>Para desactivar su cuenta tiene que hacerlo a través de la cuenta de otro usuario administrador del sistema</strong>");
        toastr["error"]("El usuario no ha podido ser activado o desactivado");
    }
    //Se reinicia el campo de búsqueda de usuario
    $('#busquedaUsuario').val('');
}
;

/**
 * método para registrar un usuario
 * @returns {undefined}
 */
//registrarUsuario.php
function registrarUser() {
    //Se toman todos los valores requeridos para registrar un usuario
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

    //Se valida que las contraseñas coincidan 
    if (crearPass()) {
//        if (codigo != "" && nombre != "" && apellido != "" && numDoc != "" && correo != "" &&
//                pass != "" && cargo != "" && departamento != "" && telefono != "" && rol != "" && estado != "") {
        //Se registra el usuario
        $.post("../controlador/Usuario_controller.php", {codigo: codigo, nombre: nombre,
            apellido: apellido, numDoc: numDoc, correo: correo, pass: pass, cargo: cargo,
            departamento: departamento, telefono: telefono, rol: rol, estado: estado, opcion: "registrar_usuario"},
        function (mensaje) {
            //Se retorna el mensaje de la operación
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
        //Se revisa la contraseña nuevamente
        toastr["info"]("Favor confirmar el password");
        $('#confirmPass').focus();
    }

}
;

/**
 * Crea y verifica que las contraseñas sean iguales 
 * @returns {Boolean}
 */
function crearPass() {
    //Se toman las contraseñas del formaulario
    var pass = $('#pass').val();
    var confirm = $('#confirmPass').val();
    //Si alguno de los campos es vacío
    if (pass.length === 0 || confirm.length === 0) {
        toastr["info"]("Los campos de password no pueden quedar vacios");
        return false;
    }
    //Si son iguales
    if (pass === confirm) {
        return true;
    }

    //sino son iguales
    else {
        return false;
    }
}
;

/**
 * Método para cambiar la contraseña de un usuario
 * @returns {undefined}
 */
function cambiarPass() {
    //se toman los datos del formulario para cambiar la contraseña
    var passNew = $('#passNew').val();
    var passAnt = $('#passAnt').val();
    var codigo = $('#codigoSesion').val();

    //Se validan que la contraseña sea correcta
    if (passConfirm()) {
        //Se procede a cambiar la contraseña en la BD
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
            //Se muestra el mensaje de la operación
            toastr["info"](mensaje);
            $('#cambiarContraseña2').html(mensaje);
            limpiar();
        });
    }
}

/**
 * Abrir el modal para cambiar la contraseña desde el administrador
 * @param {type} cod
 * @returns {undefined}
 */
function cambiarPassAdmin(cod) {
    //se abre el modal
    $('#modalCambioContraseña').openModal();
    //se toma la nueva contraseña
    $('#password_usuario').val('');
    //se guarda el código del usuario
    sessionStorage.setItem('usuario', cod);
}
;

/**
 * Cambiar la contraseña desde el administrador
 * @returns {undefined}
 */
function passAdmin() {
    //se toma el código del usuario
    var cod = sessionStorage.getItem('usuario');
    //se cambia la contraseña
    edit('password_usuario', cod);
}

/**
 * confirmar las contraseñas 
 * @returns {Boolean}
 */
function passConfirm() {
    //Se toman las contraseñas
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

/**
 * lista los usuarios según una clave de búsqueda 
 * @returns {undefined}
 */
function autocompletarUsuario() {
    //inhabilitar el botón de asignar
    $('#asignarFormatoButton').attr('disabled', true);
    //Se toma la clave de búsqueda
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#cod_usuario').val();
    //Se compara la longitud de la clave
    if (keyword.length >= min_length && keyword !== "") {
        //Se consulta a la BD
        $.post("../controlador/Usuario_controller.php", {codigo: keyword, opcion: "asignar"},
        function (mensaje) {
            //Se listan los posibles usuarios que coinciden con la clave
            $('#usuarios').html(mensaje);
        });
    } else {
        //Se muestra un mensaje incorrecto
        $('#usuarios').html('');
        toastr["error"]("Error seleccionando un usuario");
    }
}

/**
 * muestra los usuarios para desasignarle un formato a alguno en específico
 * @returns {undefined}
 */
function usuariosDesasignar() {
    //se selecciona un formato a desasignar.
    var formato = $('#formatoDesasignar').val();
    $('#desasignarFormatoButton').attr('disabled', true);
    //Se verifica la clave de búsqueda de un usuario
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#cod_usuarioDes').val();
    if (keyword.length >= min_length && keyword !== "") {
        //se desasigna el usuario
        $.post("../controlador/Usuario_controller.php", {formato: formato, codigo: keyword, opcion: "desasignar"},
        function (mensaje) {
            //Se listan los usuarios
            $('#usuariosD').html(mensaje);
        });
    } else {
        //Se selecciona el usuario
        $('#usuariosD').html('');
        toastr["error"]("Error seleccionando un usuario");
    }
}

/**
 * Método que selecciona un usuario para asignar
 * @param {type} value
 * @returns {undefined}
 */
function setA(value) {
    //Se toma el valor del usuario
    $('#cod_usuario').val(value);
    //Se carga el mensaje de la operación a realizar
    var mensaje = '<strong>Usuario ' + value + ' seleccionado para asignar</strong>';
    $('#usuarios').html(mensaje);
    $('#asignarFormatoButton').attr('disabled', false);
}
;

function setD(value) {
    //Se toma el valor del usuario
    $('#cod_usuarioDes').val(value);
    //Se carga el mensaje de la operación a realizar

    var mensaje = '<strong>Usuario ' + value + ' seleccionado para asignar</strong>';
    $('#usuariosD').html(mensaje);
    $('#desasignarFormatoButton').attr('disabled', false);
}

