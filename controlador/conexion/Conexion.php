<?php
//header("Content-Type: text/html;charset=utf-8");

/**
 * Clase de conexión a la base de datos.
 */
class Conexion extends mysqli {

//    protected $host = 'sandbox2.ufps.edu.co';
//    protected $usuario = 'ufps_87';
//    protected $contraseña = 'ufps_er';
//    protected $bd = 'ufps_87';
    protected $host = 'localhost';
    protected $usuario = 'root';
    protected $contraseña = '';
    protected $bd = 'pasantia';

    /**
     * Método constructor de la clase que representa una conexión entre PHP y la base de datos MySQL
     */
    public function __construct() {
        parent::__construct($this->host, $this->usuario, $this->contraseña, $this->bd);

        if (mysqli_connect_error()) {
            die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }

}

?>