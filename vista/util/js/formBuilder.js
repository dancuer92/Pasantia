/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    var currentlySelected = '';

    /**
     * Método para añadir el elemento que se describe en el boton.
     */
    $('.new-element').click(function () {
        $('#myTabs a[href="#propiedades"]').tab('show');
        var opcion = $(this).attr('data-type');

        //Limpiar todos los melementos seleccionados.
        var currentlySelected = clearElementSelected();
        //Se añade el elemento que se encuentra en elemento.php a través del método post de jquery.
        $.post("../formato/elemento.php", {opcion: opcion},
        function (mensaje) {
            //Se añade el elemento al final del formato
            $('#formBuilder').append(mensaje);
            var newElement = $('#formBuilder div:last');
            currentlySelected = newElement;
            //Se le agrega la clase .isSelected para que quede el div seleccionado y poder trabajar sobre las opciones que este permite
            newElement.addClass('isSelected');
            //Se nombre el elemento de acuerdo a la posición en el formulario.
            nombrarElementos();
            //Se muestra las configuraciones que este puede tener.
            mostrarConfiguraciones(currentlySelected);
//            console.log(currentlySelected);
        });
    });


    /**
     * Método que selecciona cualquier div del formato a construir para cambiar su panel de configuraciones.
     */
    $('#formBuilder').on("click", "div", function () {
        //Se quitan los elementos previamentes seleccionados
        clearElementSelected();
        //Se selecciona el nuevo elemento.
        $(this).addClass('isSelected');
        currentlySelected = $(this);
        $('#pestañaPropiedades').click();
        //Se muestran las configuraciones dependiendo del elemento seleccionado.
        mostrarConfiguraciones(currentlySelected);
        //Función para cambiar la posición en el formato
        $('#formBuilder').sortable({revert: true});
    });

    /**
     * Método para eliminar una opción de un checkbox, radio o select del panel de configuración
     */
    $('#opciones').on("click", ".remover", function () {
        //No se pueden eliminar todas las opciones, Se debe dejar mínimo una opción.
        if ($('#opciones .remover').length > 1) {
            //Se busca la posición de la opción a eliminar.
            var pos = $(this).prev('input').attr('id').split("-");
            //Se elimina dependiendo de la posición de la opción pertinente en el formato.
            remover(pos[1]);
            $(this).prev('input').remove();
            $(this).remove();
            //Se renombran las opciones con respecto a la nueva posición.
            renameOptions(pos[0]);
        }
        else {
            alert('No se puede tener menos de una opción');
        }
    });

    //Método para cambiar el valor de las opciones.
    $('#opciones').on('keyup', 'input', function () {
        //Selecciona el input de la lista de opciones
        var div = $(this);
        //Se toma el nuevo valor
        var valor = $(this).val();
        //Se parsea el id del input de opciones.
        var pos = div.attr('id').split('-');
        //Se selecciona la posición de la opción dentro del formato.
        var opc = $('.isSelected input').eq(pos[1]);
        var opc2 = $('.isSelected option').eq(pos[1]);
        //Se modifica su valor
        opc.attr('value', valor);
        opc2.attr('value', valor);
        //Otras configuraciones dentro del div para mostrar su resultado final al usuario
        opc.next('p').text(valor);
        opc2.html(valor);
    });

    //Condicional para mostrar las configuraciones del div seleccionado
    if (currentlySelected === '') {
        ocultarConfiguraciones();
    }
    else {
        mostrarConfiguraciones(currentlySelected);
    }

    //Modificar la opción si es requerido o no 
    $('#obligatorio').change(function () {
        //se selecciona el div que será obligatorio
        var div = $('.isSelected');
        var tipo = div.children('input').attr('type');
        //se verifica si es obligatorio
        if (this.checked) {
            //se verifica sino son radios o checkbox para que no creen conflicto sobre los otros input
            if (tipo !== 'radio' || tipo !== 'checkbox') {
                //se adiciona un identificador visual al formulario, se le adiciona la propiedad al input.
                div.children('label').children('p').remove();
                div.children('input').prop('required', true);
                div.children('label').append('<p class="requerido">*</p>');
            }
        }
        else {
            //sino es obligatorio y tiene la propiedad se elimina y se retira el identificador visual
            div.children('input').removeAttr('required');
            div.children('label').children('p').remove();
        }
    })

});




//--------------------------------------FUNCIONES--------------------------------



/**
 * Método para cambiar el titulo del elemento ya sea cualquier tipo de entrada que se maneje en el formato. 
 * @returns {undefined}
 */
