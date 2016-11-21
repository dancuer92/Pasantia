/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#formTraz').submit(function (event) {
    //Se establece un rango de fechas    
    var fechaIni = $('#fechaInicio').val();
    var fechaFin = $('#fechaFin').val();
    //Condicional para validar que las fechas sean validas
    if (fechaFin < fechaIni) {
        //Se corta el evento del submit
        event.preventDefault();
        $('#fechaFin').focus();
        toastr["error"]('Fecha de finalización mayor que la fecha de inicio');
    }
});

var datos = new Array();

/**
 * Se crea una matriz con la información traída desde la base de datos en el que las filas representan cada registro
 * y en el que las columnas representan la fecha de registro y la información que contiene el registro.
 * @returns {undefined}
 */
function mostrarForm() {
    //Se establece un rango de fechas    
    var fechaIni = $('#fechaInicio').val();
    var fechaFin = $('#fechaFin').val();
    //Se toma una clave, pertenece a un campo del formato
    var clave = $(this).attr('name');
    //Formato seleccionado
    var formato = sessionStorage.getItem('formato');
    //Condicional para validar que las fechas sean validas
    if (fechaFin < fechaIni) {
        toastr["error"]('Fecha de finalización mayor que la fecha de inicio');
    }
    else {

        //Declaración del arreglo y visualización de los campos de informacion del formato
        var d = new Array();
        $('#visualizarFormato').show();
        //Acceso a los datos del servidor
        $.post("../../controlador/Formato_controller.php", {formato: formato, clave: clave, inicio: fechaIni, fin: fechaFin, opcion: "trazabilidadFormato"},
        function (mensaje) {
            $('#resultado').html('');

            //Guardar en la matriz el resultado de la bd que consiste en una cadena parseada por || para separar registros
            var matriz = mensaje.split("||");
            var index;
            //Se recorre la matriz para guardar un vector con dos campos para guardar la fecha y la información del registro respectivamente
            for (index in matriz) {
                //Función split del registro para separarlo de la fecha
                var arr = matriz[index].split("~");
                //Inicialización de la cadena de información del registro
                var i = arr[1];
                //Se separa la información por campos de información que pertenecen al formato.
                var info = i.split("&");
                var index2;
                //Inicialización del array asociativo en el que se va a guardar la información
                var arregloInfo = new Array();
                //Recorrer todas las claves del registro
                for (index2 in info) {
                    //Separar los campos de información del formato para rescatar el nombre del campo y el valor del mismo
                    var dato = info[index2].split("=");
                    var clave = dato[0];
                    var valor = dato[1];
                    //Asignar la propiedad y el valor de la propiedad del array asociativo que en definitiva tendrá todas las claves como propiedades del array
                    arregloInfo[clave] = valor;
                }

                //Se agrega el arreglo en el que se representa la fecha en su primera casilla y el arreglo asociativo en su segunda respectivamente
//                                        console.log(arregloInfo);
                d[i] = new Array(arr[0], arregloInfo);
            }
        });
        //Se asigna la matriz temporal a la matriz global
        datos = d;
    }

}
;

/**
 * 
 * @param {type} param1
 * @param {type} param2
 * @param {type} param3
 */
$('#visualizarFormato').on('click', 'input[type="button"],select', function () {
    $('#visualizarFormato').hide();
    $('#verFormato').show();
    $('#btnExportTablaGeneral').show();
    $('#resultado').show();
    $('#chart-container').show();
//                            console.log(datos);
    $('#resultado').html('');
    $('#res1').html('');
    var arregloInfo = new Array();
    var input = $(this);
    var label = input.parent('div').children('label').text();
    var id = validarNombreTitulo(label);
    var clave = input.attr('name');
    //Titulo que se muestra para saber que analisis se usa, y demás creaciones primitivas de la interfaz
    var titulo = '<h3>Se ha seleccionado ' + label + ' para su análisis</h3><br>\n\
                                        <h4>Registros dentro del rango de fechas</h4><br>';
    $('#resultado').append(titulo);

    var tabla = '<table id="' + id + '" class="table-bordered table-hover"><thead><tr><th>Fecha del registro</th><th>Valor del registro</th></tr></thead><tbody></tbody></table>';
    $('#resultado').append(tabla);
    $('#res1').append('<table><thead><tr><th>Fecha del registro</th><th>Valor del registro</th></tr></thead><tbody></tbody></table>');
//Recorrido de los datos (registros del formato)
    for (var index in datos) {
        arregloInfo[index] = new Array(datos[index][0], datos[index][1][clave]);
        //creacion de las filas
        var fila = '<tr><td>' + datos[index][0] + '</td><td>' + datos[index][1][clave] + '</td></tr>';
        //creacion de los campos clave para la fila
        fila += cuerpoCamposClave(index) + '</tr>';
        $('#' + id + ' tbody').append(fila);
        $('#res1 table tbody').append(fila);
    }
    var mensaje = '<br>*Si existe un registro que coincida con la misma fecha sin tener en cuenta la hora y el mismo valor,\n\
                                        solo se mostrará un solo cuadro en la gráfica de línea del tiempo.';
    $('#resultado').append(mensaje);
    acomodarTabla('resultado table');
    timeLine(label, arregloInfo);
    $('#res1 table').tablesorter({sortList: [[0, 1]]});
});

