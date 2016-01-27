/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('crearFormato2').ready(function () {
    $('.new-element').click(function () {
        $('#myTabs a[href="#propiedades"]').tab('show');
        var opcion = $(this).attr('data-type');
        console.log(opcion);
        $.post("../formato/elemento.php", {opcion: opcion},
        function (mensaje) {
            $('#formBuilder').append(mensaje);
        });
    });


});
