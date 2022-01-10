<?php

//con __DIR__ se le permite a php definir dónde se encuetran los archivos (ruta)
define('TEMPLATES_URL', __DIR__ . '\templates');
define('FUNCIONES_URL', 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false)
{
    // echo TEMPLATES_URL . "${nombre}.php";
    include TEMPLATES_URL . "/${nombre}.php"; //en este caso deben ser comillas dobles a fuerza
}

function estaAutenticado()
{
    session_start(); //se trae los datos de la session del usuario

    if (!$_SESSION['login']) { //si no está autenticado
        header('Location: /');
    }
}
//Funcntion que se encarga de darle formato a los var_dump 
function debuguear($varaible)
{
    echo "<pre>";
    var_dump($varaible);
    echo "</pre>";
    exit;
}

//Escapa el HTML - IMPORTANTE -> es importante a la hora de imprimir datos ingresados por el usuario sanitizarlos
function sanitizar($html)
{
    $s = htmlspecialchars($html);
    return $s;
}
//Validar tipo de contenido | Al hacer uso de hiden en el html para definir el tipo de registro que se va a eliminar se debe verificar, ya que dentro del html un usuario lo puede cambiar
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje =  'Creado correctamente';
            break;
        case 2:
            $mensaje =  'Actualizado correctamente';
            break;
        case 3:
            $mensaje =  'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
        
    }
    return $mensaje;
}
