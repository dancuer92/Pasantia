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
            . '<input id="untitled" type="text" length="30" disabled/>'
            . '</div>';
    echo $msj;
}

function getInputNumber() {
    $msj = '<div class="formato  form-group ui-state-default ">'
            . '<label>Untitled </label>'
            . '<input id="untitled" type="number" length="15" disabled/>'
            . '</label>'
            . '</div>';
    echo $msj;
}

function getAreaText() {
    $msj = '<div class="formato ui-state-default " >'
            . '<label>Untitled</label>'
            . '<textarea id="untitled" type="text" disabled>'
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
            . '<option value="opcion-1" selected>Option 1</option>'
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
            . '<table id="tabla" name="tabla"><thead><th><label>Titulo 1</label></th></thead>'
            . '<tbody>'
            . '<tr><td><p>Untitled </p><input id="Untitled" type="text" disabled></td></tr>'
            . '</tbody>'
            . '</table>'
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
        $msj='<option value="opcion-1">opcion 1</option>';
    }
    echo $msj;
}

function getSectionBreak(){
    $msj='<div class="formato ui-state-default" style="width:100%;">'
            . '<label>Separador</label>'
            . '</div>';
    echo $msj;
}

?>
