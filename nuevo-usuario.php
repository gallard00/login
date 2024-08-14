<!DOCTYPE html>
<html lang="en">
<head>
        
        <meta charset="utf-8">
        
        <title> Formulario de Registro </title>    
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="author" content="Videojuegos & Desarrollo">
        <meta name="description" content="Muestra de un formulario de acceso en HTML y CSS">
        <meta name="keywords" content="Formulario Acceso, Formulario de LogIn">
        
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
        
        <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="css/login.css">
        
        <style type="text/css">
            
        </style>
        
        <script type="text/javascript">
        
        </script>
<body>
<div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                       Registro
                    </div>
                        <form action="user-add.php" method="post">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username"><br>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"><br>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email"><br>
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre"><br>
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" id="apellido"><br>
                            <button type="submit" title="Crear" name="crear">Crear usuario</button>
                        </form>
                    </div>
                <div class="inferior">
                    <a href="index.php">Volver</a>
                </div>
            </div>
        </div>
</body>
</html>