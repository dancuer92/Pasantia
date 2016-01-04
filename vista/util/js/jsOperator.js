
$(document).ready(function () {
    $(".button-collapse").sideNav();
    $('ul.tabs').tabs();
    $(".dropdown-button").dropdown();
    $('select').material_select();

    $('.contenido').hide();
    $('#miPerfil').show();

    $('#perfil').click(function () {
        $('.contenido').hide();
        $('#miPerfil').show();
        misDatos();
    });
    $('#perfilM').click(function () {
        $('.contenido').hide();
        $('#miPerfil').show();
        misDatos();
    });
    $('#cambiar').click(function () {
        $('.contenido').hide();
        $('#cambiarPassword').show();
    });
    $('#cambiarPasswordM').click(function () {
        $('.contenido').hide();
        $('#cambiarPassword').show();
    });
});

function limpiar() {
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
}
