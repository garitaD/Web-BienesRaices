<?php

require 'app.php';//para poder hacer uso de la constante TEMPLATES_URL 

function incluirTemplate( string $nombre, bool $inicio = false ){
   // echo TEMPLATES_URL . "${nombre}.php";
    include TEMPLATES_URL . "/${nombre}.php";//en este caso deben ser comillas dobles a fuerza
}