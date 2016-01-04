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
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });
});



function limpiar() {
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
}