/**
 * Método que devuelve columnas que representan los campos clave del formato
 * @param {type} tipo tipo de columna que se va a pintar td o th
 * @returns {unresolved}
 */
function encabezadoCamposClave(tipo) {
    var camposClave = sessionStorage.getItem('camposClave');
    var cc = camposClave.split('-');
    var campo = '';
    var enc;
    for (campo in cc) {
        if (cc[campo] !== '') {
            enc += '<' + tipo + '>' + cc[campo] + '</' + tipo + '>';
        }
    }
    return enc;
}

/**
 * Método que llena las filas con sus campos clave del registro
 * @param {type} index
 * @returns {unresolved}
 */
function cuerpoCamposClave(index) {
    var camposClave = sessionStorage.getItem('camposClave');
    var cc = camposClave.split('-');
    var campo = '';
    var col;
    for (campo in cc) {
        var clave = cc[campo];
        if (clave !== '') {
            col += '<td>' + datos[index][1][clave] + '</td>';
        }
    }
    return col;
}

function mostrarFormato() {
    $('#visualizarFormato').show();
    $('#btnExportTablaGeneral').hide();
    $('#resultado').hide();
    $('#res1').hide();
    $('#res2').hide();
    $('#chart-container').hide();
    $('#verFormato').hide();
}

/**
 * Método que al hacer clic sobre una tabla del formato muestra los datos del registro
 */
$('#visualizarFormato').on('click', 'table td', function () {
    $('#res2').html('');
    //columna actual a graficar especificamente
    var columna = $(this);
    //Tabla a la que pertenece la columna
    var tabla = columna.parents('table');
    var tabla_name = tabla.attr('id');
    var col0 = $('#' + tabla_name + ' tr td:eq(0)').text();
    var col1 = columna.text();
    //se validan el nombre de la columna
    var texto = validarNombreTitulo(col1);
    //posicion de la columna cliqueada
    var index = columna.index();


// se recorre todas las filas de la tabla del formato
    $('#' + tabla.attr('id') + ' tr').each(function (i) {
        if (i === 0) {
//            var msj = '<table id="pintar_' + tabla_name + '" class="table-bordered table-hover"><thead><tr><td>' + col0 + '</td><td>' + col1 + '</td><td>Fecha del registro</td></tr></thead><tbody></tbody></table>';
            var msj = '<table id="pintar_' + tabla_name + '" class="table-bordered table-hover"><thead><tr><td>' + col0 + '</td><td>' + col1 + '</td></tr></thead><tbody></tbody></table>';
            $('#res2').append(msj);
            //se buscan los campos clave
            var camposClave = encabezadoCamposClave('td');
            $('#res2 thead tr').append(camposClave);
        }
        var fila = $(this);
        //se recorren los registros.
        for (var d in datos) {
            var flag = false;
            var row = '<tr>';
//            var row = '<tr><td>' + (datos[d][0]) + '</td>';
//se recorre cada columna de la tabla del formato
            $(fila).children('td').each(function () {
                var td = $(this);
                //se toma la posicion de la columna recorrida
                var index2 = td.index();
                var col = td.text();
                console.log(col);
                //si la columna tiene texto se agrega normal
                if (col !== '') {
                    row += '<td>' + col + '</td>';
                }
                else {
                    //si la columna cliqueada es igual a cero o igual a la posicion de la columna actual
                    if (index2 === index || index2 === 0) {
                        var input = td.children('input').attr('name');
                        //Se busca en el reigstro de la siguiente forma: 
                        //donde d= es la posicion actual del registro.
                        //1 corresponde a la casilla de la información, arreglo asociativo
                        //input corresponde a la propiedad del arreglo asociativo que es la clave.
                        var valor = (datos[d][1][input]);
                        //si el valor es vacio no se guarda
                        if (valor !== undefined) {
                            flag = true;
                        }
                        else {
                            valor = '';
                        }
                        if (index2 === 0) {
                            valor += '<br>' + (datos[d][0]);
                        }
                        //se crea la columna 
                        row += '<td>' + valor + '</td > ';

                        var x = td.children().first();
                        //si la primera columna tiene valores de entrada o seleccionables se toma el valor siempre y cuando no sea vacio
                        if (x.is('input')) {
                            var input = x.attr('name');
                            if (input.includes(texto)) {
                                var valor = (datos[d][1][input]);
                                if (valor !== undefined) {
                                    flag = true;
                                }
                                else {
                                    valor = '';
                                }
                                row += '<td>' + valor + '</td > ';
                            }
                        }
                        if (x.is('select')) {
                            var input = x.val();
                            row += '<td>' + valor + '</td > ';
                        }
                    }

                }
            });
            //se buscan los demas valores de los campos clave a traves del indice d que es la posicion de ese registro en los datos
            row += '</tr>';
            //si tiene al menos una columna no vacia se almacena la fila
            if (flag) {
                $('#pintar_' + tabla_name + ' tbody').append(row);
            }
        }

    });
    tablaCompleta(tabla_name);
    pintarGrafica();
    acomodarTabla('pintar_' + tabla_name);
    $('#res2 table').tablesorter({sortList: [[0, 1]]});

});



