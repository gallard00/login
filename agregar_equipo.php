<?php
// Incluimos el script de conexión
require_once 'conexion.php'; 

// Obtener los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $partidos_jugados = $_POST["partidos_jugados"];
    $partidos_ganados = $_POST["partidos_ganados"];
    $partidos_empatados = $_POST["partidos_empatados"];
    $partidos_perdidos = $_POST["partidos_perdidos"];
    $goles_a_favor = $_POST["goles_a_favor"];
    $goles_en_contra = $_POST["goles_en_contra"];

    // Calcular la diferencia de goles y los puntos totales
    $diferencia_goles = $goles_a_favor - $goles_en_contra;
    $puntos = ($partidos_ganados * 3) + $partidos_empatados;

    // Insertar el equipo en la base de datos
    $sql = "INSERT INTO equipos (nombre, partidos_jugados, partidos_ganados, partidos_empatados, partidos_perdidos, goles_a_favor, goles_en_contra, diferencia_goles, puntos)
            VALUES ('$nombre', $partidos_jugados, $partidos_ganados, $partidos_empatados, $partidos_perdidos, $goles_a_favor, $goles_en_contra, $diferencia_goles, $puntos)";
   
    if ($conexion2->query($sql) === TRUE) {
        echo "Equipo agregado correctamente.";
        // Redireccionar a la página principal después de agregar el equipo
        header("Location: profile.php");
    } else {
        echo "Error al agregar el equipo: " . $conexion2->error;
    }
}

// Cerrar conexión
$conexion2->close();
?>