function cambiarTitulo() {
    //Se toma el nuevo titulo del elemento.
    var titulo = $('#cambiarTitulo').val();
    //Encuentro el elemento para cambiarle el titulo.
    if ($('#formBuilder div').find('.isSelected')) {
        //Inicializo el div.
        var div = $('#formBuilder').find('div.isSelected');
        //Se selecciona la etiqueta con el texto que representa la entrada y se reemplaza por el nuevo titulo.
        var label = div.children('label');
        label.html(titulo);
        $('#cambiarTitulo').attr('placeholder', titulo);

        //Se borra si es requerido el campo
        div.children('input').removeAttr('required');


        //Se modifica el titulo para que no contenga espacios, ni acentos, ni ñ, ni sea mayúscula
        titulo = titulo.toLowerCase();
        titulo = titulo.replace(/[áàäâå]/g, 'a');
        titulo = titulo.replace(/[éèëê]/g, 'e');
        titulo = titulo.replace(/[íìïî]/g, 'i');
        titulo = titulo.replace(/[óòöô]/g, 'o');
        titulo = titulo.replace(/[úùüû]/g, 'u');
        titulo = titulo.replace(/[ñ]/g, 'n');
        titulo = titulo.replace(/[ç]/g, 'c');
        titulo = titulo.replace(/[^a-z0-9\s]/g, '');
        titulo = titulo.replace(/ /g, "_");

        //Se selecciona el tipo de entrada del formato.
        var elem = label.next();

        //Se modifica el nombre según el tipo de entrada que posee el formato.
        if (elem.is('input[type="text"]') || elem.is('input[type="number"]') || elem.is('input[type="time"]') || elem.is('input[type="date"]')) {
            elem.attr('id', titulo);
            elem.attr('name', titulo);
        }

        if (elem.is('br')) {
            //Modificación de otros tipos de entrada.
            rename();
            //Se renombran también las opciones del formulario para entradas de texto como listas u opciones.
            renameOptions(titulo);
        }

        //Si es el caso de un texarea o de una lista desplegable
        if (elem.is('textarea') || elem.is('select')) {
            elem.attr('id', titulo);
            elem.attr('name', titulo);
        }

        //Si el elemento es una tabla se le da un nombre de identificación del elemento
        if (elem.is('table')) {
            elem.attr('id', titulo);
            cambiarNombreCeldas(titulo);
        }
    }

}


/**
 * Quitar el elemento seleccionado
 * @returns {undefined}
 */
function clearElementSelected() {
    $('.isSelected').removeClass('isSelected');
    removerCeldasSeleccionadas();
}
;

/**
 * Nombra los elementos del formato de acuerdo a su orden
 * @returns {undefined}
 */
function nombrarElementos() {
    $('#formBuilder div').each(function (i) {
        var id = 'element-' + i;
        $(this).attr('id', id);
    });
}
;

/**
 * Limpiar el campo de entrada para modificar el título
 * @returns {undefined}
 */
function limpiarTitulo() {
    $('#cambiarTitulo').val('');
    $('#nombreUrl').val('');
    $('#direccionEnlace').val('');
    $('#obligatorio').removeAttr('checked');
}

/**
 * Modifica el checkbox para requerir un elemento de entrada.
 * div, es el elemento seleccionado para que sea obligatorio.
 * @param {type Object} div
 * @returns {undefined} el input checked.
 */
function requerir(div) {
    var tipo = div.children('input').attr('type');
    console.log(tipo);
//    Queda requerido solo para los tipo text y number
    if (tipo === 'text' || tipo === 'number') {
        div.children('input').attr('required', true);
    }
}

/**
 * Muestra las configuraciones dependiendo del div seleccionado del formato a construir.
 * div, toma el elemento seleccionado.
 * @param {type Object} div
 * @returns {undefined}
 */