/**
 *Método funcional para imprimir toda la tabla según un rango de fechas.
 *Presenta una tabla con la libreria datatable y sin grafica.
 */
//$('#visualizarFormato').on('click', 'table', function () {
function tablaCompleta(tabla_name) {
    console.log(tabla_name);
    $('#visualizarFormato').hide();
    $('#verFormato').show();
    $('#btnExportTablaGeneral').show();
    $('#resultado').show();
    $('#chart-container').show();
    $('#resultado').html('');
    $('#res1').html('');
    $('#chart-container').html('');
    var tabla = '#' + tabla_name + ' tr';
    var msj = "";
    var nombreTabla = '';

    //se recorre la tabla para crear la tabla general perteneciente a ese registro
    $(tabla).each(function (i) {
        var fila = $(this);
        //si la tabla no tiene input es porque es un encabezado de la tabla
        if (!fila.has('input').length) {
            //se crea la tabla y el encabezado
            nombreTabla = 'fila' + i;
            msj = '<table id="' + nombreTabla + '" class="table-bordered table-hover">\n\
                    <thead></thead><tbody></tbody></table>';
            $('#resultado').append(msj);
            $('#res1').append('<table><thead></thead><tbody></tbody></table>');
//            var encabezado = '<tr><td>Fecha sistema</td>';
            var encabezado = '<tr><th>Fecha del registro</th>';
            //se recorre cada columna para que sea una columna de encabezado 
            $(fila).children('td').each(function () {
                var td = $(this);
                var col = td.text();
                if (col !== '') {
                    encabezado += '<th>' + col + '</th>';
                }
            });
            //se agregan los encabezados a la tabla junto con los campos clave
            encabezado += '</tr>';
            $('#fila' + i + ' thead').append(encabezado);
            $('#res1 table thead').append(encabezado);

//            console.log(encabezado);

        }
        else {
//            console.log('fila: ' + i);
//            console.log(datos);
//se recorren los registros            
            for (var d in datos) {
//                console.log(d);
                //se toma la fecha del sistema del registro
                var flag = false;
                var row = '<tr><td>' + (datos[d][0]) + '</td>';
//                var row = '<tr>';
//                console.log(datos[d][1]);
                //Se recorre las demas columnas
                $(fila).children('td').each(function () {
                    //se toma la columna y si es vacio se pone igual
                     td = $(this);
                    var col = td.text();
//                    console.log(td.html());
                    if (col !== '') {
                        row += '<td>' + col + '</td>';
                    }
                    else {
                        //Se pone el valor de la entrada.
                        var input = td.children('input').attr('name');
//                        console.log(input);
                        var valor = (datos[d][1][input]);
//                        console.log(valor);
                        if (valor !== undefined) {
                            flag = true;
//                            console.log(flag);
                        }
                        else {
                            valor = '';
                        }
                        //se buscan los valores de los campos clave
                row += '<td>' + valor + '</td > ';
                    }
                });
                row += '</tr>';
                if (flag) {
                    $('#' + nombreTabla + ' tbody').append(row);
                    $('#res1 table tbody').append(row);
                }
            }
        }
    });


    //pintarGrafica();    
    acomodarTabla(nombreTabla);
    $('#res1 table').tablesorter({sortList: [[0, 1]]});
}
;
//});

