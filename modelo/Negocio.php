<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../modelo/dao/Formato_dao.php';


class Negocio {
    private $formato;


    public function __construct() {
        $this->formato= new Formato_dao();
    }

    public function cargarFormatos($codigo_formato) {
        $msj= '<p>codigo formato: '.$codigo_formato.'</p>';
        echo $this->formato->cargarFormatos($codigo_formato);
        echo $msj;
    }

}