function mostrarConfiguraciones(div) {
//    Muestra las configuraciones por defecto
    $('#titulo').show();
    $('#requerido').hide();
    $('#eliminar').show();
    $('#celdas').hide();
    $('#opciones').hide();

    var elemento = div;

    //cargo el titulo del elemento para modificarlo en el panel de configuraciones
    $('#cambiarTitulo').attr('placeholder', ($(elemento).children('label').text()));

    //Selecciona el tipo de entrada
    var tipo = elemento.children('input').attr('type');

    //carga la opcion si es requerido o no.
    if (elemento.children().is('input')) {
        $('#requerido').show();
        $('#obligatorio').removeAttr('checked');
    }

    if (tipo === 'number') {
        $('#opciones').show();
        cargarOpcionesNumber();
    }

    //carga las opciones de un checkbox o radio
    if (tipo === 'checkbox' || tipo === 'radio') {
        $('#opciones').show();
        $('#requerido').hide();
        cargarOpciones(elemento);
    }

    //carga las opciones para una lista desplegable
    if (elemento.children().is('select')) {
        cargarOpcionesSelect(elemento);
        $('#opciones').show();
        $('#requerido').show();
        $('#requerido').hide();
    }

    //carga las opciones para una tabla
    if (elemento.children().is('table')) {
        var tabla = '#' + elemento.children('table').attr('id');
        //carga las opciones de la celda con doble clic
        $(tabla).on('dblclick', 'td', function () {
            $(this).addClass('hover');
            var x = $(this).children().first();
            cargarOpcionesCelda();
            if (x.is('p')) {
                $('#nombreEtiquetaCelda').attr('placeholder', x.text());
            }
            if (x.is('input[type="number"]')) {
                $('#maxVal').attr('placeholder', x.attr('max'));
                $('#minVal').attr('placeholder', x.attr('min'));
            }
            if (x.is('a')) {
                $('#nombreUrl').attr('placeholder', x.text());
            }
            $('#celdas').show();
        });
        cargarOpcionesTabla();
        $('#requerido').hide();
        $('#opciones').show();
    }

    //Carga las opciones para un enlace 
    if (elemento.children().is('a')) {
//        console.log('enlace creado');
        cargarOpcionesLink();
        $('#requerido').hide();
        $('#titulo').hide();
        $('#opciones').show();
    }
}

/**
 * Oculta las configuraciones sino se tiene un div seleccionado.
 * @returns {undefined}
 */
function ocultarConfiguraciones() {
    $('#titulo').hide();
    $('#requerido').hide();
    $('#opciones').hide();
    $('#celdas').hide();
    $('#eliminar').hide();
}

/**
 * Carga las opciones de loc campos numéricos las cuales son un rango mínimo y un rango máximo.
 * @returns {undefined}
 */
function cargarOpcionesNumber() {
    var msj = '<label>Configuración de rango</label><br>\n\
            <p>Indique aquí el rango de valores del input</p><br>\n\
            <div class="col-sm-6">\n\
                Mínimo valor:<br><input id="minVal" type="number" step="any" class="form-control" placeholder="Valor mínimo" onkeyup="cambiarMin();" style="width:100%"/>\n\
            </div>\n\
            <div class="col-sm-6">\n\
                Máximo valor:<br><input id="maxVal" type="number" step="any" class="form-control" placeholder="Valor máximo" onkeyup="cambiarMax();" style="width:100%"/><br>\n\
            </div>';
    $('#opciones').html(msj);
}

/**
 * Metodo que cambia el valor máximo de un input tipo numérico
 * @returns {undefined}
 */
function cambiarMax() {
    var max = $('#maxVal').val();
    $('.isSelected').children('input').attr('max', max);
}

/**
 * Metodo que cambia el valor mínimo de un input tipo numérico
 * @returns {undefined}
 */
function cambiarMin() {
    var min = $('#minVal').val();
    $('.isSelected').children('input').attr('min', min);
}



/**
 * Carga las opciones del elemento seleccionado si es el caso de un checkbox o radio.
 * el div representa el elemento seleccionado del formato.
 * @param {type} div
 * @returns {undefined}
 */
function cargarOpciones(div) {
    var msj = '<label>Configuración de opciones</label><br>\n\
                <button class="btn btn-default" onclick="adicionar();">Adicionar Opcion</button><br>';

    //Carga las opciones teniendo en cuenta el total de input del div seleccionado.               
    div.children('input').each(function (i) {
        msj += '<input id="' + $(this).attr('id') + '" type="text" class="form-control" placeholder="' + $(this).attr('value') + '"/>\n\
                <a class="btn btn-default remover" >Eliminar</a>';
    });
    //
    msj += '<br><p>Área de texto para colocar las opciones separadas por coma</p>\n\
                <textarea id="opcionesLista2" placeholder="Digite las opciones separadas por coma exceptuando la última" style="width:100%" onblur="cambiarOpcionesSplit(\'input\');"></textarea>';
    //Se anexan al panel de opciones en configuraciones.
    $('#opciones').html(msj);
}

/**
 * Funció que adiciona una opción del checkbox o de radio opción * 
 * @returns {undefined}
 */
function adicionar() {
    //calcula la cantidad de opciones actuales del panel de configuraciones.
    var pos = $('#opciones input').length;
    //Seleciona el nombre del último y se calcula la nueva posición que la nueva opción va a tener.
    var div = $('.isSelected input:last').attr('id').split('-');
    var idOpcion = div[0] + "-" + pos;
    //Se adiciona la nueva opción al panel de configuraciones y se llama la función para agragra la opción al formato.
    $('#opciones').append('<input id="' + idOpcion + '" type="text" class="form-control" placeholder="Untitled" /> <a class="btn btn-default remover" >Eliminar</a>');
    adicionarOpcion(idOpcion, div[0]);
}


