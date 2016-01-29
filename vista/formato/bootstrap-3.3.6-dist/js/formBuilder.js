/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('crearFormato2').ready(function () {
    var currentlySelected = 'esto seria el nuevo elemento';

    $('.new-element').click(function () {
        $('#myTabs a[href="#propiedades"]').tab('show');
        var opcion = $(this).attr('data-type');
        var currentlySelected = clearElementSelected();
        console.log(opcion);
        $.post("../formato/elemento.php", {opcion: opcion},
        function (mensaje) {
            $('#formBuilder').append(mensaje);
            var newElement = $('#formBuilder div:last');
            currentlySelected = newElement;
            newElement.addClass('isSelected');
            ordenarPosicion();
            console.log(currentlySelected);
        });
    });

    $(function () {
        $('#formBuilder').sortable({revert: true});
        ordenarPosicion();
    });

    function clearElementSelected() {
        $('#formBuilder div').each(function () {
            $(this).removeClass('isSelected');
        });
    }

    function ordenarPosicion() {
        $('#formBuilder div').each(function (i) {
            var id = 'element-' + i;
            $(this).attr('id', id);
        });
    }




//____________________Seleccionar un div del formBuilder________________________
    $('#element-3').click(function () {
        console.log("click en formato");
        clearElementSelected();
        $(this).addClass('isSelected');
        currentlySelected = $(this);
        alert("has hecho click en la capa div");
    });

});


