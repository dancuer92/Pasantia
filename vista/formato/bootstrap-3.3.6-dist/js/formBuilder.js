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
    });

    $('#opciones').on("click", ".remover", function () {

        if ($('#opciones .remover').length > 1) {
            var pos = $(this).prev('input').attr('id').split("-");
            remover(pos[1]);
            $(this).prev('input').remove();
            $(this).remove();
            renameOptions(pos[0]);
        }
        else {
            alert('No se puede tener menos de una opción');
        }
    });

    $('#opciones').on('keyup', 'input', function () {
        var div = $(this);
        var valor = $(this).val();
        var pos = div.attr('id').split('-');
        var opc = $('.isSelected input').eq(pos[1]);
        opc.attr('value', valor);
        opc.next('p').text(valor);
        var opc2 = $('.isSelected option').eq(pos[1]);
        opc2.attr('value', valor);

    });

    $('#opciones').on('keyup', 'input', function () {
        var div = $(this).attr('id').split('-');
        var valor = $(this).val();
        var value=(valor.replace(/ /g, "-"));
        var pos = div[1];
        var opc = $('.isSelected option').eq(pos);
        console.log(pos);
        opc.attr('value',value);
        opc.html(valor);
    });

    if (currentlySelected === '') {
        ocultarConfiguraciones();
    }
    else {
        mostrarConfiguraciones(currentlySelected);
    }




});




//--------------------------------------FUNCIONES--------------------------------




function cambiarTitulo() {
    var titulo = $('#cambiarTitulo').val();
    if ($('#formBuilder div').find('.isSelected')) {
        var div = $('#formBuilder').find('div.isSelected');
        var label = div.children('label');
        var elem = label.next();
        var tipo = elem.attr('type');
        label.html(titulo);
        titulo = titulo.replace(/ /g, "-");
        titulo = titulo.toLowerCase();

        if (tipo === 'text' || tipo === 'number') {
            elem.attr('id', titulo);
        }
        else {
            rename();
        }
        renameOptions(titulo);
        if (elem.is('textarea') || elem.is('select')) {
            elem.attr('id', titulo);
            elem.attr('name', titulo);
        }



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
        var id = 'element-'.i;
        $(this).attr('id', id);
    });
}
;

function limpiarTitulo() {
    $('#cambiarTitulo').val('');
}
;

function mostrarConfiguraciones(div) {
    $('#titulo').show();
    $('#requerido').show();
    $('#eliminar').show();
    var elemento = div;
    var tipo = elemento.children('input').attr('type');
    if (tipo === 'checkbox' || tipo === 'radio') {
        $('#opciones').show();
        //cargar opciones automaticamente.
        cargarOpciones(elemento);
    }
    else if (elemento.children('select')) {
        $('#opciones').show();
        cargarOpcionesSelect(elemento);
    }
    else {
        $('#opciones').hide();
    }
}

function ocultarConfiguraciones() {
    $('#titulo').hide();
    $('#requerido').hide();
    $('#opciones').hide();
    $('#eliminar').hide();
}

function cargarOpciones(div) {
    var msj = '<label>Configuración de opciones</label><br>\n\
                <button class="btn btn-default" onclick="adicionar();">Adicionar Opcion</button><br>';

    //manejar como una clase para evitar redundancia y complejidad computacional

    div.children('input').each(function (i) {
        msj += '<input id="' + $(this).attr('id') + '" type="text" class="form-control" placeholder="' + $(this).attr('value') + '"/>\n\
                <a class="btn btn-default remover" >Eliminar</a>';
    });
    $('#opciones').html(msj);
}

function adicionar() {
    var pos = $('#opciones input').length;

    var div = $('.isSelected input:last').attr('id').split('-');
    var idOpcion = div[0] += "-" + pos;


    $('#opciones').append('<input id="' + idOpcion + '" type="text" class="form-control" placeholder="Untitled" /> <a class="btn btn-default remover" >Eliminar</a>');
    adicionarOpcion(idOpcion);
}

function adicionarOpcion(idOpcion) {
    var div = $('.isSelected');
    var tipo = div.children('input').attr('type');
//    var pos = div.children('input').length;

    $.post("../formato/elemento.php", {opcion: "element-option", id: idOpcion, tipo: tipo},
    function (mensaje) {
        $(div).append(mensaje);
    });

}

function cargarOpcionesSelect(div) {
    var msj = '<label>Configuración de opciones</label><br>\n\
                <button class="btn btn-default" onclick="adicionarOptionSelect();">Adicionar Opcion</button><br>';
    div.find('option').each(function (i) {
        msj += '<input id="opcion-' + i + '" type="text" class="form-control optionSelect" placeholder="' + $(this).attr('value') + '"/>\n\
                <a class="btn btn-default remover" >Eliminar</a>';
    });
    $('#opciones').html(msj);
}

function adicionarOptionSelect() {
    var pos = $('#opciones input').length;
    $('#opciones').append('<input id="opcion-' + pos + '"type="text" class="form-control optionSelect" placeholder="Untitled" /> <a class="btn btn-default remover" >Eliminar</a>');
    var div = $('.isSelected select');
    $.post("../formato/elemento.php", {opcion: "element-option", id: "", tipo: "option"},
    function (mensaje) {
        $(div).append(mensaje);
    });
}



function remover(pos) {
    $('.isSelected input').each(function (i) {
        if (i == pos) {
            $(this).next('p').remove();
            $(this).remove();
            rename();
        }
    });
    $('.isSelected option').each(function (i) {
        if (i == pos) {
            $(this).remove();
        }
    });
}

function rename() {
    var div = $('.isSelected');
    var titulo = div.children('label').text();
    titulo = titulo.replace(/ /g, "-");
    titulo = titulo.toLowerCase();
    div.children('input').each(function (i) {
        var nombreOpcion = titulo + "-" + i;
        $(this).attr('id', nombreOpcion);
        if ($(this).attr('type') === 'checkbox') {
            $(this).attr('name', nombreOpcion);
        }
//        $(this).next('p').text(nombreOpcion);
    });
}

function renameOptions(nombre) {
    $('#opciones input').each(function (i) {
        var opcion = nombre + '-' + i;
        $(this).attr('id', opcion);
//        $(this).attr('placeholder', 'Untitled');
    });
}

function eliminar() {
    var div = $('.isSelected');
    div.remove();
    ocultarConfiguraciones();

}








