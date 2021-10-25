<?php
//En produccion este archivo debe ser eliminado
    // Importar la conexión 
    require 'includes/config/database.php';
    $db = conexion();

    //Crear un email y password
    $email= "mail@mail.com";
    $password = "admin";
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);


    //Escribir el Query para crear el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}' );";
    //echo $query;

    //Agregarlo a la base de datos
    mysqli_query($db, $query);
?> 