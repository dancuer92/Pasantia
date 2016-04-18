<?php
header("Content-Type: text/html;charset=utf-8");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//Reanudamos la sesión 
session_start();
//Literalmente la destruimos 
session_destroy();
//Redireccionamos a index.php (al inicio de sesión) 
header("Location: ../../index.php");
?>