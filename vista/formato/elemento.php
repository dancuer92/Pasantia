<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of elementos
 *
 * @author pinformatica
 */
$opcion = $_POST['opcion'];

switch ($opcion) {
    case("element-text"):
        getInputText();
        break;
    case("element-number"):
        getInputNumber();
        break;
    case("element-paragraph-text"):
        getAreaText();
        break;
    case("element-checkboxes"):
        getCheckboxes();
        break;
    case("element-multiple-choice"):
        getRadio();
        break;
    case("element-dropdown"):
        getDropdown();
        break;
    case("element-table"):
        getTable();
        break;
    case("element-section-break"):
        getSectionBreak();
        break;
    case("element-option"):
        getOpcion();
        break;
    case("element-date"):
        getFecha();
        break;
    case("element-time"):
        getHora();
        break;
    case("element-link"):
        getLink();
        break;
}

function getInputText() {
    $msj = '<div class="formato form-group ui-state-default ">'
            . '<label >Título del campo de texto</label>'
            . '<input id="untitled" name="untitled" type="text" length="30" pattern="[0-9a-zA-ZñÑáÁéÉíÍóÓúÚüÜ,.-/ \s]{1,30}" title="Digite sólo letras" disabled/>'
            . '</div>';
    echo $msj;
}

function getInputNumber() {
    $msj = '<div class="formato  form-group ui-state-default ">'
            . '<label>Título del campo numérico</label>'
            . '<input id="untitled" name="untitled" type="number" length="15" step="any" disabled/>'
            . '</label>'
            . '</div>';
    echo $msj;
}

function getAreaText() {
    $msj = '<div class="formato ui-state-default " >'
            . '<label>Título del área de texto</label>'
            . '<textarea id="untitled" name="untitled" type="text" disabled>'
            . '</textarea>'
            . '</div>';
    echo $msj;
}

function getCheckboxes() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Título de casillas de verificación</label><br>'
            . '<input id="Untitled-0" type="checkbox" name="Untitled-0" value="untitled" disabled/><p>Untitled</p>'
            . '</div>';
    echo $msj;
}

function getDropdown() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Título de lista desplegable</label>'
            . '<select id="select" name="select">'
            . '<option value="" selected></option>'
            . '<option value="opcion-1">Option 1</option>'
            . '</select>'
            . '</div>';
    echo $msj;
}

function getRadio() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Título de opciones</label><br>'
            . '<input type="radio" id="Untitled-0" name="radio" value="Untitled" disabled/><p>Untitled</p> '
            . '</div>';
    echo $msj;
}

function getTable() {
    $msj = '<div class="ui-state-default formato">'
            . '<label >Título de la tabla</label>'
            . '<table id="tabla">'
            . '<thead><td><p>Titulo 1</p></td></thead>'
            . '<tbody>'
            . '<tr><td><input id="tabla_0" name="tabla_0" type="text" length="30" pattern="[0-9a-zA-ZñÑáÁéÉíÍóÓúÚüÜ.,-/ \s]{1,30}" title="Digite sólo letras" disabled></td></tr>'
            . '</tbody>'
            . '</table>'
            . '</div>';
    echo $msj;
}

function getOpcion() {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $name = $_POST['name'];
    if ($tipo == "checkbox") {
        $msj = '<input id="' . $id . '" type="checkbox" name="' . $id . '" value="Untitled" disabled/><p>Untitled</p>';
    } elseif ($tipo == "radio") {
        $msj = '<input type="radio" id="' . $id . '"  name="'.$name.'" value="Untitled" disabled/><p>Untitled</p>';
    } else {
        $msj = '<option value="opcion-1">Opcion1</option>';
    }
    echo $msj;
}

function getSectionBreak() {
    $msj = '<div class="formato ui-state-default" style="width:100%;">'
            . '<label>Título del separador</label>'
            . '</div>';
    echo $msj;
}

function getFecha() {
    $dateMin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") - 1));
    $dateMax = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y") + 1));
    $msj = '<div class="formato form-group ui-state-default ">'
            . '<label >Fecha</label>'
            . '<input id="fecharegistro" name="fecharegistro" type="date" min="' . $dateMin . '" max="' . $dateMax . '" disabled/>'
            . '</div>';
    echo $msj;
}

function getHora() {
    $msj = '<div class="formato form-group ui-state-default ">'
            . '<label >Hora</label>'
            . '<input id="horaregistro" name="horaregistro" type="time" disabled/>'
            . '</div>';
    echo $msj;
}

function getLink() {
    $msj = '<div class="formato form-group ui-state-default ">'
            . '<a href="">Enlace</a>'
            . '</div>';
    echo $msj;
}

?>
