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
    console.log(requeridos);
    //Se guarda la información
    if (requeridos) {
        //se oculta el modal
        $('#myModal').modal('hide');
        //Se toman las observaciones por el usuario o por defecto del sistema
        var observaciones = sessionStorage.getItem('observaciones');
        console.log(observaciones);
        if (observaciones === '') {
            observaciones = 'Sin observaciones';
        }
        //Si la opción es registrar
        if (opcion === 'registrar') {
            opcRegistrar(formato, observaciones);
        }
        //Si la opcion es modificar el registro de un formato
        if (opcion === 'modificar') {
            opcModificar(formato, observaciones, info);
        }
    }
}

/**
 * Opcion para guardar un nuevo registro
 * @param {type} formato
 * @param {type} observaciones
 * @returns {undefined}
 */
function opcRegistrar(formato, observaciones) {
    //Se toma la información del formato
    var info = $('#visualizarFormato').serialize();
//    console.log(info);
    //Se toma la fecha del sistema
    var fechaFormato = $('#fecharegistro').val();
    //se valida que no sea nula, de lo contrario se toma la actual
    if (fechaFormato === '') {
        var f = new Date();
        fechaFormato = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
    }
    //Se llama el método por AJAX
    $.post('../../controlador/Formato_controller.php', {formato: formato, fechaFormato: fechaFormato, observaciones: observaciones, info: info, opcion: 'diligenciarFormato'},
    function (mensaje) {
        //Se guarda el mensaje y se redirecciona a la tabla de registros
        sessionStorage.setItem('mensaje', mensaje);
        location.href = ('mostrarRegistrosFormato.php');
    });
}

/**
 * Opción para modificar un registro de un formato
 * @param {type} formato
 * @param {type} observaciones
 * @param {type} info
 * @returns {undefined}
 */
function opcModificar(formato, observaciones, info) {
    //Se toma la fecha del sistema que es clave primaria en la base de datos
    var fecha = sessionStorage.getItem('fecha');
    console.log(info);
    //Se ejecuta la modificación en la BD
    $.post('../../controlador/Formato_controller.php', {formato: formato, fechaFormato: fecha, observaciones: observaciones, info: info, opcion: 'modificarRegistroFormato'},
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
    console.log(type);
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

/**
 * Carga un registro de un formato
 * @returns {undefined}
 */
function cargarRegistro() {
    //Se toma el código del formato y la fecha del registro
    var formato = sessionStorage.getItem('formato');
    var fecha = sessionStorage.getItem('fecha');
//    console.log(formato, fecha);

    //Se visualiza la plantilla del formato 
    $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
    function (mensaje) {
        //Se inactivan algunos campos
        $('#visualizarFormato').prepend(mensaje);
        $('div').css('border-style', 'none');
        $('select').attr('disabled', true);
    });

    //Se cargan los datos en la plantilla del formato mediante AJAX
    $.post("../../controlador/Formato_controller.php", {formato: formato, fecha: fecha, opcion: "verDatos"},
    function (mensaje) {
//        console.log(mensaje);
        //Se particiona la cadena devuelta por la consulta a la base de datos por el símbolo &
        var arreglo = mensaje.split('&');
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

            //Si es de tipo checkbox o una lista
            $(name).prop('checked', true);
            $(name).prop('selected', true);
            
            //Si es de tipo radio
//            var radio = 'input[value=' + div[1] + ']';
//            $(radio).prop('checked', true);

        }
    });
}

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
    //Se crea el año, mes, día
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    //Se añaden cerosa la izquierda a datos menores de 10
    if (month < 10)
        month = "0" + month;
    if (day < 10)
        day = "0" + day;
    //Se actualiza la fecha de hoy
    var today = year + "-" + month + "-" + day;
    //Se actualizan todos los input
    $('input[type="date"]').val(today);
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

}

/**
 * Se modifica el registro del formato
 * @returns {undefined}
 */
function modificarDiligenciaFormato() {
    //Se activan los campos para que el formato sea escribible
    $('input').attr('disabled', false);
    $('textarea').attr('disabled', false);
    $('select').attr('disabled', false);
    $('#guardarRegistro').show();
    $('#modificarRegistro').hide();
}

/**
 * Guardar una modificación de un registro en un formato
 * @returns {undefined}
 */
function guardarMR() {
    //Se obtiene la información del formato
    var info = $('#visualizarFormato').serialize();
//    console.log(info);
    //Se inactivan los cmapos, listas y opciones
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