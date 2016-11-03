/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Método para listar los formatos mientras se escribe una clave de búsqueda
 * @returns {undefined}
 */
function autocompletarFormato() {
    //clave de búsqueda
    var keyword = $('#cod_formato').val();
    //Método AJAX
    $.post("../controlador/Formato_controller.php", {formato: keyword, opcion: "cargarFormatos"},
    function (mensaje) {
        //Se cargan en la sección tabla_formatos y se inicializan las etiquetas de descripción
        $('#tabla_formatos').html(mensaje);
        $('.tooltipped').tooltip();
    });
}

/**
 * Método para ejecutar el modal de asignar formato
 * @param {type} formato
 * @returns {undefined}
 */
function asignarFormato(formato) {
    //abre el modal
    $('#asignarFormato').openModal();
    //asigna el formato como valor al input oculto 
    $('#formatoAsignar').val(formato);
}

/**
 * Método para ejecutar el modal de desasignar formato
 * @param {type} formato
 * @returns {undefined}
 */
function desasignarFormato(formato) {
    //abre el modal
    $('#desasignarFormato').openModal();
    //asigna el formato como valor al input oculto
    $('#formatoDesasignar').val(formato);
}

/**
 * Acción del botón del formulario de asignar formato
 * @returns {undefined}
 */
function btnAsignar() {
    //se toma el valor del formato
    var formato = $('#formatoAsignar').val();
    //Se toma el código del usuario
    var usuario = $('#cod_usuario').val();
    console.log(formato + " " + usuario);
    //se ejcuta la función en el controlador mediante AJAX
    $.post("../controlador/Formato_controller.php", {formato: formato, usuario: usuario, opcion: "asignarFormato"},
    function (mensaje) {
        //Se muestra el resultado de la operación
        toastr["info"](mensaje);
    });

}

/**
 * Acción del botón del modal desasingar el formato
 * @returns {undefined}
 */
function btnDesasignar() {
    //Se toma el formato
    var formato = $('#formatoDesasignar').val();
    //Se toma el código del usuario
    var usuario = $('#cod_usuarioDes').val();
    console.log(formato + " " + usuario);
    //Se ejecuta la función en el controlador
    $.post("../controlador/Formato_controller.php", {formato: formato, usuario: usuario, opcion: "desasignarFormato"},
    function (mensaje) {
        //Se muestra la respuesta de la operación
        toastr["info"](mensaje);
    });
}

/**
 * Método que se encarga de guardar el html del formato en la base de datos.
 * @returns {undefined}
 */
function guardarRegistroFormato() {
    //Se toman los valores del formato nuevo
    var codigoF = $('#codigoFormato').val();
    var nombreF = $('#nombreFormato').val();
    var procedimientoF = $('#procedimientoFormato').val();
    var directorF = $('#directorProcedimiento').val();
    var frecuenciaF = $('#frecuenciaFormato').val();
    var tipoF = $('#tipoFormato').val();
    var versionF = $('#versionFormato').val();
    var formato = $('#formBuilder').html();
    var res = $('#res1');
//    var res = $('#res1').text(formato);
    console.log(codigoF, nombreF);
    //Se valida que el código del formato no sea vacío
    if (codigoF !== '') {
        //Se ejecuta la función en el controlado
        $.post("../../controlador/Formato_controller.php",
                {codigoF: codigoF, nombreF: nombreF, procedimientoF: procedimientoF, directorF: directorF, frecuenciaF: frecuenciaF, tipoF: tipoF, versionF: versionF, codigoHTML: formato, opcion: 'guardarFormato'},
        function (mensaje) {
            //Se muestra la respuesta de la operación
            res.html(mensaje);
            toastr["info"](mensaje);
//        Materialize.toast(mensaje, 5000, 'rounded');
        });
    }
    else {
        //Se muestra un mensaje de error
        res.html('Por favor adicione elementos al nuevo formato');
        toastr["info"]('Por favor adicione elementos al nuevo formato');
    }
}

/**
 * Método que redirecciona a modificar formato
 * @param {type} cod
 * @returns {undefined}
 */