/**
 * método que muestra la trazabilidad de todos los registros de los datos básicos. primero se crea el encabezado
 * @returns {undefined}
 */
function trazabilidadCompleta() {
    //validaciones.
    $('#ver').hide();
    $('btnExportTablaGeneral').show();
    $('input[type="checkbox"]').attr('checked', true);
    $('input[type="radio"]').attr('checked', true);
    $('#visualizarFormato table').remove();
    //se buscan todos los campos
    var cad = $('#visualizarFormato').serialize();
    console.log(cad);
    var campos = cad.split('&');
    var i = '';
    $('#divRes').append('<table><tbody></tbody></table');
    var encabezadoResultado = '<tr><th>Fecha de sistema</th>';
    //se crean las columnas segun los campos
    for (i in campos) {
        var campo = campos[i].split('=');
        var clave = campo[0];
        encabezadoResultado += '<th>' + clave + '</th>';
    }
    encabezadoResultado += '</tr>';
    $('#tableRes thead').append(encabezadoResultado);    
    $('#divRes table tbody').append(encabezadoResultado);    
    llenarCuerpoTablaTrazabilidadCompleta();
    acomodarTabla('tableRes');
    $('#divRes table').tablesorter({sortList: [[0, 1]]});
}

/**
 * se llena el cuerpo de la tabla
 * @returns {undefined}
 */
function llenarCuerpoTablaTrazabilidadCompleta() {
    //se recorre los datos primero
    for (var i in datos) {
        var fila = '<tr><td>' + datos[i][0] + '</td>';
        //se recorren las columnas para obtener los datos.
        $('#tableRes thead tr th').each(function (j) {
            if (j !== 0) {
                //se busca el valor segun la columna
                var clave = $(this).text();
                var valor = datos[i][1][clave];
                console.log(valor);
                //si no tiene valor no se pone
                if (valor===undefined) {
                    valor = '';
                }
                var col = '<td>' + valor + '</td>';
                fila += col;
            }
        });
        fila += '</tr>';
        //Se completan las tablas
        $('#tableRes tbody').append(fila);
        $('#divRes table tbody').append(fila);
    }

}



/**
 * Método que reemplaza el nombre del titulo de una tabla
 * @param {type} titulo
 * @returns {unresolved}
 */
