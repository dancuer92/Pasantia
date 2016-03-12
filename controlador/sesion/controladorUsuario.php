
<?php
session_start();
//require_once '../conexion/Conexion.php';
require_once '../../modelo/dto/Usuario_dto.php';

$opcion = $_POST['opcion'];

if ($opcion == "registrar") {
    registrar();
}
if ($opcion == "buscar") {
    buscar();
}
if ($opcion == "cambiar") {
    cambiarPass();
}
if ($opcion == "cargar") {
    cargar();
}
if ($opcion == "editar") {
    editar();
}

if ($opcion == "listar") {
    listar();
}


if ($opcion == "cargarUsuario") {
    cargarUsuario();
}

function registrar() {
    if (!$mysqli = new mysqli("localhost", "root", "", "pasantia")) {
        die("Error al conectarse a la base de datos");
    }

    $mensaje = "";
    $codigo = (int) $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['numDoc'];
    $password = $_POST['pass'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $telefono = $_POST['telefono'];
    $rol_usuario = (int) $_POST['rol'];
    $estado = (int) $_POST['estado'];
//    $fecha = new DateTime();
//    $result = $fecha->format('Y-m-d-H-i-s');
//preparacion de la consulta
    $sql = "INSERT INTO `usuario`(`codigo_usuario`, `nombre_usuario`, `apellido_usuario`, `cedula_usuario`, "
            . "`password_usuario`, `correo_usuario`, `cargo_usuario`, `departamento_usuario`, `telefono_usuario`, "
            . "`rol_usuario`, `estado_usuario`) "
            . "VALUES (?,?,?,?,?,?,?,?,?,?,?);";


    //PREPARAMOS EL PROCEDIMIENTO
    if (!$sentencia = $mysqli->prepare($sql)) {
        $mensaje.= $mysqli->error;
    }

    //LE PASAMOS LOS PARAMETROS; "SS" SIGNIFICA QUE SON STRINGS
    if (!$sentencia->bind_param("issssssssii", $codigo, $nombre, $apellido, $cedula, $password, $correo, $cargo, $departamento, $telefono, $rol_usuario, $estado)) {
        $mensaje.= $mysqli->error;
    }

    //EJECUTAMOS LA CONSULTA
    if ($sentencia->execute()) {
        $mensaje = ("Usuario registrado con éxito");
    } else {
        $mensaje = ("Error al registrar usuario");
    }
    $sentencia->close();
    $mysqli->close();
    echo $mensaje;
}

function buscar() {
    if (!$conexion = new mysqli("localhost", "root", "", "pasantia")) {
        die("Error al conectarse a la base de datos");
    }
    $consultaBusqueda = $_POST['valorBusqueda'];
    $mensaje = "";
    $sql = "SELECT u.codigo_usuario, u.nombre_usuario, u.apellido_usuario, u.correo_usuario, u.cargo_usuario, "
            . "u.departamento_usuario, u.telefono_usuario, u.rol_usuario, u.estado_usuario, u.fecha_registro "
            . "FROM usuario u WHERE u.codigo_usuario COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
            . "OR u.nombre_usuario COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
            . "OR u.apellido_usuario COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
            . "OR concat(u.nombre_usuario,' ',u.apellido_usuario) COLLATE latin1_swedish_ci LIKE '%$consultaBusqueda%' "
            . "LIMIT 6;";   
    

    $consulta = mysqli_query($conexion, $sql);

    $filas = mysqli_num_rows($consulta);

    if ($filas === 0) {
        $mensaje = "<p>No hay ningún usuario con ese criterio de búsqueda</p>";
    } else {
        $mensaje = '<div class="row"> ';

        while ($resultados = mysqli_fetch_array($consulta)) {
            $tipo = "operario";
            if ($resultados[7] === "1") {
                $tipo = "administrador";
            }
            $mensaje.='<div class="col s12 m7 l4">            
                <div class="card">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Código: '. $resultados['codigo_usuario'] .'<i class="material-icons right">more_vert</i></span>
                        <p>' . $resultados['nombre_usuario'] .' '. $resultados['apellido_usuario'].'</p>
                        <p>' . $resultados['cargo_usuario'] . '</p>
                        <p>Área: ' . $resultados['departamento_usuario'] . '</p>                        
                        <p>Telefono: ' . $resultados['telefono_usuario'] . '</p>
                        <p>Correo: ' . $resultados['correo_usuario'] . '</p>';
            if ($resultados[8] === "1") {                
                    $mensaje.='<p>Tipo de Usuario: ' . $tipo . ' Activo</p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">¿Desea desactivar el usuario?<i class="material-icons right">close</i></span>
                        <p><a id="act/desac" class="waves-effect waves-red btn-flat hoverable" onclick="estadoUsuario( '. $resultados['codigo_usuario'] .','. 0 .')">Aceptar</a></p>                    
                    </div>                 
                </div>               
            </div>';
            } else {
                $mensaje.='<p>Tipo de Usuario: ' . $tipo . ' Inactivo</p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">¿Desea activar el usuario?<i class="material-icons right">close</i></span>
                        <p><a id="act/desac" class="waves-effect waves-red btn-flat hoverable" onclick="estadoUsuario( '. $resultados['codigo_usuario'] .', '. 1 .')">Aceptar</a></p>                    
                    </div>                 
                </div> 
            </div>';
            }
        }
    }
    mysqli_close($conexion);
    print_r($mensaje);
}

function cambiarPass() {
    if (!$mysqli = new mysqli("localhost", "root", "", "pasantia")) {
        die("Error al conectarse a la base de datos");
    }
    $mensaje = "";
    $newPass = $_POST['passNew'];
    $prevPass = $_POST['passAnt'];
    $cod = $_POST['codigo'];

    $sql = "UPDATE usuario u SET u.password_usuario=? WHERE u.password_usuario=? AND u.codigo_usuario=? ;";

    if (!$sentencia = $mysqli->prepare($sql)) {
        $mensaje.= $mysqli->error;
    }
    if (!$sentencia->bind_param("sss", $newPass, $prevPass, $cod)) {
        $mensaje.= $mysqli->error;
    }
    if (!$sentencia->execute()) {
        $mensaje .= "la contraseña no ha sido actualizada";
    } else {
        $mensaje = "la contraseña ha sido actualizada";
        if ($sentencia->affected_rows === 0) {
            $mensaje = "la contraseña anterior no coincide con la base de datos";
        }
    }
    $sentencia->close();
    $mysqli->close();
    echo $mensaje;
}

function cargar() {
    if (!$mysqli = new mysqli("localhost", "root", "", "pasantia")) {
        die("Error al conectarse a la base de datos");
    }
    $mensaje = "";
    $cod = $_SESSION['codigo'];

    $sql = "SELECT u.codigo_usuario, u.nombre_usuario, u.apellido_usuario, u.cedula_usuario, u.correo_usuario, u.cargo_usuario,"
            . "u.departamento_usuario, u.telefono_usuario, u.rol_usuario "
            . "FROM usuario u WHERE u.codigo_usuario = ?";


    if (!$sentencia = $mysqli->prepare($sql)) {
        $mensaje.= $mysqli->error;
    }
    if (!$sentencia->bind_param("s", $cod)) {
        $mensaje.= $mysqli->error;
    }
    if ($sentencia->execute()) {
        $sentencia->bind_result($codigo_usuario, $nombre_usuario, $apellido_usuario, $cedula_usuario, $correo_usuario, $cargo_usuario, $departamento_usuario, $telefono_usuario, $rol_usuario);
        while ($sentencia->fetch()) {               
            $mensaje.='<h5> <strong>Código de usuario: </strong>' . $codigo_usuario . '</h5>
                        <h5> <strong>Nombre: </strong> <input id="nombre_usuario" disabled value="' . $nombre_usuario . '" onblur="edit(&nombre_usuario&)"></h5>
                        <h5> <strong>Apellido: </strong><input id="apellido_usuario" disabled value="' . $apellido_usuario . '" onblur="edit(&apellido_usuario&)"></h5>
                        <h5> <strong>Cédula: </strong><input id="cedula_usuario" disabled value="' . $cedula_usuario . '" onblur="edit(&cedula_usuario&)"></h5>
                        <h5> <strong>Correo: </strong><input id="correo_usuario" disabled value="' . $correo_usuario . '" onblur="edit(&correo_usuario&)"></h5>
                        <h5> <strong>Cargo: </strong><input id="cargo_usuario" disabled value="' . $cargo_usuario . '" onblur="edit(&cargo_usuario&)"></h5>
                        <h5> <strong>Departamento o área de trabajo:</strong> <input id="departamento_usuario" disabled value=" ' . $departamento_usuario . '" onblur="edit(&departamento_usuario&)"></h5>
                        <h5> <strong>Teléfono:</strong> <input id="telefono_usuario" disabled value="' . $telefono_usuario . '" onblur="edit(&telefono_usuario&)"></h5>';
            if ($rol_usuario === "0") {
                $mensaje.='<h5> <strong>Tipo de usuario en el sistema</strong>: Operario</h5>';
            } else {
                $mensaje.='<h5> <strong>Tipo de usuario en el sistema</strong>: Administrador</h5>';
            }
        }
    }
    $sentencia->close();
    $mysqli->close();
    $mensaje=  str_replace("&", "'", $mensaje);
    echo $mensaje;
}

function editar(){
    if (!$mysqli = new mysqli("localhost", "root", "", "pasantia")) {
        die("Error al conectarse a la base de datos");
    }
    $mensaje = "";
    $clave = $_POST['clave'];
    $valor = $_POST['valor'];
    $cod = $_SESSION['codigo'];

    $sql = "UPDATE usuario u SET u.".$clave."=? WHERE u.codigo_usuario=? ;";

    if (!$sentencia = $mysqli->prepare($sql)) {
        $mensaje.= $mysqli->error;
    }
    if (!$sentencia->bind_param("ss", $valor, $cod)) {
        $mensaje.= $mysqli->error;
    }
    if (!$sentencia->execute()) {
        $mensaje .= "No se ha podido actualizar";
    } else {
        $mensaje = "Campo actualizado";
        if ($sentencia->affected_rows === 0) {
            $mensaje = "No se ha cambiado la información";
        }
    }
    $sentencia->close();
    $mysqli->close();
    echo $mensaje;

}


function enviarDatosEmail($email, $clave, $nombre) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False
    $mail->Username = "siapacunilibre@gmail.com"; // Cuenta de e-mail
    $mail->Password = "siapac123"; // Password


    $mail->Host = "smtp.gmail.com";
    $mail->From = "siapacunilibre@gmail.com";
    $mail->FromName = "Sistema de información de asignación y préstamos de aulas de clases.";
    $mail->Subject = "Confirmación de registro de usuario";
    $mail->AddAddress($email, $nombre);

    $mail->WordWrap = 50;
    $mail->CharSet = 'UTF-8';

    $body = "Bienvenido a SIAPAC, el sistema de información para la asignación y préstamo de aulas de clase.<br> ";
    $body .= "Sus datos de acceso son los siguientes:<br>";
    $body .= "<strong>Usuario:</strong>" . $email . "<br>";
    $body .= "<strong>Clave:</strong>" . $clave . "<br>";

    $mail->Body = $body;
    $mail->IsHTML(true);
    $mail->Send();
// Notificamos al usuario del estado del mensaje
//    if (!$mail->Send()) {
//        echo "No se pudo enviar el Mensaje.";
//    } else {
//        echo "Mensaje enviado";
//    }
}