/**
 * Método que adiciona una nueva opción al input del formato.
 * idOpcion, toma el nuevo id de la opción a adicionar
 * @param {type} idOpcion
 * @returns {undefined}
 */
function adicionarOpcion(idOpcion, name) {
    //Se identifica el tipo del input para posteriormente llamar la función que retorna el html de la nueva opción.
    var div = $('.isSelected');
    var tipo = div.children('input').attr('type');
    //método que envia el titulo y el tipo de opción que se adiciona al formato.
    $.post("../formato/elemento.php", {opcion: "element-option", id: idOpcion, tipo: tipo, name: name},
    function (mensaje) {
        $(div).append(mensaje);
        $(div).click();
    });

}

/**
 * Carga las opciones de una lista desplegable del formato.
 * div, es el elemento que está seleccionado
 * @param {type} div
 * @returns {undefined}
 */
function cargarOpcionesSelect(div) {
    var msj = '<label>Configuración de opciones</label><br>\n\
                <button class="btn btn-default" onclick="adicionarOptionSelect();">Adicionar Opcion</button><br>';
    //Función que recorre todas las opciones presentes en el div y adiciona al panel de configuraciones.
    div.find('option').each(function (i) {
        msj += '<input id="opcion-' + i + '" type="text" class="form-control optionSelect" placeholder="' + $(this).attr('value') + '"/>\n\
                <a class="btn btn-default remover" >Eliminar</a>';
    });
    msj += '<br><p>Área de texto para colocar las opciones separadas por coma</p>\n\
                <textarea id="opcionesLista2" placeholder="Digite las opciones separadas por coma exceptuando la última" style="width:100%" onblur="cambiarOpcionesSplit(\'lista\');"></textarea>';
    $('#opciones').html(msj);
}

/**
 * Adiciona una nueva opción a la lista desplegable.
 * @returns {undefined}
 */
function adicionarOptionSelect() {
    //Se busca la nueva posición que va a tener el elemento.
    var pos = $('#opciones input').length;
    //Se adiciona el html de la nueva opción al panel de configuraciones
    $('#opciones').append('<input id="opcion-' + pos + '"type="text" class="form-control optionSelect" placeholder="Untitled" /> <a class="btn btn-default remover" >Eliminar</a>');
    //Se selecciona la lista desplegable perteneciente al div del formato
    var div = $('.isSelected select');
//    var id=div.attr('id')+'-'+pos;
    //Se llama la función que permite añadir la nueva opción al input del formato.
    $.post("../formato/elemento.php", {opcion: "element-option", id: '', tipo: "option", name: ""},
    function (mensaje) {
        $(div).append(mensaje);
        $(div).click();
    });
}

/**
 * Cargar las opciones de la tabla como lo son añadir y eliminar filas y columnas
 * @returns {undefined}
 */
function cargarOpcionesTabla() {
    var msj = '<label>Configuración de opciones de tabla</label>\n\
                <br><div class="col-sm-6">\n\
                    <button class="btn btn-default" onclick="agregarFila();"style="width: 100%;">Adicionar fila</button>\n\
                    <button class="btn btn-default" onclick="agregarColumna();"style="width: 100%;">Adicionar columna</button>\n\
                </div>\n\
                <div class="col-sm-6">\n\
                    <button class="btn btn-default" onclick="eliminarFila();"style="width: 100%;">Eliminar Fila</button>\n\
                    <button class="btn btn-default" onclick="eliminarColumna();"style="width: 100%;">Eliminar columna</button>\n\
                </div>\n\
                <br><p>Por favor hacer doble clic en la celda para ver el panel de configuraciones de una celda.</p>';
    $('#opciones').html(msj);
}

/**
 * Cargar las opciones de una celda al hacer doble clic sobre ellas.
 * permite crear una etiqueta (<p>) para identificar la columna o fila o dar un nombre a una celda en la tabla como referencia.
 * cambiar a campo de entrada (<input>) ya sea un tipo texto o numérico cualquier etiqueta dentro de la tabla, si es numérico permite establecer un valor máximo y un valor mínimo.
 * Además, permite crear un enlace de contenido externo (<a>) para redireccionar el formato. La ruta debe contener la dirección completa del servidor.
 * @returns {undefined}
 */
