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
    case("element-option-checkbox"):
        getOpcionCheckbox();
        break;
    case("element-option-radio"):
        getOpcionRadio();
        break;
}

function getInputText() {
    $msj = '<div class="formato form-group ui-state-default ">'
            . '<label >Untitled </label>'
            . '<input id="untitled" type="text" length="30" required="false" disabled/>'
            . '</div>';
    echo $msj;
}

function getInputNumber() {
    $msj = '<div class="formato  form-group ui-state-default ">'
            . '<label>Untitled </label>'
            . '<input id="untitled" type="number" length="15" required="false" disabled/>'
            . '</label>'
            . '</div>';
    echo $msj;
}

function getAreaText() {
    $msj = '<div class="formato ui-state-default " >'
            . '<label>Untitled </label> <br>'
            . '<textarea id="untitled" type="text" required="false" disabled>'
            . '</textarea>'
            . '</div>';
    echo $msj;
}

function getCheckboxes() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled </label> <br>'
            . '<input id="option1" type="checkbox" name="untitled" value="option1" disabled/>Option1'
            . '<input id="option2" type="checkbox" name="untitled" value="option2" disabled/>Option2'
            . '<input id="option3" type="checkbox" name="untitled" value="option3" disabled/>Option3'
            . '<input id="option4" type="checkbox" name="untitled" value="option4" disabled/>Option4'
            . '</div>';
    echo $msj;
}

function getDropdown() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled </label> <br>'
            . '<select disabled>'
            . '<option >option1</option>'
            . '<option >option2</option>'
            . '<option >option3</option>'
            . '</select>'
            . '</div>';
    echo $msj;
}

function getRadio() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled </label><br>'
            . '<input type="radio" id="option1" name="radio" value="option1" disabled/>Option-1 '
            . '<input type="radio" id="option2" name="radio" value="option2" disabled/>Option-2 '
            . '<input type="radio" id="option3" name="radio" value="option3" disabled/>Option-3 '
            . '</div>';
    echo $msj;
}

function getTable() {
    $msj = '<div class="formato ui-state-default">'
            . '<table><thead><th>Columna1</th><th>Columna2</th></thead>'
            . '<tbody>'
            . '<tr><td>i1j1</td><td>i1j2</td></tr>'
            . '<tr><td>i2j1</td><td>i2j2</td></tr>'
            . '</tbody>'
            . '</div>';
    echo $msj;
}

function getOpcionCheckbox() {
    $pos = $_POST['pos'];
    $msj = '<input id="option-'.$pos.'" type="checkbox" name="untitled" value="option-'.$pos.'" disabled/>Option-'.$pos;
    echo $msj;
}

function getOpcionRadio() {
    $pos = $_POST['pos'];
    $msj = '<input type="radio" id="option-'.$pos.'"  name="radio" value="option-'.$pos.'" disabled/>Option-'.$pos;
    echo $msj;
}

?>
