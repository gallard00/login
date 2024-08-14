<?php
// Incluimos el script de conexión
require_once 'conexion.php'; 
session_start();            /*
                            * session_start() crea una sesión o reanuda la actual basada en un identificador 
                            * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                            */ 

// Obtener los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $equipo_id = $_POST["equipo_id"];
    $fecha = $_POST["fecha"];
    $local = $_POST["local"];
    $visitante = $_POST["visitante"];
    $goles_local = $_POST["goles_local"];
    $goles_visitante = $_POST["goles_visitante"];
    $resultado = $_POST["resultado"];

    
// Insertar el equipo en la base de datos
    $sql = "INSERT INTO partidos (equipo_id, fecha, local, visitante, goles_local, goles_visitante, resultado) 
            VALUES ($equipo_id, '$fecha', '$local', '$visitante', $goles_local, $goles_visitante, '$resultado')";

    if ($conexion2->query($sql) === TRUE) {
        echo "Partido agregado correctamente.";
        // Redireccionar a la página principal después de agregar el equipo
        header("Location: profile.php");
    } else {
        echo "Error al agregar el partido: " . $conexion2->error;
    }

    $conexion2->close();
}
?>