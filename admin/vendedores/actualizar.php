<?php
//Autenticamos al usuario
require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();

//Validar que se in ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

//Obtener el arreglo del vendedor desde la base de datos
$vendedor = Vendedor::find($id);

//debuguear($vendedor);


//Arreglo con mensajes de errores
$errores = Vendedor::getErrores(); //arreglo dinamico en el que se irán añadiendo los mensajes de error 


if ($_SERVER['REQUEST_METHOD'] === 'POST') { //ejecutar el codigo despues que el usuario envie el formulario

    //Asignar los valores
    $args = $_POST['vendedor'];

    //Sincronizar objeto en memoria con lo que el usuario escribio
    $vendedor->sincronizar($args);
    //debuguear($vendedor);

    //Validacion
    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }
}

incluirTemplate('header');


?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <!--action-> es hacia dónde se enviaran esos datos del formulario para ser procesada-->
    <!--name=""-> dentro de los input 'name'  es el nombre que se la a la variable que contiene los datos (nos permite leer lo que el usuario escriba)-->
    <!--method="GET"-> expone los datos en la url por lo que se recomienda usarlo en tiendas virtuales donde se requiere el enlace para poder compartirlo por ejemplo -->
    <!--method="POST"-> maneja los datos internamente por lo que se usa en logins o cuando se envian datos o info muy sensible-->

    <!--Cuando se quiere subir archivos dentro de un formulario se debe agregar el atributo ""enctype""-->
    <form class="formulario" method="POST" >

        <?php include '../../includes/templates/formulario_vendedores.php' ?>


        <input type="submit" value="Guardar Cambios" class="boton boton-verde">

    </form>
</main>


<?php
incluirTemplate('footer');
?>