function cargarOpcionesCelda() {
    var msj = '<label>Configuración de opciones de la celda</label><br>\n\
                    <p>Por favor hacer clic en el botón para cambiar el campo a etiqueta de texto</p><br>\n\
                    <div class="col-sm-12">\n\
                        <button class="btn btn-default" onclick="cambiarALabel();" style="width:100%">Cambiar a texto</button>\n\
                        <input id="nombreEtiquetaCelda" type="text" class="form-control" placeholder="Nombre celda" onkeyup="cambiarNombreCelda();" />\n\
                    </div>\n\
                    <p>Por favor hacer clic en el botón para cambiar el campo a una entrada de texto o números</p><br>\n\
                    <div class="col-sm-6">\n\
                        <button class="btn btn-default" onclick="cambiarAInput(\'text\');" style="width:100%">Entrada de texto</button>\n\
                    </div>\n\
                    <div class="col-sm-6">\n\
                        <button class="btn btn-default" onclick="cambiarAInput(\'number\');" style="width:100%">Entrada numérica</button>\n\
                        Máximo valor: <input id="maxVal" type="number" step="any" class="form-control" placeholder="Valor máximo" onkeyup="cambiarValMax();" />\n\
                        Mínimo valor: <input id="minVal" type="number" step="any" class="form-control" placeholder="Valor mínimo" onkeyup="cambiarValMin();" />\n\
                    </div>\n\
                    <p>Por favor hacer clic en el botón para cambiar a un enlace externo</p><br>\n\
                    <div class="col-sm-12">\n\
                        <button class="btn btn-default" onclick="cambiarALink();" style="width:100%">Enlace</button>\n\
                        <input id="nombreUrl" type="text" class="form-control" placeholder="Nombre de la página" onkeyup="cambiarNombreURL();" onblur="limpiarTitulo();"/>\n\
                        <input id="direccionEnlace" type="text" class="form-control" placeholder="Dirección URL" onkeyup="cambiarURL();" onblur="limpiarTitulo();"/>\n\
                    </div>\n\
                    <p>Por favor hacer clic en el boton para cambiar a una lista desplegable</p><br>\n\
                    <div class="col-sm-12">\n\
                        <button class="btn btn-default" onclick="cambiarALista();" style="width:100%">Lista</button>\n\
                        <textarea id="opcionesLista" placeholder="Digite las opciones separadas por coma" style="width:100%" onblur="cambiarOpciones();"></textarea>';
    $('#celdas').html(msj);
}

/**
 * Cambia el contenido de una celda por una etiqueta para representar una fila o una columna o 
 * simplemente para establecer un espacio entre celdas.
 * @returns {undefined}
 */
function cambiarALabel() {
    //Se toma la celda en la que se trabaja
    var celda = $('.hover');
    //se busca el nombre de la tabla
    var titulo = celda.parents('table').attr('id');
    //se vacía el contenido inicial de la celda
    celda.empty();
    //Se agrega el elemento correspondiente a una etiqueta
    celda.append('<p>Nombre celda</p>');
    //Se renombran los input de la tabla.
    cambiarNombreCeldas(titulo);
    cambiarNombreSelect('#' + titulo + ' select', titulo);

}

/**
 * Se cambia el contenido de la celda por una entrada de texto de tipo numérica o textual
 * El parámetro recibido es el tipo del input.
 * @param {type} tipo
 * @returns {undefined}
 */
function cambiarAInput(tipo) {
    //Se toma la celda en la que se trabaja
    var celda = $('.hover');
    //se vacía el contenido inicial de la celda
    celda.empty();
    //se busca el nombre de la tabla
    var titulo = celda.parents('table').attr('id');
    //Se agrega el elemento correspondiente a un input
    var input = '<input id="' + titulo + '_n" name="' + titulo + '_n" type="' + tipo + '" length="30" pattern="[0-9a-zA-ZñÑáÁéÉíÍóÓúÚüÜ.,/ \s]{1,30}" title="Digite solo carácteres alfanuméricos" disabled></td>';
    celda.append(input);
    if (tipo === 'number') {
        $(celda).children("input").removeAttr("length");
        $(celda).children("input").removeAttr("pattern");
        $(celda).children("input").removeAttr("title");
        
        
//    if (tipo === 'text') {
//        $(celda).children("input").attr("length", "30");
//        $(celda).children("input").attr("pattern", "[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]{1,30}");
//        $(celda).children("input").attr("title", "Digite sólo letras");
    }
    //Se renombran los input de la tabla.
    cambiarNombreCeldas(titulo);
    cambiarNombreSelect('#' + titulo + ' select', titulo);
}

/**
 * Metodo que cambia el valor máximo de un input tipo numérico en una tabla
 * @returns {undefined}
 */
function cambiarValMax() {
    var max = $('#maxVal').val();
    $('.hover').children('input[type=number]').attr('step', 'any');
    $('.hover').children('input[type=number]').attr('max', max);
}

/**
 * Metodo que cambia el valor mínimo de un input tipo numérico en una tabla
 * @returns {undefined}
 */
function cambiarValMin() {
    var min = $('#minVal').val();
    $('.hover').children('input[type=number]').attr('step', 'any');
    $('.hover').children('input[type=number]').attr('min', min);
}

