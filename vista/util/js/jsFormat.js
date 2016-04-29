/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 * @returns {undefined}
 */
function autocompletarFormato() {
    var keyword = $('#cod_formato').val();
    $.post("../controlador/Formato_controller.php", {formato: keyword, opcion: "cargarFormatos"},
    function (mensaje) {
        $('#tabla_formatos').html(mensaje);
        $('.tooltipped').tooltip();
    });
}

function asignarFormato(formato) {
    $('#asignarFormato').openModal();
    $('#formatoAsignar').val(formato);
}

function desasignarFormato(formato) {
    $('#desasignarFormato').openModal();
    $('#formatoDesasignar').val(formato);
}

function btnAsignar() {
    var formato = $('#formatoAsignar').val();
    var usuario = $('#cod_usuario').val();
    console.log(formato + " " + usuario);
    $.post("../controlador/Formato_controller.php", {formato: formato, usuario: usuario, opcion: "asignarFormato"},
    function (mensaje) {
        Materialize.toast(mensaje, 5000, 'rounded');
    });

}

function btnDesasignar() {
    var formato = $('#formatoDesasignar').val();
    var usuario = $('#cod_usuarioDes').val();
    console.log(formato + " " + usuario);
    $.post("../controlador/Formato_controller.php", {formato: formato, usuario: usuario, opcion: "desasignarFormato"},
    function (mensaje) {
        console.log(mensaje);
        Materialize.toast(mensaje, 5000, 'rounded');
    });
}

/**
 * Método que se encarga de guardar el html del formato generado en la base de datos.
 * @returns {undefined}
 */
function guardarRegistroFormato() {
    var codigoF = $('#codigoFormato').val();
    var nombreF = $('#nombreFormato').val();
    var procedimientoF = $('#procedimientoFormato').val();
    var directorF = $('#directorProcedimiento').val();
    var frecuenciaF = $('#frecuenciaFormato').val();
    var tipoF = $('#tipoFormato').val();
    var descripcionF = $('#descripcionFormato').val();
    var formato = $('#formBuilder').html();
    var res = $('#res1');
//    var res = $('#res1').text(formato);
    console.log(codigoF, nombreF);

    if (codigoF !== '') {
        $.post("../../controlador/Formato_controller.php",
                {codigoF: codigoF, nombreF: nombreF, procedimientoF: procedimientoF, directorF: directorF, frecuenciaF: frecuenciaF, tipoF: tipoF, descripcionF: descripcionF, codigoHTML: formato, opcion: 'guardarFormato'},
        function (mensaje) {
            res.html(mensaje);
//        Materialize.toast(mensaje, 5000, 'rounded');
        })
    }
    else {
        res.html('Por favor adicione elementos al nuevo formato');
    }


}

function modificarFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/modificarFormato.php');
}

function guardarModificacionFormato() {
    var formato = sessionStorage.getItem('formato');
    var detalle = $('#detForm').val();
    var observaciones = $('#obsForm').val();
    var html = $('#formBuilder').html();

    if (detalle === '') {
        $('#pestañaFormulario').click();
        $('#detForm').focus();
    }
    else if (observaciones === '') {
        $('#pestañaFormulario').click();
        $('#obsForm').focus();
    }
    else {
        $.post("../../controlador/Formato_controller.php", {formato: formato, detalle: detalle, observaciones: observaciones, html: html, opcion: 'modificarFormato'},
        function (mensaje) {
            $('#res1').html(mensaje);
        });
    }
}

function historialFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/historialFormato.php');
}

function cargarHistorial(formato) {
    $.post('../../controlador/Formato_controller.php', {formato: formato, opcion: 'historialFormato'},
    function (mensaje) {
        $('#tabla_historial tbody').append(mensaje);
        $('#tabla_historial').DataTable({responsive: true});
    });
}

function diligenciarFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/diligenciarFormato.php');
}

function guardarDiligenciaFormato() {
    var formato = sessionStorage.getItem('formato');
    var requeridos = validarRequeridos();

    if (requeridos) {
//        var info = JSON.stringify($('#diligenciarFormato').serializeArray());
//        var info = JSON.stringify($('#diligenciarFormato'));
//        var info = $('#diligenciarFormato').serializeArray();
//        var info = $('#diligenciarFormato').serialize();
//        var info = $('#diligenciarFormato').serializeObject();
//        var info = JSON.stringify($('#diligenciarFormato').serializeObject());
//        console.log(info);
//        $('#res1').html(info.toString());

        var info = $('#visualizarFormato').serialize();
        console.log(info);
        var fechaFormato = $('#fecharegistro').val();
        if (fechaFormato === '') {
            fechaFormato = '---';
        }
        var observaciones = $('#observaciones').val();
        $.post('../../controlador/Formato_controller.php', {formato: formato, fechaFormato: fechaFormato, observaciones: observaciones, info: info, opcion: 'diligenciarFormato'},
        function (mensaje) {
//            confirm(mensaje);
            $('input').val('');
            $('#res1').html(mensaje);
//            console.log(mensaje);
        });
    }
}

function validarRequeridos() {
    var requeridos = false;
    $('input[required]').each(function () {
        var input = $(this);
//        console.log($(this).attr('id'));
        var value = $(input).val();
        if (value !== '') {
            requeridos = true;
        }
        else {
            $('#myModal').modal('hide');
            alert('Favor rellenar los campos vacíos: \n'+input.attr('id'));
//            $(input).focus();
            requeridos = false;
            return false;
        }
    });
    return requeridos;
}

(function ($) {
    $.fn.serializeObject = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);

function mostrarRegistrosFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/mostrarRegistrosFormato.php');
}

function verDatos(fecha) {
    sessionStorage.setItem('fecha', fecha);
    location.href = ('mostrarRegistro.php');
}

function cargarRegistro() {
    var formato = sessionStorage.getItem('formato');
    var fecha = sessionStorage.getItem('fecha');
    console.log(formato, fecha);

    $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
    function (mensaje) {
        $('#ver_datos').prepend(mensaje);
        $('div').css('border-style', 'none');
        $('select').attr('disabled', true);
    });

    $.post("../../controlador/Formato_controller.php", {formato: formato, fecha: fecha, opcion: "verDatos"},
    function (mensaje) {
        var arreglo = mensaje.split(';');
        for (i = 0; i < arreglo.length - 1; i++) {
            var div = arreglo[i].split('=');
            var clave = '#' + div[0];

            var valor = div[1].replace(/ +/g, ' ');
            var name = 'input[name=' + div[0] + ']';
            $(name).prop('checked', true);

            $(name).val(valor);
            $(clave).val(valor);
        }
    });
}

function visualizarFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/visualizarFormato.php');
}

function verFormato() {
    var formato = sessionStorage.getItem('formato');
    console.log(formato);

    $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
    function (mensaje) {
        $('#visualizarFormato').prepend(mensaje);
        $('div').css('border-style', 'none');
        $('input').attr('disabled', false);
        $('textarea').attr('disabled', false);
    });
}
