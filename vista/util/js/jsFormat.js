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

function modificarFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/modificarFormato.php');
}

function historialFormato(cod){
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/historialFormato.php');
}

function diligenciarFormato(cod) {
    sessionStorage.setItem('formato', cod);
    location.href = ('formato/diligenciarFormato.php');
}