function modificarFormato(cod) {
    //Se guarda el código del formato en la sesión del navegador
    sessionStorage.setItem('formato', cod);
    //se redirecciona a la página
    location.href = ('formato/modificarFormato.php');
}

/**
 * Se guarda la modificación del formato 
 * @returns {undefined}
 */
function guardarModificacionFormato() {
    //Se toma el código del formato
    var formato = sessionStorage.getItem('formato');
    //Se toma el detalle de la modificación
    var detalle = $('#detForm').val();
    //Se toma el nuevo código html para almacenarlo en la BD
    var html = $('#formBuilder').html();

    //Si el detalle no cumple la condición
    if (detalle === '') {
        //Se notifica que falta un campo por diligenciar
        $('#pestañaFormulario').click();
        $('#detForm').focus();
    }
    else {
        //Se ejecuta la operación modificar formato
        $.post("../../controlador/Formato_controller.php", {formato: formato, detalle: detalle, html: html, opcion: 'modificarFormato'},
        function (mensaje) {
            //Se muestra el resultado de la operación
            $('#res1').html(mensaje);
            toastr["info"](mensaje);
        });
    }
}

/**
 * Se modifica un dato o una característica del formato en la BD
 * @returns {undefined}
 */
function guardarDatoFormato(clave, id) {
    $('#detForm').val('Actualización de los datos principales del formato');
    var input = $('#' + id);
    var valor = input.val();
//    console.log(valor);


    //Se toma el dominio del input
    var patron = input.attr('pattern');
    //se toma la descripción del input
    var titulo = input.attr('title');
    //Se convierte a expresión regular el dominio
    var re = new RegExp(patron);
    //se obtiene la validación
    var requerido = (re.test(valor));
    console.log(requerido);

    if (valor !== '' && requerido) {
        var formato = sessionStorage.getItem('formato');
        $.post("../../controlador/Formato_controller.php", {formato: formato, clave: clave, valor: valor, opcion: 'modificarDatosFormato'},
        function (mensaje) {
            console.log(mensaje);
            toastr['info'](mensaje);
        });
    } else {
        input.focus();
        toastr['error'](titulo);
    }






//    //Se toman los valores del nombre del campo y el valor del campo
//    var campo = $('#listaDatos').val();
//    var valor = $('#valorNuevoCaracteristica').val();
//    console.log(campo);
//    console.log(valor);
//    //se valida que el campo no sea vacío
//    if (valor.length > 0 && campo !== null) {
//        console.log('Campo: ' + valor + "\t Valor:" + valor);
//        toastr["info"]('Campo: ' + valor + "\t Valor:" + valor);
//    }
//    else {
//        toastr["info"]('No se ha diligenciado algún dato');
//    }
}

/**
 * Advertencia en el momento de cambiar los datos del formato.
 * @returns {undefined}
 */
function cargarAdvertencia() {
    toastr['warning']('Los datos existentes aquí son críticos, por lo tanto tenga claro lo que desea cambiar. Esto puede afectar la información consignada en el formato anteriormente');
}

/**
 * Se redirecciona para mostrar el historial del formato
 * @param {type} cod
 * @returns {undefined}
 */
function historialFormato(cod) {
    //Se guarda el código del formato en una sesión del navegador
    sessionStorage.setItem('formato', cod);
    //Se redirecciona
    location.href = ('formato/historialFormato.php');
}

/**
 * Carga el historial de los formatos
 * @param {type} formato
 * @returns {undefined}
 */
