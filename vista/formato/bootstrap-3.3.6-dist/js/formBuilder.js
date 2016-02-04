/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('crearFormato2').ready(function () {
    var currentlySelected = '';
    $('.new-element').click(function () {
        $('#myTabs a[href="#propiedades"]').tab('show');
        var opcion = $(this).attr('data-type');
        var currentlySelected = clearElementSelected();
//        console.log(opcion);
        $.post("../formato/elemento.php", {opcion: opcion},
        function (mensaje) {
            $('#formBuilder').append(mensaje);
            var newElement = $('#formBuilder div:last');
            currentlySelected = newElement;
            newElement.addClass('isSelected');
            nombrarElementos();
            mostrarConfiguraciones(currentlySelected);
//            console.log(currentlySelected);
        });
    });


    $('#formBuilder').on("click", "div", function () {
        clearElementSelected();
        $(this).addClass('isSelected');
        currentlySelected = $(this);
        mostrarConfiguraciones(currentlySelected);
        $('#formBuilder').sortable({revert: true});
        console.log(currentlySelected);
    });




});




//--------------------------------------FUNCIONES--------------------------------



function cambiarTitulo() {
    var titulo = $('#cambiarTitulo').val();
    if ($('#formBuilder div').find('.isSelected')) {
        var div = $('#formBuilder').find('div.isSelected');
        var label = $('#formBuilder').find('div.isSelected').children('label');
        var input = $('#formBuilder').find('div.isSelected').children('input').attr('type');

        if (input === 'text' || input === 'number') {
            var input = $('#formBuilder').find('div.isSelected').children('input');
            input.attr('id', titulo);
        }
        label.html(titulo);
    }
    ;
}
;

function clearElementSelected() {
    $('#formBuilder div').each(function () {
        $(this).removeClass('isSelected');
    });
}
;

function nombrarElementos() {
    $('#formBuilder div').each(function (i) {
        var id = 'element-' + i;
        $(this).attr('id', id);
    });
}
;

function limpiarTitulo() {
    clearElementSelected();
    $('#cambiarTitulo').val('');
}
;

function mostrarConfiguraciones(div) {
    var elemento = div;
    var tipo = elemento.children('input').attr('type');
    if (tipo === 'checkbox' || tipo === 'radio') {
        $('#opciones').show();
        //cargar opciones automaticamente.
        cargarOpciones(elemento);
    }
    else {
        $('#opciones').hide();
    }
}

function cargarOpciones(div) {
    var msj = '<label>Configuración de opciones</label><br>\n\
                <button class="btn btn-default" onclick="adicionar();">Adicionar</button>\n\
                <button class="btn btn-default" onclick="remover()">Remover</button>';
    div.children('input').each(function (i) {
        msj += '<input id="opcion-' + i + '" type="text" value="" class="form-control" placeholder="Opción-' + i + '"/>';
    });
    $('#opciones').html(msj);
}

function adicionar() {
    var pos=$('#opciones input').length;
    var div = $('#opciones').append('<input id="opcion-' + (pos) + '" type="text" value="" class="form-control" placeholder="Opción-' + (pos) + '"/>');
    console.log(div);
    adicionarOpcion();
}

function adicionarOpcion() {
    var div = $('#formBuilder').find('.isSelected');
    var tipo = div.children('input').attr('type');
    var pos = div.children('input').length;


    if (tipo === 'checkbox') {
        $.post("../formato/elemento.php", {opcion: "element-option-checkbox", pos:pos+1},
        function (mensaje) {
            $(div).append(mensaje);
        });
    }
    if(tipo=== 'radio'){
        $.post("../formato/elemento.php", {opcion: "element-option-radio", pos:pos+1},
        function (mensaje) {
            $(div).append(mensaje);
        });
    }
}


