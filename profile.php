<?php
    session_start();
    if(!isset($_SESSION['logueado'])){
        header("Location: index.php");
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
        
        <meta charset="utf-8">
        
        <title> Formulario de Acceso </title>    
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="author" content="Videojuegos & Desarrollo">
        <meta name="description" content="Muestra de un formulario de acceso en HTML y CSS">
        <meta name="keywords" content="Formulario Acceso, Formulario de LogIn">
        
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
        <!-- Link de bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="css/login.css">
        
        <style type="text/css">
            
        </style>
        
        <script type="text/javascript">
        
        </script>
    </head>
<body>

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Bienvenido <?php echo ($_SESSION['nombre']);?></a>
    <form action="logout.php" method="post">
                        <button type="submit" title="Salir" name="salir">Logout</button>
    </form>
  </div>
</nav>
<!-- Formulario para agregar equipos -->
<div id="contenedor">
<div class="container">
<h1>Agregar Equipos</h1>
        <form action="agregar_equipo.php" method="post" >
            <label for="nombre">Nombre del Equipo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="partidos_jugados">Partidos Jugados (PJ):</label>
            <input type="number" id="partidos_jugados" name="partidos_jugados" required>

            <label for="partidos_ganados">Partidos Ganados (PG):</label>
            <input type="number" id="partidos_ganados" name="partidos_ganados" required>

            <label for="partidos_empatados">Partidos Empatados (PE):</label>
            <input type="number" id="partidos_empatados" name="partidos_empatados" required>

            <label for="partidos_perdidos">Partidos Perdidos (PP):</label>
            <input type="number" id="partidos_perdidos" name="partidos_perdidos" required>

            <label for="goles_a_favor">Goles a Favor (GF):</label>
            <input type="number" id="goles_a_favor" name="goles_a_favor" required>

            <label for="goles_en_contra">Goles en Contra (GC):</label>
            <input type="number" id="goles_en_contra" name="goles_en_contra" required>

            <button type="submit">Guardar Equipo</button>
        </form>
        <p id="mensajeEquipo" class="mensaje"></p>
  </div>
<div class="container">
<!-- Formulario para agregar partidos -->
<h1>Agregar Partidos</h1>
        <form action="guardar_partido.php" method="post">
            <label for="equipo_id">Equipo:</label>
            <select id="equipo_id" name="equipo_id">
                <?php
                // Incluimos el script de conexión
                    require_once 'conexion.php'; 
                    session_start();            /*
                                                * session_start() crea una sesión o reanuda la actual basada en un identificador 
                                                * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                                                */ 

                $equipos_sql = "SELECT id, nombre FROM equipos";
                $equipos_result = $conexion2->query($equipos_sql);

                if ($equipos_result->num_rows > 0) {
                    while ($equipo_row = $equipos_result->fetch_assoc()) {
                        echo "<option value='" . $equipo_row["id"] . "'>" . $equipo_row["nombre"] . "</option>";
                    }
                }

                $conexion2->close();
                ?>
            </select>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="local">Equipo Local:</label>
            <input type="text" id="local" name="local" required>

            <label for="goles_local">Goles del Local:</label>
            <input type="number" id="goles_local" name="goles_local" required>

            <label for="visitante">Equipo Visitante:</label>
            <input type="text" id="visitante" name="visitante" required>

            <label for="goles_visitante">Goles del Visitante:</label>
            <input type="number" id="goles_visitante" name="goles_visitante" required>

            <label for="resultado">Resultado:</label>
            <input type="text" id="resultado" name="resultado" required>

            <button type="submit">Guardar Partido</button>
        </form>
        <p id="mensajePartido" class="mensaje"></p>
</div>
</div>
<script src="scripts.js"></script>
</body>
</html>