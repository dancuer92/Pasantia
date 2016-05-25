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
        toastr["info"](mensaje);
    });

}

function btnDesasignar() {
    var formato = $('#formatoDesasignar').val();
    var usuario = $('#cod_usuarioDes').val();
    console.log(formato + " " + usuario);
    $.post("../controlador/Formato_controller.php", {formato: formato, usuario: usuario, opcion: "desasignarFormato"},
    function (mensaje) {
        toastr["info"](mensaje);
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
            toastr["info"](mensaje);
//        Materialize.toast(mensaje, 5000, 'rounded');
        })
    }
    else {
        res.html('Por favor adicione elementos al nuevo formato');
        toastr["info"]('Por favor adicione elementos al nuevo formato');
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
            toastr["info"](mensaje);
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

function guardarDiligenciaFormato(opcion, info) {
    var formato = sessionStorage.getItem('formato');
    var requeridos = validarRequeridos();
    console.log(requeridos + "7");
    if (requeridos) {
        var observaciones = $('#observaciones').val();
        if (opcion === 'registrar') {
            opcRegistrar(formato, observaciones);
        }
        if (opcion === 'modificar') {
            opcModificar(formato, observaciones, info);
        }
    }
}

function opcRegistrar(formato, observaciones) {
    var info = $('#visualizarFormato').serialize();
    console.log(info);
    var fechaFormato = $('#fecharegistro').val();
    if (fechaFormato === '') {
        var f = new Date();
        fechaFormato = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
    }
    $.post('../../controlador/Formato_controller.php', {formato: formato, fechaFormato: fechaFormato, observaciones: observaciones, info: info, opcion: 'diligenciarFormato'},
    function (mensaje) {
//            confirm(mensaje);
        $('#res1').html(mensaje);
        toastr["info"](mensaje);
//            console.log(mensaje);
    });
}

function opcModificar(formato, observaciones, info) {
    var fecha = sessionStorage.getItem('fecha');
    console.log(info);
    $.post('../../controlador/Formato_controller.php', {formato: formato, fechaFormato: fecha, observaciones: observaciones, info: info, opcion: 'modificarRegistroFormato'},
    function (mensaje) {
        $('#res1').html(mensaje);
        toastr["info"](mensaje);
    });
}

function validarRequeridos() {
    var requeridos = true;
    $('input[required]').each(function () {
        var input = $(this);
        if (input.val() == '') {
            $('#myModal').modal('hide');
            $('#myModal').on('hidden.bs.modal', function () {
                input.focus();
            });
            var msj = 'Favor digitar el campo obligatorio:<br>' + input.attr('id');
            $('#res1').html(msj);
            toastr["info"](msj);
            requeridos = false;
            return false;
        }
    });
    return requeridos;
}

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
//    console.log(formato, fecha);

    $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
    function (mensaje) {
        $('#visualizarFormato').prepend(mensaje);
        $('div').css('border-style', 'none');
        $('select').attr('disabled', true);
    });

    $.post("../../controlador/Formato_controller.php", {formato: formato, fecha: fecha, opcion: "verDatos"},
    function (mensaje) {
//        console.log(mensaje);
        var arreglo = mensaje.split('&');
        for (i = 0; i < arreglo.length - 1; i++) {
            var div = arreglo[i].split('=');
            var clave = '#' + div[0];
            var valor = div[1];

            var name = 'input[name=' + div[0] + ']';
            $(name).prop('checked', true);

//            $(name).val(valor);
            $(clave).val(valor);
        }
    });
}

function visualizarFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/visualizarFormato.php');
}

function verFormato(opcion) {
    var formato = sessionStorage.getItem('formato');

    $.post("../../controlador/Formato_controller.php", {formato: formato, opcion: "visualizarFormato"},
    function (mensaje) {
        $('#visualizarFormato').prepend(mensaje);
        $('div').css('border-style', 'none');
        $('select').attr('disabled', true);
        if (opcion === 'diligenciar') {
            verDiligenciar();
        }
        if (opcion === 'analizar') {
            verAnalizar();
        }
    });
}

function verDiligenciar() {
    $('[disabled]').removeAttr('disabled');    
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (month < 10)
        month = "0" + month;
    if (day < 10)
        day = "0" + day;
    var today = year + "-" + month + "-" + day;
    $('input[type="date"]').val(today);
}

function verAnalizar() {
    $('[disabled]').removeAttr('disabled');
    $('input[type="text"]').attr("type","checkbox");
    $('input[type="number"]').attr("type","checkbox");
    var nombreR=$('input[type="option"]:first').attr('id');
    console.log(nombreR);
    $('input[type="option"]').each(function(){
        var input=$(this);
        if(input.attr('id')===nombreR){
            
        }
    });
}

function modificarDiligenciaFormato() {
    $('input').attr('disabled', false);
    $('textarea').attr('disabled', false);
    $('select').attr('disabled', false);
    $('#guardarRegistro').show();
    $('#modificarRegistro').hide();
}

function guardarMR() {
    var info = $('#visualizarFormato').serialize();
//    console.log(info);
    $('input').attr('disabled', true);
    $('textarea').attr('disabled', true);
    $('select').attr('disabled', true);
    guardarDiligenciaFormato('modificar', info);
    $('#guardarRegistro').hide();
    $('#modificarRegistro').show();
}

function analizarFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/trazabilidadFormato.php');
}