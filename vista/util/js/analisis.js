/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    //Se visualiza el formato
    verFormato('analizar');
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
//                            console.log(datos);
    var input = $(this);
    var label = input.parent('div').children('label').text();
    var clave = input.attr('name');
    var mensaje = '<h3>Se ha seleccionado ' + label + ' para su análisis</h3><br>\n\
                                        <h4>Registros dentro del rango de fechas</h4><br>\n\
                                        <h5>Fecha del registro    ..................... Valor del registro</h5>';
    var arregloInfo = new Array();
    for (var index in datos) {
//                                arregloInfo = datos[index][1];
        arregloInfo[index] = new Array(datos[index][0], datos[index][1][clave]);
        mensaje += datos[index][0] + '..................' + datos[index][1][clave] + '<br>';
    }
    $('#resultado').html(mensaje + '<br>*Si existe un registro que coincida con la misma fecha sin tener en cuenta la hora y el mismo valor,\n\
                                        solo se mostrará un solo cuadro en la gráfica de línea del tiempo.');
    timeLine(label, arregloInfo);
});


$('#visualizarFormato').on('click', 'table td', function () {
    $('#res1').html('');
    var columna = $(this);
    var tabla = columna.parents('table');
    var tabla_name = tabla.attr('id');
    var col0 = $('#' + tabla_name + ' tr td:eq(0)').text();
    var col1 = columna.text();
    var texto = validarNombreTitulo(col1);

    console.log(tabla_name);

    
    $('#' + tabla.attr('id') + ' tr').each(function (i) {
        if (i === 0) {
            var msj = '<table id="pintar_' + tabla_name + '" class="table-bordered table-hover"><thead><tr><td>Fecha del registro</td><td>' + col0 + '</td><td>' + col1 + '</td></tr></thead><tbody></tbody></table>';
            $('#res1').append(msj);
        }
        var fila = $(this);
        for (var d in datos) {
            var flag = false;
            var row = '<tr><td>' + (datos[d][0]) + '</td>';
            
            $(fila).children('td').each(function () {
                var td = $(this);
                var col = td.text();
                if (col !== '') {
                    row += '<td>' + col + '</td>';
                }
                else {                    
                        var input = td.children('input').attr('name');
                        var valor = (datos[d][1][input]);
                        if (valor !== undefined) {
                            flag = true;
                        }
                        else {
                            valor = '';
                        }
                        row += '<td>' + valor + '</td > ';
//                    }



                    var x = td.children().first();
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
            });
            row += '</tr>';
            if (flag) {
                $('#pintar_' + tabla_name + ' tbody').append(row);
            }
        }

    });
    acomodarTabla(tabla_name);
});




/**Método funcional para imprimir toda la tabla según un rango de fechas.
*Presenta una tabla con la libreria datatable y sin grafica.
*/
//$('#visualizarFormato').on('click', 'table', function () {
//    $('#res1').html('');
//    var tabla = '#' + $(this).attr('id') + ' tr';
//    var msj = "";
//    var nombreTabla = '';
//
//    $(tabla).each(function (i) {
//        var fila = $(this);
//        if (!fila.has('input').length) {
//            nombreTabla = 'fila' + i;
//            msj = '<table id="' + nombreTabla + '" class="table-bordered table-hover">\n\
//                    <thead></thead><tbody></tbody></table>';
//            $('#res1').append(msj);
////            var encabezado = '<tr><td>Fecha sistema</td>';
//            var encabezado = '<tr>';
//            $(fila).children('td').each(function () {
//                var td = $(this);
//                var col = td.text();
//                if (col !== '') {
//                    encabezado += '<td>' + col + '</td>';
//                }
//            });
//            encabezado += '</tr>';
//            $('#fila' + i + ' thead').append(encabezado);
//
////            console.log(encabezado);
//
//        }
//        else {
////            console.log('fila: ' + i);
////            console.log(datos);
//
//            for (var d in datos) {
////                console.log(d);
//                var flag = false;
////                var row = '<tr><td>' + (datos[d][0]) + '</td>';
//                var row = '<tr>';
////                console.log(datos[d][1]);
//                $(fila).children('td').each(function () {
//                    var td = $(this);
//                    var col = td.text();
////                    console.log(td.html());
//                    if (col !== '') {
//                        row += '<td>' + col + '</td>';
//                    }
//                    else {
//                        var input = td.children('input').attr('name');
////                        console.log(input);
//                        var valor = (datos[d][1][input]);
////                        console.log(valor);
//                        if (valor !== undefined) {
//                            flag = true;
////                            console.log(flag);
//                        }
//                        else {
//                            valor = '';
//                        }
//                        row += '<td>' + valor + '</td > ';
//                    }
//                });
//                row += '</tr>';
//                if (flag) {
//                    $('#' + nombreTabla + ' tbody').append(row);
//                }
//            }
//        }
//    });
//
//
//    //pintarGrafica();
//    acomodarTabla();
//});



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


function pintarGrafica() {
    $('#res1 table').each(function (i) {
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

function acomodarTabla(tabla) {
    $('#pintar_'+tabla).DataTable({
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
                "scrollBtnPadding": "5"
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
;