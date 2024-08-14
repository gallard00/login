<?php
// Incluimos el script de conexión
require_once 'conexion.php'; 
session_start();            /*
                            * session_start() crea una sesión o reanuda la actual basada en un identificador 
                            * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                            */ 

// Obtener el ID del equipo a eliminar
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $equipo_id = $_GET["id"];

    // Eliminar el equipo de la base de datos
    $sql = "DELETE FROM equipos WHERE id = $equipo_id";

    if ($conexion2->query($sql) === TRUE) {
        // Redireccionar a la página principal después de eliminar el equipo
        header("Location: index.php");
    } else {
        echo "Error al eliminar el equipo: " . $conexion2->error;
    }
}

// Obtener el ID del partido a eliminar
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $equipo_id = $_GET["id"];

    // Eliminar el equipo de la base de datos
    $sql = "DELETE FROM partidos WHERE id = $equipo_id";

    if ($conexion2->query($sql) === TRUE) {
        // Redireccionar a la página principal después de eliminar el equipo
        header("Location: index.php");
    } else {
        echo "Error al eliminar el equipo: " . $conexion2->error;
    }
}

// Cerrar conexión
$conexion2->close();
?>