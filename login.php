<?php
    require 'includes/config/database.php';
    $db = conexion();

    $errores = [];

    //Autenticar al usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){//el codigo se ejecuta una vez se envia el formulario
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL));//Retorna si es un email válido
        $password =mysqli_real_escape_string($db, filter_var($_POST['password'] , FILTER_VALIDATE_EMAIL));
        
        if(!$email){
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$password){
            $errores[] = "El Password es obligatorio";
        }
        echo "<pre>";
        var_dump($errores);
        echo "</pre>";
    }

    //Incluye el header
    require 'includes/funciones.php';
    incluirTemplate('header'); // se llama a la funcion que agrega el template con el nombre del template como parametro
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error"> 
                <?php echo $error?>
            </div>
         <?php endforeach; ?>
        <!--name=""-> dentro de los input 'name'  es el nombre que se la a la variable que contiene los datos (nos permite leer lo que el usuario escriba)-->
        <!--method="GET"-> expone los datos en la url por lo que se recomienda usarlo en tiendas virtuales donde se requiere el enlace para poder compartirlo por ejemplo -->
        <!--method="POST"-> maneja los datos internamente por lo que se usa en logins o cuando se envian datos o info muy sensible-->
    <form class="formulario" method="POST">
        <fieldset>
            <!--Cuando se agrupan una serie de datos relacionados-->

            <legend>Email y Password</legend>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Tu email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Tu Password">
            <!--type email hace que en un disp movil el @ se encuentre en el teclado-->
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>


<?php
incluirTemplate('footer');
?>