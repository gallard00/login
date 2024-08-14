<?php
    /* esta es otra manera de implementar la extensión mysqli, en este caso la 
    *  clase mysqli, la cual al instanciarla nos devolverá un ubjeto con
    * diferentes propiedades y métodos para implementar
    */ 
    
 // defino constantes con los datos de la conexión al servidor mysql y la base de datos a utilizar para el logueo.
    define("HOST_DB", "localhost"); 
    define("USER_DB", "root");
    define("PASS_DB", "123");
    define("NAME_DB", "login");

// defino constantes con los datos de la conexión al servidor mysql y la base de datos a utilizar para los partidos, equipos y tablas de posiciones.
    define("HOST_DataBase", "localhost"); 
    define("USER_DataBase", "root");
    define("PASS_DataBase", "123");
    define("NAME_DataBase", "tabla_posiciones");

 // Aca instanciamos la clase mysqli con los datos definidos anteriormente para el Logueo.
    $conexion = new mysqli(
        constant("HOST_DB"), 
        constant("USER_DB"),
        constant("PASS_DB"),
        constant("NAME_DB")
    );
// Aca instanciamos la clase mysqli con los datos definidos anteriormente lo mismo para partidos, etc.
    $conexion2 = new mysqli(
        constant("HOST_DataBase"), 
        constant("USER_DataBase"),
        constant("PASS_DataBase"),
        constant("NAME_DataBase")
);
 
?>