/**
 * Se cambia el contenido de la celda por un enlace externo en el que el usuario le da el nombre de la dirección y la dirección misma
 * @returns {undefined}
 */
function cambiarALink() {
    //Se toma la celda en la que se trabaja
    var celda = $('.hover');
    //se busca el nombre de la tabla
    var titulo = celda.parents('table').attr('id');
    //se vacía el contenido inicial de la celda
    celda.empty();
    //Se agrega el elemento correspondiente a un enlace
    celda.append('<a href="">¡Hacer clic aquí!</a>');
    //Se renombran los input de la tabla.
    cambiarNombreCeldas(titulo);
    cambiarNombreSelect('#' + titulo + ' select', titulo);
}

/**
 * Se cambia el contenido de la celda por una lista desplegable en el que el usuario digita las opciones separadas por una coma.
 * @returns {undefined}
 */
function cambiarALista() {
    //Se toma la celda en la que se trabaja
    var celda = $('.hover');
    //se busca el nombre de la tabla
    var titulo = celda.parents('table').attr('id');
    //se busca la cantidad de select
    var cant = '#' + titulo + ' select';
    var x = $(cant).length;
    //se vacía el contenido inicial de la celda
    celda.empty();
    //Se agrega el elemento correspondiente a un enlace
    var lista = '<select name="select_' + titulo + '_' + x + '" id="select_' + titulo + '_' + x + '"></select>';
    celda.append(lista);
    //Se renombran los input y select de la tabla.    
    cambiarNombreCeldas(titulo);
    cambiarNombreSelect(cant, titulo);
}

/**
 * Método que cambia automáticamente el nombre de un select en una tabla
 * recibe la tabla con los select y el nombre de la tabla
 * @param {type} tabla
 * @param {type} titulo
 * @returns {undefined}
 */
function cambiarNombreSelect(tabla, titulo) {
    //Se recorren los select
    $(tabla).each(function (i) {
        //Se cambia el noombre y se actualiza
        var nombre = 'select_' + titulo + '_' + i;
        $(this).attr('id', nombre);
        $(this).attr('name', nombre);
    })
}

/**
 * Método que permite cambiar el nombre de los input de la tabla
 * el título corresponde al nombre de la tabla
 * @param {type} titulo
 * @returns {undefined}
 */
function cambiarNombreCeldas(titulo) {
    //Se toma el nombre de la tabla
    var tabla = '#' + titulo + ' input';
    //Se recorren todos los input de la tabla
    $(tabla).each(function (i) {
        //Se toma el input actual
        var input = $(this);
        //Se actualiza el nombre del input con el nombre de la tabla mas el identificador de la celda
        var nombre = titulo + "_" + i;
        $(input).attr('id', nombre);
        $(input).attr('name', nombre);
    });
}

/**
 * Metodo que carga las opciones para modificar un enlace.
 * Contiene dos input que son para modificar el nombre del enlace y la dirección de la página web respectivamente.
 * @returns {undefined}
 */
function cargarOpcionesLink() {
    var msj = '<label>URL</label><br>\n\
            <input id="nombreUrl" type="text" class="form-control" placeholder="Nombre de la página" onkeyup="cambiarNombreURL();" onblur="limpiarTitulo();"/>\n\
            <input id="direccionEnlace" type="text" class="form-control" placeholder="Dirección URL" onkeyup="cambiarURL();" onblur="limpiarTitulo();"/>';
    $('#opciones').html(msj);
}

/**
 * Cambia el nombre de la etiqueta de la celda en la tabla
 * @returns {undefined}
 */
function cambiarNombreCelda() {
    //Se toma el nombre de la celda ingresada por el usuario    
    var valor = $('#nombreEtiquetaCelda').val();
    //se actualiza el nombre de la etiqueta en la tabla
    $('.hover').children('p').text(valor);
}

/**
 * Cambia la dirección de la página web, indique aquí la ruta absoluta.
 * @returns {undefined}
 */
function cambiarURL() {
    //Se toma la direccion del enlance que ingresa el usuario
    var url = $('#direccionEnlace').val();
    //Se actualiza el atributo de refeencia del elemento <a> con la direccion ingresada
    //caso para un enlace dentro de un div
    $('.isSelected').children('a').attr('href', url);
    //caso para un enlace dentro de una celda.
    $('.hover').children('a').attr('href', url);
}

/**
 * Cambia el título de la dirección web
 * @returns {undefined}
 */
function cambiarNombreURL() {
    //se toma el nombre de la url ingresada por el usuario
    var alt = $('#nombreUrl').val();
    //se busca el elemento si el caso es dentro de un div seleccionado.
    $('.isSelected').children('a').text(alt);
    //se busca el elemento si el caso es dentro de una celda seleccionada.
    $('.hover').children('a').text(alt);
}

