<?php
    // Incluimos el script de conexión
    require_once 'conexion.php'; 
    session_start();            /*
                                * session_start() crea una sesión o reanuda la actual basada en un identificador 
                                * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                                */
    // Tomamos los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    
    //password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash fuerte 
    $passwordHash = password_hash($password, PASSWORD_DEFAULT); //podes ver mas información de password_hash en https://www.php.net/manual/es/function.password-hash.php
 
    // Creamos la consulta INSERT con las variables que obtuvimos del formulario
    $sql = "INSERT INTO usuarios VALUES(";
    $sql .= "'" . $username . "', '" . $passwordHash . "', '" . $email . "', '" . $nombre . "', '" . $apellido . "')";
    
    // Ejecutamos la consulta mediante el objeto $conexion que instanciamos en el script conexion.php
    $conexion->query($sql);
        
    //redirigimos a la pagina de login
    header("Location: login.html");
 
?>