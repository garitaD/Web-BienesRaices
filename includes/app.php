<?php
require 'funciones.php';//funciones viene a ser el arch principal que manda a llamar funciones y clases
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php' ;

use App\Propiedad;
Intervention\Image\ImageServiceProvider::class;

//Conectarnos a la base de datos
$db = conexion();

Propiedad::setDB($db); //De esta manera todos los objs de la clase Propiedad van a tener la referencia a la base de datos


?>
