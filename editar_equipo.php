<?php
// Incluimos el script de conexión
require_once 'conexion.php'; 
session_start();            /*
                            * session_start() crea una sesión o reanuda la actual basada en un identificador 
                            * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                            */

// Verificar si se ha enviado el ID del equipo como parámetro en la URL
if (isset($_GET["id"])) {
    $equipo_id = $_GET["id"];

    // Obtener los datos del equipo por su ID
    $sql = "SELECT * FROM equipos WHERE id = $equipo_id";
    $result = $conexion2->query($sql);

    // Verificar si el equipo existe
    if ($result->num_rows > 0) {
        $equipo = $result->fetch_assoc();
    } else {
        echo "El equipo no existe.";
        exit;
    }
} else {
    echo "No se ha proporcionado un ID de equipo válido.";
    exit;
}
// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["editar_equipo"])) {
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

    // Actualizar los datos del equipo en la base de datos
    $sql = "UPDATE equipos SET
            nombre = '$nombre',
            partidos_jugados = $partidos_jugados,
            partidos_ganados = $partidos_ganados,
            partidos_empatados = $partidos_empatados,
            partidos_perdidos = $partidos_perdidos,
            goles_a_favor = $goles_a_favor,
            goles_en_contra = $goles_en_contra,
            diferencia_goles = $diferencia_goles,
            puntos = $puntos
            WHERE id = $equipo_id";

    if ($conexion2->query($sql) === TRUE) {
        // Redireccionar a la página principal después de editar el equipo
        header("Location: index.php");
    } else {
        echo "Error al editar el equipo: " . $conexion2->error;
    }
}

// Cerrar conexión
$conexion2->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipo</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
<h1>Editar Equipo</h1>

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
        <!-- Formulario para editar el equipo -->
        <form action="editar_equipo.php?id=<?php echo $equipo_id; ?>" method="post">
            <label for="nombre">Nombre del Equipo:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $equipo["nombre"]; ?>" required>

            <label for="partidos_jugados">Partidos Jugados:</label>
            <input type="number" id="partidos_jugados" name="partidos_jugados" value="<?php echo $equipo["partidos_jugados"]; ?>" required>

            <label for="partidos_ganados">Partidos Ganados:</label>
            <input type="number" id="partidos_ganados" name="partidos_ganados" value="<?php echo $equipo["partidos_ganados"]; ?>" required>

            <label for="partidos_empatados">Partidos Empatados:</label>
            <input type="number" id="partidos_empatados" name="partidos_empatados" value="<?php echo $equipo["partidos_empatados"]; ?>" required>

            <label for="partidos_perdidos">Partidos Perdidos:</label>
            <input type="number" id="partidos_perdidos" name="partidos_perdidos" value="<?php echo $equipo["partidos_perdidos"]; ?>" required>

            <label for="goles_a_favor">Goles a Favor:</label>
            <input type="number" id="goles_a_favor" name="goles_a_favor" value="<?php echo $equipo["goles_a_favor"]; ?>" required>
        
            <label for="goles_en_contra">Goles en Contra:</label>
            <input type="number" id="goles_en_contra" name="goles_en_contra" value="<?php echo $equipo["goles_en_contra"]; ?>" required>
        
            <button type="submit" name="editar_equipo">Guardar Partido</button>
        </form>
    </div>
</div>
</body>
</html>