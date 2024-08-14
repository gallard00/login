<?php
 
    require_once 'conexion.php';     // Incluimos el script de conexión, ya que utilizaremos la base de datos
    session_start();                    /*
                                        * session_start() crea una sesión o reanuda la actual basada en un identificador 
                                        * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                                        */
// Tomamos mediante POST el dato de input del usuario
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    
// Creamos una consulta SELECT a tabla usuarios para despues ejecutarla  
    $sql = "SELECT * ";             
    $sql .= "FROM usuarios ";  
    $sql .= "WHERE usuario = '". $username ."'";   //concatenamos la variable $username a la consulta

// Ejecutamos la consulta
    $resultados = $conexion->query($sql); 
    
    $fila = mysqli_fetch_assoc($resultados);  /*
                                               * Obtiene una fila de datos del conjunto de resultados y la devuelve como 
                                               * una matriz asociativa. Cada llamada posterior a esta función devolverá la 
                                               * siguiente fila dentro del conjunto de resultados, o null 
                                               * si no hay más filas.
                                               */
 
    $passwordHash = $fila['password'];     // Tomamos el contenido del atributo password de la tabla usuarios en la fila 
                                           // que nos devuelve mysqli_fetch_assoc($resultados)
    
    $nombre = $fila['nombre'];             // De la misma manera podemos tomar todos los datos de los diferentes atributos
    $email = $fila['email'];               // que devuelve la consulta

   
    
    if(password_verify($password, $passwordHash)){   /* La función password_verify() nos pide como parametros
                                                      * el password que traemos desde el formulario y el hash que  
                                                      * traemos desde la consulta, los verifica y si coinsiden
                                                      * devuelve TRUE, caso contrario FALSE 
                                                      */
         $_SESSION['logueado'] = true;
         $_SESSION['nombre'] = $nombre;               
        header("Location: profile.php");            // Redirigimos hacia la página privada    
    }else{                                            
        $_SESSION['logueado'] = false;
        header("Location: login.html");             // Si falla el logueo redirigimos hacia el login nuevamente
    }
 
?>