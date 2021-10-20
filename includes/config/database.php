<?php

function conexion() : mysqli {
    $db = mysqli_connect('localhost', 'root', '1542', 'bienes_raices');

    if(!$db){
        echo 'Error, no se pudo conectar';
        exit; // si no se pudo conecctar se detiene la ejecución del código
    }
    return $db;
}