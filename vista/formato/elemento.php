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
            . '<label>Untitled</label>'
            . '<textarea id="untitled" type="text" required="false" disabled>'
            . '</textarea>'
            . '</div>';
    echo $msj;
}

function getCheckboxes() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled</label> <br>'
            . '<input id="Untitled-0" type="checkbox" name="Untitled-0" value="untitled" disabled/><p>Untitled</p>'
            . '</div>';
    echo $msj;
}

function getDropdown() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled </label>'
            . '<select id="select" name="select">'
            . '<option value="opcion-1" selected><p>Option 1</p></option>'
            . '</select>'
            . '</div>';
    echo $msj;
}

function getRadio() {
    $msj = '<div class="formato ui-state-default ">'
            . '<label>Untitled</label><br>'
            . '<input type="radio" id="Untitled-0" name="radio" value="Untitled" disabled/><p>Untitled</p> '
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

function getOpcion() {
    $id = $_POST['id'];    
    $tipo = $_POST['tipo'];    
    if($tipo=="checkbox"){
        $msj = '<input id="'.$id.'" type="checkbox" name="'.$id.'" value="Untitled" disabled/><p>Untitled</p>';    
    }
    elseif ($tipo=="radio"){
        $msj = '<input type="radio" id="'.$id.'"  name="radio" value="Untitled" disabled/><p>Untitled</p>';
    }
    else{
        $msj='<option value="opcion-1"><p>opcion 1</p></option>';
    }
    echo $msj;
}



?>