function validarNombreTitulo(titulo) {
    titulo = titulo.toLowerCase();
    titulo = titulo.replace(/[áàäâå]/g, 'a');
    titulo = titulo.replace(/[éèëê]/g, 'e');
    titulo = titulo.replace(/[íìïî]/g, 'i');
    titulo = titulo.replace(/[óòöô]/g, 'o');
    titulo = titulo.replace(/[úùüû]/g, 'u');
    titulo = titulo.replace(/[ñ]/g, 'n');
    titulo = titulo.replace(/[ç]/g, 'c');
    titulo = titulo.replace(/[%]/g, 'porcent');
    titulo = titulo.replace(/[#]/g, 'no');
    titulo = titulo.replace(/[°]/g, 'temp');
    titulo = titulo.replace(/[']/g, '');
    titulo = titulo.replace(/[(]/g, '');
    titulo = titulo.replace(/[)]/g, '');
    titulo = titulo.replace(/[^a-z0-9\s]/g, '');
    titulo = titulo.replace(/ /g, "_");
    return titulo;
}

/**
 * Método que pinta la gráfica específica de datos
 * @returns {undefined}
 */
function pintarGrafica() {
    $('#res2 table').each(function (i) {
        var id = "tabla_" + i;
        $('#chart-container').append('<div id="tabla_' + i + '"></div>');
        $(this).convertToFusionCharts({
//            type: "mscolumn2d",
//            type: "scrollstackedcolumn2d",
//            type: "scrollColumn2d",
            type: "scrollstackedcolumn2d",
            width: "100%",
            height: "350",
            dataFormat: "htmltable",
            renderAt: id
        }, {
            "chartAttributes": {
                caption: id,
                xAxisName: "Clave",
                yAxisName: "Valor",
                bgColor: "FFFFFF",
                theme: "fint"
            }
        });
    });
}

/**
 * Método que acomoda una tabla para paginar
 * @param {type} tabla
 * @returns {undefined}
 */
function acomodarTabla(tabla) {
    $('#' + tabla).DataTable({
        responsive: true,
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
}

/**
 * método que pinta una grafica de gantt
 * @param {type} titulo
 * @param {type} info
 * @returns {undefined}
 */
function timeLine(titulo, info) {
    var fechaIni = $('#fechaInicio').val();
    var fechaFin = $('#fechaFin').val();
    var categoria = '[';
    var tarea = '[';
    var procesos = new Array();
    for (var index in info) {
        var f = new Date(info[index][0]);
        var dd = (f.getDate() < 10 ? '0' : '') + f.getDate();
        var mm = ((f.getMonth() + 1) < 10 ? '0' : '') + (f.getMonth() + 1);
        var fecha1 = f.getFullYear() + '-' + mm + '-' + dd + ' 00:00:00';
        var fecha2 = f.getFullYear() + '-' + mm + '-' + dd + ' 23:59:59';
        categoria += '{"start":"' + fecha1 + '", "end":"' + fecha2 + '", "label":"' + f.getFullYear() + '-' + mm + '-' + dd + '"},'; //        tarea += '{"processid":"' + info[index][1] + '","start":"' + fecha1 + '","end":"' + fecha2 + '", "id":"' + index + '", "height":"15"},';
        tarea += '{"processid":"' + info[index][1] + '","start":"' + fecha1 + '","end":"' + fecha2 + '","label":"' + (f.getHours() + ':' + f.getMinutes()) + '", "id":"' + index + '", "height":"15"},';
        var flag = false;
        for (var p in procesos) {
            if (procesos[p] === info[index][1]) {
                flag = true;
                break;
            }
        }
        if (!flag) {
            procesos.push(info[index][1]);
        }


    }
    tarea += ']';
    tarea = tarea.replace(',]', ']');
    var tareas = JSON.parse(tarea);
//                            console.log(tarea);

    categoria += ']';
    categoria = categoria.replace(',]', ']');
    var categorias = JSON.parse(categoria);
//                            console.log(categoria);

    var process = '[';
    for (var p in procesos) {
        process += '{"label": "' + procesos[p] + '","id": "' + procesos[p] + '"},';
    }
    process += ']';
    process = process.replace(',]', ']');
    var pro = JSON.parse(process);
//                            console.log(process);


    $("#chart-container").insertFusionCharts({
        type: 'gantt',
        renderAt: 'chart-container',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Se ha seleccionado " + titulo + " para su análisis",
                "subcaption": "Desde " + fechaIni + " hasta " + fechaFin,
                "dateformat": "yyyy-mm-dd hh:mn:ss",
                "outputDateFormat": "ddds mnl, yyyy hh12:mn ampm",
                "canvasBorderAlpha": "30",
                "theme": "fint",
                "useVerticalScrolling": "1",
                "scrollShowButtons": "1",
                "ganttPaneDuration": "10",
                "ganttPaneDurationUnit": "m",
                "scrollColor": "#CCCCCC",
                "scrollPadding": "4",
                "scrollHeight": "20",
                "scrollBtnWidth": "25",
                "scrollBtnPadding": "5",
                exportEnabled: "1"
            },
            "categories": [{
                    "category": categorias
                }],
            "processes": {
                "fontsize": "12",
                "isbold": "1",
                "align": "left",
                "headertext": titulo,
                "headerfontsize": "14",
                "headervalign": "middle",
                "headeralign": "left",
                "process": pro
            },
            "tasks": {
                "showlabels": "1",
                "task": tareas}
        }
    });
}