/**
 * Método para agregar o quitar las opciones de la lista en la tabla
 * @returns {undefined}
 */
function cambiarOpciones() {
    var cadena = $('#opcionesLista').val();
    var opciones = cadena.split(",");
    var opc;
    for (opc in opciones) {
        var opcion = '<option value="' + opciones[opc] + '">' + opciones[opc] + '</option>';
        $('.hover').children('select').append(opcion);
    }
}

/**
 * Método para agregar o quitar las opciones de la lista en el formulario
 * @returns {undefined}
 */
function cambiarOpcionesSplit(tipo) {
    var cadena = $('#opcionesLista2').val();
    cadena= cadena.replace(/,/g, "|");
    cadena= cadena.replace(/,,/g, "|");
    cadena= cadena.replace(/, ,/g, "|");
    cadena= cadena.replace(/,$/, "");
    console.log(cadena);
    var opciones = cadena.split("|");
    var opc;
    if (tipo === 'lista') {
        var opcion;
        for (opc in opciones) {
            opcion += '<option value="' + opciones[opc] + '">' + opciones[opc] + '</option>';
        }
        $('.isSelected').children('select').html(opcion);
        $('.isSelected').click();
    }
    var div = $('.isSelected').children('input');
    tipo = div.attr('type');
    var name = div.attr('name');
    if (tipo === 'radio') {
        var opcion='';
        var i = div.length;
        for (opc in opciones) {
            opcion += '<input type="radio" id="' + name + '-' + i + '"  name="' + name + '" value="'+opciones[opc]+'" disabled/><p>'+opciones[opc]+'</p>';
            i++;
        }
        $('.isSelected').append(opcion);
        $('.isSelected').click();
    }
    else if (tipo === 'checkbox') {
        var opcion='';
        var i = div.length;
        var id=name.split('-');
        for (opc in opciones) {
            opcion += '<input id="' + id[0] + '-' + i + '" type="checkbox" name="' + id[0] + '-' + i + '" value="'+opciones[opc]+'" disabled/><p>'+opciones[opc]+'</p>';
            i++;
        }
        $('.isSelected').append(opcion);
        $('.isSelected').click();
    }

}

/**
 * Método para cambiar el estado de una celda, si es seleccinado o no
 * @returns {undefined}
 */
function removerCeldasSeleccionadas() {
    //remueve la clase hover de todos los elementos que la contienen.
    $('.hover').removeClass('hover');
}

/**
 * Función que permite eliminar una opción del formato.
 * pos, es la posición del elemento a eliminar.
 * @param {type} pos
 * @returns {undefined}
 */
function remover(pos) {
    //Se busca la opción según sea el tipo de input o select.
    $('.isSelected input').each(function (i) {
        //Condición que permite eliminar dependiendo de la posición que se recibe.
        if (i == pos) {
            //Eliminación de la opción
            $(this).next('p').remove();
            $(this).remove();
            //Se renombran las opciones teniendo en cuenta las nuevas posiciones.
            rename();
        }
    });
    $('.isSelected option').each(function (i) {
        //Condición que permite eliminar dependiendo de la posición que se recibe.
        if (i == pos) {
            //Eliminación de la opción
            $(this).remove();
        }
    });
}

/**
 * Función para renombrar las opciones con su nueva posición.
 * @returns {undefined}
 */
function rename() {
    //Se selecciona el div en el que se trabaja
    var div = $('.isSelected');
    //El titulo se toma de la etiqueta previa (label) para renombrar las opciones,además se reemplazan los espacios y las mayúsculas
    var titulo = div.children('label').text();
    //Se modifica el titulo para que no contenga espacios, ni acentos, ni ñ, ni sea mayúscula
    titulo = titulo.toLowerCase();
    titulo = titulo.replace(/[áàäâå]/g, 'a');
    titulo = titulo.replace(/[éèëê]/g, 'e');
    titulo = titulo.replace(/[íìïî]/g, 'i');
    titulo = titulo.replace(/[óòöô]/g, 'o');
    titulo = titulo.replace(/[úùüû]/g, 'u');
    titulo = titulo.replace(/[ñ]/g, 'n');
    titulo = titulo.replace(/[ç]/g, 'c');
    titulo = titulo.replace(/[^a-z0-9\s]/g, '');
    titulo = titulo.replace(/ /g, "_");
    //Se recorren todas las opciones y se cambian los atributos id y name con el nuevo nombre y posición
    div.children('input').each(function (i) {
        var nombreOpcion = titulo + "-" + i;
        $(this).attr('id', nombreOpcion);
        $(this).attr('name', titulo);

        if ($(this).attr('type') === 'checkbox') {
            $(this).attr('name', nombreOpcion);
        }
//        $(this).next('p').text(nombreOpcion);
    });
}

