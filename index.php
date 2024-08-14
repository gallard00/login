<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">
    
    <title>Página principal</title>
</head>
<body>
<h1>	Tabla de Posiciones</h1>

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
<!-- Mostrar la tabla de posiciones -->
        <table class="tabla-posiciones">
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Partidos Jugados</th>
                    <th>Partidos Ganados</th>
                    <th>Partidos Empatados</th>
                    <th>Partidos Perdidos</th>
                    <th>Goles a Favor</th>
                    <th>Goles en Contra</th>
                    <th>Diferencia de Goles</th>
                    <th>Puntos</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluimos el script de conexión
                    require_once 'conexion.php'; 
                    session_start();            /*
                                                * session_start() crea una sesión o reanuda la actual basada en un identificador 
                                                * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                                                */ 

                // Función para calcular puntos y diferencia de goles
                    function calcularPuntosYDiferencia($partidos_ganados, $partidos_empatados, $goles_a_favor, $goles_en_contra) {
                    $puntos = ($partidos_ganados * 3) + $partidos_empatados;
                    $diferencia_goles = $goles_a_favor - $goles_en_contra;
                    return [$puntos, $diferencia_goles];
                }

                // Consulta SQL para obtener los equipos ordenados por puntos (mayor a menor) y por diferencia de goles (mayor a menor)
                    $sql = "SELECT * FROM equipos ORDER BY puntos DESC, diferencia_goles DESC";
                    $result = $conexion2->query($sql);


                // Mostrar los datos en la tabla
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a href='detalles_equipo.php?equipo_id=" . $row["id"] . "'>" . $row["nombre"] . "</a></td>";
                            echo "<td>" . $row["partidos_jugados"] . "</td>";
                            echo "<td>" . $row["partidos_ganados"] . "</td>";
                            echo "<td>" . $row["partidos_empatados"] . "</td>";
                            echo "<td>" . $row["partidos_perdidos"] . "</td>";
                            echo "<td>" . $row["goles_a_favor"] . "</td>";
                            echo "<td>" . $row["goles_en_contra"] . "</td>";
                            echo "<td>" . $row["diferencia_goles"] . "</td>";
                            echo "<td>" . $row["puntos"] . "</td>";
                            echo "<td><a class='edit-link' href='editar_equipo.php?id=" . $row["id"] . "'>Editar</a></td>";
                            echo "<td><a class='delete-link' href='eliminar_equipo.php?id=" . $row["id"] . "'>Eliminar</a></td>";
                            echo "</tr>";
                    }
                    } else {
                        echo "<tr><td colspan='11'>No hay equipos registrados</td></tr>";
                    }

                // Cerrar conexión
                    $conexion2->close();
                ?>
            </tbody>
        </table>
	</div>
</div>
<p>
  <span>EDI II</span>
</p>
</body>
</html>