function cargarHistorial(formato) {
    //Se ejecuta la operación
    $.post('../../controlador/Formato_controller.php', {formato: formato, opcion: 'historialFormato'},
    function (mensaje) {
        //Se adicionan como tablas el esquema de la tabla
        $('#tabla_historial tbody').append(mensaje);
        //Se convierte la tabla
        $('#tabla_historial').DataTable({responsive: true,
            order: [[0, "desc"]],
            language: {
                processing: "Procesando",
                lengthMenu: "Mostrar _MENU_ registros por página",
                zeroRecords: "Registros no encontrados",
                info: "Mostrar página _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros disponibles",
                infoFiltered: "(Búsqueda realizada en _MAX_ registros)",
                search: "Buscar",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                },
                oAria: {
                    sortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sortDescending: ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
}

/**
 * Se redirecciona para diligenciar el formato
 * @param {type} cod
 * @returns {undefined}
 */
function diligenciarFormato(cod) {
    //se guarda el código del fomato en el navegador
    sessionStorage.setItem('formato', cod);
    //se redirecciona
    location.href = ('formato/diligenciarFormato.php');
}

/**
 * Guarda la información diligenciada en el formato
 * @param {type} opcion
 * @param {type} info
 * @returns {undefined}
 */
function guardarDiligenciaFormato(opcion, info) {
    //Se toma el código del marcelo
    var formato = sessionStorage.getItem('formato');
    //se validan los campos que son requeridos
    var requeridos = validarRequeridos();
    //Se guarda la información
    if (requeridos) {
        //se oculta el modal
        $('#myModal').modal('hide');
        //Se toman las observaciones por el usuario o por defecto del sistema
        var observaciones = sessionStorage.getItem('observaciones');
        var camposClave = valoresCamposClave();        
        //Si la opción es registrar
        if (opcion === 'registrar') {
            opcRegistrar(formato, camposClave, observaciones);
        }
        //Si la opcion es modificar el registro de un formato
        if (opcion === 'modificar') {
            opcModificar(formato, camposClave, observaciones, info);
        }
    }
}

/**
 * Método que devuelve los valores del campo clave para anexarlos a la BD como clave única
 * si el formato no tiene campos clave se guarda la fecha y hora del registro
 * @returns {String} cadena de texto con los campos clave y su respectivo valor separados por ;
 */
function valoresCamposClave() {
    var campos = '';
    $('.campoClave').each(function () {
        var campo = $(this);
        var name = campo.attr('name');
        var valor = campo.val();
        campos += name + '=' + valor + '<br>';
    });
    if (campos === '') {
        var f = new Date();
        var fecha_registro = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate() + " " + f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds();
        campos = 'fecha_registro=' + fecha_registro;
    }
    return campos;
}

/**
 * Opcion para guardar un nuevo registro
 * @param {type} formato
 * @param {type} camposClave
 * @param {type} observaciones
 * @returns {undefined}
 */
function opcRegistrar(formato, camposClave, observaciones) {
    //Se toma la información del formato
    var info = $('#visualizarFormato').serialize();
//    console.log(info);
    //Se toma la fecha del sistema
    var fechaFormato = $('input[type="date"]:first').val();
    //se valida que no sea nula, de lo contrario se toma la actual
    if (fechaFormato === '') {
        var f = new Date();
        fechaFormato = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
    }
    //Se llama el método por AJAX
    $.post('../../controlador/Formato_controller.php', {formato: formato, fechaFormato: fechaFormato, camposClave: camposClave, observaciones: observaciones, info: info, opcion: 'diligenciarFormato'},
    function (msj) {
        var mensaje = msj;
        if (mensaje == 1) {
            //Se guarda el mensaje y se redirecciona a la tabla de registros
            sessionStorage.setItem('mensaje', '¡La información ha sido registrada con éxito!');
            window.location.href = ('mostrarRegistrosFormato.php');
        }
        else if (mensaje == 0) {
            toastr["error"]('Favor revisar si el registro ha sido creado anteriormente teniendo en cuenta los campos clave');
            toastr["info"]('Dirigirse a mostrar registros');
            $('.campoClave').css('border-color', 'red');
            $('#res1').html('Favor revisar si el registro ha sido creado anteriormente teniendo en cuenta los campos clave<br>Dirigirse a mostrar registros');
        }
    });
}

/**
 * Opción para modificar un registro de un formato
 * @param {type} formato
 * @param {type} camposClave
 * @param {type} observaciones
 * @param {type} info
 * @returns {undefined}
 */
function opcModificar(formato, camposClave, observaciones, info) {
    var infoModificadaUsuario = sessionStorage.getItem('infoMod');
    sessionStorage.setItem('infoMod', '');
    sessionStorage.removeItem('infoMod');
    console.log(infoModificadaUsuario);
    //Se toma la fecha del sistema que es clave primaria en la base de datos
    var fecha = sessionStorage.getItem('fecha');
    console.log(info);
    //Se ejecuta la modificación en la BD
    $.post('../../controlador/Formato_controller.php', {formato: formato, fechaFormato: fecha, camposClave: camposClave, infoMod: infoModificadaUsuario, observaciones: observaciones, info: info, opcion: 'modificarRegistroFormato'},
    function (mensaje) {
        //Se muestra el mensaje de retorno
        $('#res1').html(mensaje);
        toastr["info"](mensaje);
    });
}

/**
 * Se validan los campos obligatorios y que pertenezcan a un dominio
 * @returns {Boolean}
 */
function validarRequeridos() {
    //se recorre cada campo del formato
    var requeridos = true;
    $('input').each(function () {
        //se cierra el modal
        $('#myModal').modal('hide');
        //Se toma el input sobre el cual se está recorriendo
        var input = $(this);
        //Si los campos de entrada son obligatorios
        if (input.attr('required') === 'required') {
            //si son vacíos
            if (input.val() === '') {
                //se cierra el modal y se enfoca el campo de entrada sobre el que está
                $('#myModal').on('hidden.bs.modal', function () {
                    input.focus();
                });
                //Mostrar el campo obligatorio mediante un mensaje
                var msj = 'Favor digitar el campo obligatorio:<br>' + input.attr('id');
                $('#res1').html(msj);
                toastr["info"](msj);
                //se retorna true para cancelar el proceso de registro
                requeridos = false;
                return false;
            }
        }
        //Si los campos de entrada ya tienen un valor
        if (input.val() !== '') {
            //Se verifica con el dominio del campo de entrada
            requeridos = valorNoVacio(input);
            if (!requeridos) {
                //retorna falso en caso de que no correspona al dominio
                return false;
            }
        }
    });

    //retorna boolean para seguir con el proceso de registro
    return requeridos;
}

/**
 * Se verifica el valor con el dominio del campo de entrada
 * @param {type} input
 * @returns {Boolean}
 */
function valorNoVacio(input) {
    //Se toma el valor del input
    var valor = $(input).val();
    //se toma el tipo del input
    var type = $(input).attr('type');
    //Se toma el dominio del input
    var patron = $(input).attr('pattern');
    //se toma la descripción del input
    var titulo = $(input).attr('title');
    //Se convierte a expresión regular el dominio
    var re = new RegExp(patron);
    var requeridos = true;

    //si el input es de tipo texto
    if (type === "text") {
        //Se compara con la expresion regular
        requeridos = (re.test(valor));
    }
    // si es número
    if (type === "number") {
        //Se toma el valor, el valor máximo y el valor mínimo
        valor = Number(valor);
        var min = Number(input.attr('min'));
        var max = Number(input.attr('max'));
        //se compara que esté dentro del dominio
        if (valor < min || valor > max) {
            //Se muestra el mensaje de error
            titulo = 'Dato fuera del rango permitido';
            requeridos = false;
        }
    }
    //Se enfoca el campo con el error
    if (!requeridos) {
        $('#myModal').on('hidden.bs.modal', function () {
            input.focus();
        });
        toastr['info'](titulo);
    }
    //Se retorna true si no se presentan errores
    return requeridos;
}

/**
 * Se redirecciona mostrar registros de un formato
 * @param {type} cod
 * @returns {undefined}
 */
function mostrarRegistrosFormato(cod) {
    //Se guarda el código del formato
    sessionStorage.setItem('formato', cod);
    //Se redirecciona
    location.href = ('formato/mostrarRegistrosFormato.php');
}

/**
 * Se redirecciona para ver un registro de un formato
 * @param {type} fecha
 * @returns {undefined}
 */
function verDatos(fecha) {
    //Se guarda la fecha como clave de busqueda del formato
    sessionStorage.setItem('fecha', fecha);
    //Se redirecciona
    location.href = ('mostrarRegistro.php');
}


function cargarRegistro2() {
//    console.log('metodo cargar registro');
    //Se toma el código del formato y la fecha del registro
    var formato = sessionStorage.getItem('formato');
    var fecha = sessionStorage.getItem('fecha');

    //Se visualiza la plantilla del formato 
    $.post("../../controlador/Formato_controller.php", {formato: formato, fecha: fecha, opcion: "visualizarRegistro"},
    function (mensaje) {
//        console.log('metodo BD');
        var arr = mensaje.split('###');
        var html = arr[1];
        var datos = arr[0];
//        console.log('pintar el formato');

        //Se inactivan algunos campos
        $('#visualizarFormato').prepend(html);
        $('div').css('border-style', 'none');
        $('select').attr('disabled', true);

//        console.log('pintar los datos');
        //Se particiona la cadena devuelta por la consulta a la base de datos por el símbolo &
        var arreglo = datos.split('&');
        //Se recorre ese arreglo
        for (i = 0; i < arreglo.length - 1; i++) {
            //Para cada posición se particiona por el símbolo =
            var div = arreglo[i].split('=');
            //La clave es la primera posición de ese arreglo y el valor es la segunda
            var clave = '#' + div[0];
            var valor = div[1];

            //Se agrega el valor al input que tenga por nombre la clave
            var name = 'input[value="' + div[1] + '"]';
            $(clave).val(valor);
            if($(clave).is('input')){
                $(clave).attr('value',valor);
            }

            //Si es de tipo checkbox o una lista
            $(name).prop('checked', true);
            $(name).prop('selected', true);

            //Si es de tipo radio
            var radio = 'input[value="' + div[1] + '"]';
            $(radio).prop('checked', true);

        }
//        console.log('finalización del método');
    });



}

///**
// * Carga un registro de un formato Método que presenta error en PC de pasta.
// * Doble consulta a la BD desde la vista
// * @returns {undefined}
// */
//function cargarRegistro() {
//    //Se toma el código del formato y la fecha del registro
//    var formato = sessionStorage.getItem('formato');
//    var fecha = sessionStorage.getItem('fecha');
////    console.log(formato, fecha);
//
//    //Se visualiza la plantilla del formato 
//    $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
//    function (mensaje) {
//        //Se inactivan algunos campos
//        $('#visualizarFormato').prepend(mensaje);
//        $('div').css('border-style', 'none');
//        $('select').attr('disabled', true);
//    });
//
//    //Se cargan los datos en la plantilla del formato mediante AJAX
//    $.post("../../controlador/Formato_controller.php", {formato: formato, fecha: fecha, opcion: "verDatos"},
//    function (mensaje) {
////        console.log(mensaje);
//        //Se particiona la cadena devuelta por la consulta a la base de datos por el símbolo &
//        var arreglo = mensaje.split('&');
//        //Se recorre ese arreglo
//        for (i = 0; i < arreglo.length - 1; i++) {
//            //Para cada posición se particiona por el símbolo =
//            var div = arreglo[i].split('=');
//            //La clave es la primera posición de ese arreglo y el valor es la segunda
//            var clave = '#' + div[0];
//            var valor = div[1];
//
//            //Se agrega el valor al input que tenga por nombre la clave
//            var name = 'input[value="' + div[1] + '"]';
//            $(clave).val(valor);
//
//            //Si es de tipo checkbox o una lista
//            $(name).prop('checked', true);
//            $(name).prop('selected', true);
//
//            //Si es de tipo radio
//            var radio = 'input[value="' + div[1] + '"]';
//            $(radio).prop('checked', true);
//
//        }
//    });
//}

/**
 * Se redirecciona para visualizar el formato
 * @param {type} cod
 * @returns {undefined}
 */
function visualizarFormato(cod) {
    //Se guarda el código del formato
    sessionStorage.setItem('formato', cod);
    //Se redirecciona
    location.href = ('formato/visualizarFormato.php');
}

/**
 * Visualizar la plantilla del formato
 * @param {type} opcion
 * @returns {undefined}
 */
function verFormato(opcion) {
    //se toma el código del formato
    var formato = sessionStorage.getItem('formato');
    //Se realiza la consulta a la BD
    $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
    function (mensaje) {
        //Se carga el archivo
        $('#visualizarFormato').prepend(mensaje);
        //Se remueven algunas propiedades para inhabilitar la escritura 
        $('.isSelected').removeClass('isSelected');
        $('div').css('border-style', 'none');
        $('select').attr('disabled', true);
        $('table').addClass('table-bordered');
        $('table').addClass('table-hover');
        //Si la opcion es diligenciar
        if (opcion === 'diligenciar') {
            verDiligenciar();
        }
        //Si la opcion es analizar el formato
        if (opcion === 'analizar') {
            verAnalizar();
        }
    });
}

/**
 * Se carga la plantilla para el diligenciamiento del formato
 * @returns {undefined}
 */
function verDiligenciar() {
    //Se quitan las propiedades inhabilitadas
    $('[disabled]').removeAttr('disabled');
    //Se cargan fechas actuales por defecto en el sistema
    //Se inicializa el tipo Date
    var date = new Date();
    //Se crea el año, mes, día, hora, minuto
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    var hour = date.getHours();
    var min = date.getMinutes();
    //Se añaden cerosa la izquierda a datos menores de 10
    if (month < 10)
        month = "0" + month;
    if (day < 10)
        day = "0" + day;
    //Se actualiza la fecha y hora de hoy
    var today = year + "-" + month + "-" + day;
    var hora = hour + ":" + min;
    //Se actualizan todos los input
    $('input[type="date"]').val(today);
    $('input[type="time"]').val(hora);
    var user = sessionStorage.getItem('user');
    $('#nombre').val(user);
    $('#operario').val(user);
    $('#operador').val(user);
    $('#nombre_operador').val(user);
    $('#nombre_operario').val(user);
}

/**
 * Se carga la plantilla para seleccionar las opciones a analizar en el formato
 * @returns {undefined}
 */
function verAnalizar() {
    //Se habilitan los input para que sean seleccionables y se convierten a tipo button
    $('#visualizarFormato [disabled]').removeAttr('disabled');
    $('#visualizarFormato input[type="text"]').attr("type", "button");
    $('#visualizarFormato input[type="number"]').attr("type", "button");
    var opcion = $('#visualizarFormato input[type="radio"]:first');
    opcion.attr('type', 'button');
    //Si es de tipo adio solo se deja un input para seleccionar
    $('#visualizarFormato input[type="radio"]').each(function () {
        //Se selecciona un input
        var input = $(this);
        //Si el input tiene el mismo nombre del radio anterior
        if (input.attr('name') === opcion.attr('name')) {
            //Se remueve el texto que lo acompaña
            input.next('p').remove();
//            y se remueve el input
            input.remove();
        }
        //Si el input es de tipo botón
        else {
            opcion = input;
            opcion.attr('type', 'button');
        }
        //Actualizo el valor
        opcion.attr('value', '');
        opcion.next('p').remove();
    });
    //Se recorre cada checkbox
    $('#visualizarFormato input[type="checkbox"]').each(function () {
        //Se remueve el contenido de texto que tiene el input
        $(this).next('p').remove();
        $(this).attr("type", "button");
    });
    //Si el input es de tipo date
    $('#visualizarFormato input[type="date"]').each(function () {
        //Se desaparece de la plantilla
        $(this).parent().remove();
    });
    //Si es una lista 
    $('#visualizarFormato select').each(function () {
        //Se toma el nombre y el padre del elemento 
        var name = $(this).attr('name');
        var div = $(this).parent();
        //Se remueve el elemento
        $(this).remove();
        //Se crea un nuevo elemento con el nombre del input eliminado
        $(div).append('<input id="' + name + '" name="' + name + '" type="button"/>');
    });

    //Si tiene una tabla
    $('#visualizarFormato table').each(function () {
        var table = $(this);
        var columnas = '';
        table.children('tbody').hide();
//        table.children('thead td').each(function(){
//            var name=$(this).text();
//            var columna='<input id="' + name + '" name="' + name + '" type="button"/>';
//            columnas+=columna;
//        });
    });

}

/**
 * Se modifica el registro del formato
 * @returns {undefined}
 */
function modificarDiligenciaFormato() {
    //Buscar campos en la tabla de usuario_información
    var formato = sessionStorage.getItem('formato');
    var fecha = sessionStorage.getItem('fecha');


    $.post("../../controlador/Formato_controller.php", {formato: formato, fecha: fecha, opcion: "buscarCamposUsuario"},
    function (mensaje) {
        if (mensaje !== '') {
            console.log(mensaje);
            //Se particiona la cadena devuelta por la consulta a la base de datos por el símbolo &
            var arreglo = mensaje.split('&');
            //Se recorre ese arreglo
            for (i = 0; i < arreglo.length - 1; i++) {
                //Para cada posición se particiona por el símbolo =
                var div = arreglo[i].split('=');
                //La clave es la primera posición de ese arreglo y el valor es la segunda
                var clave = '#' + div[0];
                var valor = div[1];
                //Activar los campos que el usuario ha diligenciado, los demás no
                $(clave).attr('disabled', false);
                $(clave).addClass('claseModificada');
            }
        }
    });

    $('input').each(function (i) {
        var input = $(this);
        if (input.val() === '' || input.attr('type') === 'checkbox' || input.attr('type') === 'radio') {
            input.attr('disabled', false);
        }
    });
    $('select').each(function (i) {
        var select = $(this);
        if (select.val() === '') {
            select.attr('disabled', false);
        }
    });

    //Se activan los campos de tipo textarea
    $('textarea').attr('disabled', false);
    $('#guardarRegistro').show();
    $('#modificarRegistro').hide();
}

/**
 * Guardar una modificación de un registro en un formato
 * @returns {undefined}
 */
function guardarMR() {
    //Se activan los campos, listas y opciones
    $('input').attr('disabled', false);
    $('textarea').attr('disabled', false);
    $('select').attr('disabled', false);
    
    //Se obtiene la información del formato
    var info = $('#visualizarFormato').serialize();
    //Se obtiene la modificación de los campos.
    var infoMod=$('.claseModificada').serialize();
    sessionStorage.setItem('infoMod',infoMod );
    console.log(info);
    console.log(infoMod);
    
    //Se inactivan los campos, listas y opciones
    $('input').attr('disabled', true);
    $('textarea').attr('disabled', true);
    $('select').attr('disabled', true);
    //Se guarda la modificación
    guardarDiligenciaFormato('modificar', info);
    //Se cambia los botones de acción
    $('#guardarRegistro').hide();
    $('#modificarRegistro').show();
}

/**
 * Se redirecciona para analizar un formato
 * @param {type} cod
 * @returns {undefined}
 */
function analizarFormato(cod) {
    //Se guarda el código del formato
    sessionStorage.setItem('formato', cod);
    //Se redirecciona
    location.href = ('formato/trazabilidadFormato.php');
}

/**
 * Se redirecciona para ver las versiones de un formato
 * @param {type} cod
 * @param {type} version
 * @returns {undefined}
 */
function verVersion(cod, version) {
    //Se guarda el código y la versión del formato
    sessionStorage.setItem('formato', cod);
    sessionStorage.setItem('version', version);
    //Se redirecciona
    location.href = ('versionFormato.php');
}

/**
 * Se visualiza la versión de un formato
 * @returns {undefined}
 */
function verVersionFormato() {
    //Se toma el código y la versión de un formato
    var formato = sessionStorage.getItem('formato');
    var version = sessionStorage.getItem('version');

    //Se busca la versión en la BD
    $.post("../../controlador/Formato_controller.php", {formato: formato, version: version, opcion: "verVersionFormato"},
    function (mensaje) {
        //Se inactivan todos los campos de entrada.
        $('#visualizarFormato').prepend(mensaje);
        $('div').css('border-style', 'none');
        $('select').attr('disabled', true);
    });
}

$('#formRegFormat').submit(function (event) {
    console.log('entro');
    $('select').each(function () {
        console.log($(this).attr('name'));
        console.log($(this).val());
        if ($(this).val() === "seleccione") {
            event.preventDefault();
            var msj = "Favor seleccionar una opción de " + $(this).attr('name');
            toastr["error"](msj);
            $(this).focus();
            return false;
        }
    });

});