/**
 * Se renombran las opciones del panel de configuraciones.
 * nombre, es el id de la opción.
 * @param {type} nombre
 * @returns {undefined}
 */
function renameOptions(nombre) {
    $('#opciones input').each(function (i) {
        var opcion = nombre + '-' + i;
        $(this).attr('id', opcion);
//        $(this).attr('placeholder', 'Untitled');
    });
}

/**
 * Se elimina un div del formato.
 * @returns {undefined}
 */
function eliminar() {
    //Se selecciona el div a eliminar.
    var div = $('.isSelected');
    //Se elimina y se oculta el panel de configuraciones que tenía
    div.remove();
    ocultarConfiguraciones();

}

/**
 * Permite adicionar una nueva fila a la tabla seleccionada.
 * @returns {undefined}
 */
function agregarFila() {
    //se toma el nombre de la tabla
    var nomTabla = $('.isSelected table').attr('id');
    //Se buscan las columnas de la última fila
    var columnasTabla = $('.isSelected table tr:last td');
    //Se toma el número de filas y columnas que tiene la última fila
    var totalCol = $(columnasTabla).length;
    var f = ($('.isSelected table tr').length);
    //Se crea la nueva fila
    var fila = "<tr>";
    var col = "";
    //Se recorre el número de columnas
    for (var y = 0; y < totalCol; y++) {
        //Se adiciona una nueva celda por cada columna que se recorre
        col += '<td><input id="' + nomTabla + '_' + (f - 1) + '_' + y + '" name="' + nomTabla + '_' + (f - 1) + '_' + y + '" type="text" length="30" pattern="[0-9a-zA-ZñÑáÁéÉíÍóÓúÚüÜ.,/ \s]{1,30}" title="Digite sólo carácteres alfanuméricos" disabled></td>';
    }
    //Se añade la nueva fila creada al final de la tabla.
    var row = fila + col + "</tr>";
    $('.isSelected table').append(row);
    cambiarNombreCeldas(nomTabla);
    cambiarNombreSelect('#' + nomTabla + ' select', nomTabla);
}

/**
 * Permite adicionar una nueva columna a la tabla
 * @returns {undefined}
 */
function agregarColumna() {
    //se toma el nombre de la tabla
    var nomTabla = $('.isSelected table').attr('id');
    //Se seleccionan todas las filas de la tabla y se recorren.
    var filasTabla = $('.isSelected table tr');
    var c = ($('.isSelected table tr:last td').length);
    $(filasTabla).each(function (i) {
        //Se adiciona una celda que pertenezca al encabezado de la tabla.
        if (i == 0) {
            $(this).append("<td><p>Nueva columna</p></td>");
        }
        //Se adiciona una celda que pertenezca al cuerpo de la tabla.
        else {
            $(this).append('<td><input id="' + nomTabla + '_' + (i - 1) + '_' + c +  '" name="' + nomTabla + '_' + (i - 1) + '_' + c + ' "type="text" length="30" pattern="[0-9a-zA-ZñÑáÁéÉíÍóÓúÚüÜ.,/ \s]{1,30}" title="Digite sólo carácteres alfanuméricos" disabled></td>');
        }
    });
    cambiarNombreCeldas(nomTabla);
    cambiarNombreSelect('#' + nomTabla + ' select', nomTabla);
}

/**
 * Método para eliminar la ultima fila de la tabla.
 */
function eliminarFila() {
    //Seleccionar la ultima fila y que no se pueda eliminar menos de uno.
    if ($('.isSelected table tr').length > 2) {
        $('.isSelected table tr:last').remove();
    }
    else {
        alert('No se pueden eliminar mas filas');
    }
    var nomTabla = $('.isSelected table').attr('id');
    cambiarNombreCeldas(nomTabla);
    cambiarNombreSelect('#' + nomTabla + ' select', nomTabla);
}

/**
 * Método para eliminar una columna.
 */
function eliminarColumna() {
    //Se calcula el número de columnas de la última fila
    var cant = $('.isSelected table tr:last td').length;
    if (cant > 1) {
        //Se recorren todas las filas.
        $('.isSelected table tr').each(function (i) {
            //El encabezado de la columna también se elimina.
            $(this).children('td:last').remove();
//            if (i == 0) {
//                $(this).children('td:last').remove();
//            }
//            else {
//                $(this).children('td:last').remove();
//            }
        });
    }
    else {
        alert('No se pueden eliminar mas columnas');
    }
    var nomTabla = $('.isSelected table').attr('id');
    cambiarNombreCeldas(nomTabla);
    cambiarNombreSelect('#' + nomTabla + ' select', nomTabla);
}

