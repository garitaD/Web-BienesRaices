<?php

//con __DIR__ se le permite a php definir dónde se encuetran los archivos (ruta)
define('TEMPLATES_URL', __DIR__ . '\templates');
define('FUNCIONES_URL', 'funciones.php');

function incluirTemplate( string $nombre, bool $inicio = false ){
   // echo TEMPLATES_URL . "${nombre}.php";
    include TEMPLATES_URL . "/${nombre}.php";//en este caso deben ser comillas dobles a fuerza
}

function estaAutenticado() : bool{
    session_start();//se trae los datos de la session del usuario
    $auth = $_SESSION['login'];
    if($auth){
        return true;
    }
    return false;
}