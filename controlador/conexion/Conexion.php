<?php
//header("Content-Type: text/html;charset=utf-8");
class Conexion extends mysqli {

    protected $host = 'localhost';
    protected $usuario = 'root';
    protected $contraseña = '';
    protected $bd = 'pasantia';

    public function __construct() {
        parent::__construct($this->host, $this->usuario, $this->contraseña, $this->bd);     

        if (mysqli_connect_error()) {
            die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }

}

?>