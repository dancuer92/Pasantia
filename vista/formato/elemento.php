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
}

function getInputText(){
    $msj = '<div class="formato form-group ui-state-default ">'
            . '<label>Untitled </label>'
            . '<input id="untitled" type="text" length="30" required="false"/>'
            . '</div>';
    echo $msj;
}

function getInputNumber() {
    $msj = '<div class="formato  form-group ui-state-default ">'
            . '<label>Untitled </label>'
            . '<input id="untitled" type="number" length="15" required="false"/>'
            . '</label>'
            . '</div>';
    echo $msj;
}

function getAreaText() {
    $msj = '<div class="formato ui-state-default " >'
            . '<label>Untitled </label> <br>'
            . '<textarea id="untitled" type="text" required="false">'
            . '</textarea>'
            . '</div>';
    echo $msj;
}

function getCheckboxes() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled </label> <br>'
            . '<input id="option1" type="checkbox" value="Option1"/>Option1'
            . '<input id="option2" type="checkbox" value="Option2"/>Option2'
            . '</div>';
    echo $msj;
}

function getDropdown() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled </label> <br>'
            . '<select>'
            . '<option>option1</option>'
            . '<option>option2</option>'
            . '<option>option3</option>'
            . '</select>'
            . '</div>';
    echo $msj;
}

function getRadio(){
    $msj='<div class="formato ui-state-default ">'
            . '<label>Untitled </label><br>'
            . '<input type="radio" id="option1" value="option1" checked/>Option1 '
            . '<input type="radio" id="option2" value="option2"/>Option2 '
            . '</div>';
    echo $msj;
}
