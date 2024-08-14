<?php
// Incluimos el script de conexión
require_once 'conexion.php'; 
session_start();            /*
                            * session_start() crea una sesión o reanuda la actual basada en un identificador 
                            * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                            */ 

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["equipo_id"])) {
    $equipo_id = $_GET["equipo_id"];
    
    // Obtener detalles del equipo
    $equipo_sql = "SELECT * FROM equipos WHERE id = $equipo_id";
    $equipo_result = $conexion2->query($equipo_sql);
    
    if ($equipo_result->num_rows > 0) {
        $equipo_row = $equipo_result->fetch_assoc();
        $nombre_equipo = $equipo_row["nombre"];
        
        // Obtener resultados de partidos del equipo
        $partidos_sql = "SELECT * FROM partidos WHERE equipo_id = $equipo_id";
        $partidos_result = $conexion2->query($partidos_sql);
    } else {
        echo "Equipo no encontrado.";
        exit;
    }
    
    $conexion2->close();
} else {
    echo "Equipo no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Equipo - <?php echo $nombre_equipo; ?></title>
    <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Detalles del Equipo - <?php echo $nombre_equipo; ?></h1>

<nav>
	<a href="index.php">Home</a>
	<a href="login.html">Login</a>
	<a href="detalles_equipo.php">Partidos</a>
	<a href="#">Portfolio</a>
	<a href="contact.html">Contact</a>
	<div class="animation start-home"></div>
</nav>

<div id="contenedor">
    <div class="container">
        <table class="tabla-posiciones">
            <tr>
                <th>Fecha</th>
                <th>Local</th>
                <th>Goles Local</th>
                <th>Goles Visitante</th>
                <th>Visitante</th>
                <th>Resultado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        <?php
            if ($partidos_result->num_rows > 0) {
                while ($partido_row = $partidos_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $partido_row["fecha"] . "</td>";
                    echo "<td>" . $partido_row["local"] . "</td>";
                    echo "<td>" . $partido_row["goles_local"] . "</td>";
                    echo "<td>" . $partido_row["goles_visitante"] . "</td>";
                    echo "<td>" . $partido_row["visitante"] . "</td>";
                    echo "<td>" . $partido_row["resultado"] . "</td>";
                    echo "<td><a class='edit-link' href='editar_partido.php?id=" . $partido_row["id"] . "'>Editar</a></td>";
                    echo "<td><a class='delete-link' href='eliminar_equipo.php?id=" . $partido_row["id"] . "'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No se encontraron partidos.</td></tr>";
            }
        ?>
        </table>
            <a href="index.php" class="back-link">Volver</a>
    </div>
</div> 
</body>
</html>