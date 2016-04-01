/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var html;

$(document).ready(function () {
    autocompletarFormato();
});

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

function btnAsignar() {
    var formato = $('#formatoAsignar').val();
    var usuario = $('#cod_usuario').val();
    console.log(formato + " " + usuario);
    $.post("../controlador/Formato_controller.php", {formato: formato, usuario: usuario, opcion: "asignarFormato"},
    function (mensaje) {
        Materialize.toast(mensaje, 5000, 'rounded');
    });

}

function modificarFormato(cod) {
    location.href = ('formato/crearFormato.php');
}

function diligenciarFormato(cod) {
    $.post("../controlador/Formato_controller.php", {formato: cod, opcion:"diligenciarFormato"},
    function (mensaje) {
        html=mensaje;
        window.location.href='./formato/diligenciarFormato.php';
    });
//    location.href=('formato/diligenciarFormato.php');
}

function cargarPagina(){
    $('#diligenciarFormato').html(html);
}
