<?php
// Incluimos el script de conexión
require_once 'conexion.php'; 
session_start();            /*
                            * session_start() crea una sesión o reanuda la actual basada en un identificador 
                            * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                            */
// Verificar si se ha enviado el ID del partido como parámetro en la URL
if (isset($_GET["id"])) {
    $partido_id = $_GET["id"];

    // Obtener los datos del partido por su ID
    $sql = "SELECT * FROM partidos WHERE id = $partido_id";
    $result = $conexion2->query($sql);

    // Verificar si el partido existe
    if ($result->num_rows > 0) {
        $partido = $result->fetch_assoc();
    } else {
        echo "El partido no existe.";
        exit;
    }
}

// Procesar el formulario de inserción/edición
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $partido_id = isset($_POST["partido_id"]) ? $_POST["partido_id"] : null;
    $equipo_id = $_POST["equipo_id"];
    $fecha = $_POST["fecha"];
    $local = $_POST["local"];
    $visitante = $_POST["visitante"];
    $goles_local = $_POST["goles_local"];
    $goles_visitante = $_POST["goles_visitante"];
    $resultado = $_POST["resultado"];

    if ($partido_id) {
        // Actualizar el partido existente en la base de datos mediante un Update
        $sql = "UPDATE partidos SET equipo_id = $equipo_id, fecha = '$fecha', local = '$local', visitante = '$visitante', goles_local = $goles_local, goles_visitante = $goles_visitante, resultado = '$resultado' WHERE id = $partido_id";
        
        if ($conexion2->query($sql) === TRUE) {
            echo "Partido actualizado correctamente.";
            header("Location: index.php");
        } else {
            echo "Error al actualizar el partido: " . $conexion2->error;
        }
    } else {
        // Insertar el nuevo partido en la base de datos
        $sql = "INSERT INTO partidos (equipo_id, fecha, local, visitante, goles_local, goles_visitante, resultado) 
                VALUES ($equipo_id, '$fecha', '$local', '$visitante', $goles_local, $goles_visitante, '$resultado')";
        
        if ($conexion2->query($sql) === TRUE) {
            echo "Partido agregado correctamente.";
            header("Location: index.php");
        } else {
            echo "Error al agregar el partido: " . $conexion2->error;
        }
    }

    $conexion2->close();
}
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
        <form action="editar_partido.php<?php echo isset($partido_id) ? '?id=' . $partido_id : ''; ?>" method="post">
                <input type="hidden" name="partido_id" id="partido_id" value="<?php echo isset($partido["id"]) ? $partido["id"] : ''; ?>">

                <label for="equipo_id">ID del Equipo:</label>
                <input type="number" id="equipo_id" name="equipo_id" value="<?php echo isset($partido["equipo_id"]) ? $partido["equipo_id"] : ''; ?>" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo isset($partido["fecha"]) ? $partido["fecha"] : ''; ?>" required>

                <label for="local">Local:</label>
                <input type="text" id="local" name="local" value="<?php echo isset($partido["local"]) ? $partido["local"] : ''; ?>" required>

                <label for="visitante">Visitante:</label>
                <input type="text" id="visitante" name="visitante" value="<?php echo isset($partido["visitante"]) ? $partido["visitante"] : ''; ?>" required>

                <label for="goles_local">Goles Local:</label>
                <input type="number" id="goles_local" name="goles_local" value="<?php echo isset($partido["goles_local"]) ? $partido["goles_local"] : ''; ?>" required>

                <label for="goles_visitante">Goles Visitante:</label>
                <input type="number" id="goles_visitante" name="goles_visitante" value="<?php echo isset($partido["goles_visitante"]) ? $partido["goles_visitante"] : ''; ?>" required>

                <label for="resultado">Resultado:</label>
                <input type="text" id="resultado" name="resultado" value="<?php echo isset($partido["resultado"]) ? $partido["resultado"] : ''; ?>" required>
            
                <button type="submit"><?php echo isset($partido_id) ? 'Actualizar Partido' : 'Guardar Partido'; ?></button>
        </form>

    </div>
</div>
</body>
</html>