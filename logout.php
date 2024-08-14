<?php
    session_start(); /*
                      * session_start() crea una sesión o reanuda la actual basada en un identificador 
                      * de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
                      */
    unset($_SESSION['logueado']);   // con la función unset() damos de baja la sesion 
    header("Location: index.php");
?>