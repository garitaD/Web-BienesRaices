<?php 
    //Autenticamos al usuario
    require '../../includes/app.php';

    use App\Propiedad; //importar la clase propiedad

    
    // 
    

    // debuguear($propiedad);
    estaAutenticado();

   
    $db = conexion();

    //COnsultar base de datos para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resuldado = mysqli_query($db, $consulta); //se obtiene los vendedores de la base de datos

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();//arreglo dinamico en el que se irán añadiendo los mensajes de error 
    //debuguear($errores);
    // se inicializan las variables vacias y después se les asigna una valor, valor que estará dentro del atibuto value en input del html
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc ='';
    $estacionamiento = '';
    $idVendedor = '';

    $num1 = "correo@correo.com/";
    $num2 = 1;
    /*
    //Sanitizar
    $resuldado = filter_var($num1, FILTER_SANITIZE_EMAIL);
    //validar
    $resuldado = filter_var($num2, FILTER_VALIDATE_INT);//Valida si es un numero entero, si no pasa retorna el false
    var_dump($resuldado);
    */
    

    
    /*$_SERVER -> Es una super globlal de php que nos permite obtener los datos del servidor,
    como por ejemplo el method que se está enviando, este lo evaluamos y podemos obtener los datos de manera de array*/
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //ejecutar el codigo despues que el usuario envie el formulario

        /*_SERVER-> trae informacion detallada de lo que pasa en el servidor
            _POST-> tree la informacion cuando se envia una petición tipo post en el formulario 
            _FILES-> Permite ver el contenido de los archivos*/
        $propiedad = new Propiedad($_POST); // se crea la nueva instancia de propidad -> en su constructor recibe un arreglo por lo que le podemos pasar post 
        $errores =$propiedad->validar();
        //debuguear($errores);
        
        

        // echo "<pre>";
        // var_dump($_FILES); ->dentro de la super global de files se almacenan las imagenes
        // echo "</pre>";

        //Revisar que el arreglo de errores esté vacío para poder hacer el insert en base de datos

        if(empty($errores)){

            $propiedad->guardar();
        
            //Asignar files hacia una variable
            $imagen = $_FILES['imagen'];
            //var_dump($imagen['name']); // si contiene un nombre quiere decir que se agregó una imagen

            /*SUBIDA DE ARCHIVOS*/
            //Crear Carpeta
            $carpetaImagenes = '../../imagenes/';//crea la carpeta en la raiz del proyecto(importa)
            if(!is_dir($carpetaImagenes)){ //is_dir-> retorna si una carpeta existe o no
                mkdir($carpetaImagenes); //si no existe la carpeta la crea
            }

            //Generar un nombre unico para que las imagenes no se sobreescriban
            $nombreImagen = md5( uniqid( rand(), true) ).".jpg";


            //Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes. $nombreImagen);
           // exit;

            

            $resuldado = mysqli_query($db, $query);

            if($resuldado){
               // echo "Insertado Correctamente";
               //Redireccionar al usuario si se realiza el registro
               header('Location: /admin?resultado=1'); /*esto impide que se ingresen datos duplicados | lo que está despues del ? es el mensaje que 
                                                        va a tener la url (_GET['resultado'])*/

                //header ->solo funciona mientras no haya nada de html previo | Usar la redireccion donde realmente sea conveniete ya que usarla en reiteradas oacciones causa problemas
            }
        }

        
    }
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error){ ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
            
        <?php } ?>

        <!--action-> es hacia dónde se enviaran esos datos del formulario para ser procesada-->
        <!--name=""-> dentro de los input 'name'  es el nombre que se la a la variable que contiene los datos (nos permite leer lo que el usuario escriba)-->
        <!--method="GET"-> expone los datos en la url por lo que se recomienda usarlo en tiendas virtuales donde se requiere el enlace para poder compartirlo por ejemplo -->
        <!--method="POST"-> maneja los datos internamente por lo que se usa en logins o cuando se envian datos o info muy sensible-->
        
        <!--Cuando se quiere subir archivos dentro de un formulario se debe agregar el atributo ""enctype""-->
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:"</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea><!--textarea no tiene un atributo "value" por lo que se ingresa dentro del mismo-->
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</la bel>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejemplo: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

                <label for="wc">Baños:</label>
                <input 
                    type="number" 
                    id="wc" 
                    name="wc" 
                    placeholder="Ejemplo: 3" 
                    min="1" 
                    max="9" v
                    value="<?php echo $wc ?>"
                >

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="idVendedor">
                    <option value="">--Seleccione--</option>
                    
                    <?php while($vendedor = mysqli_fetch_assoc($resuldado)){ /* con fetech assoc podemos acceder a un arreglo de resultados 
                    donde las llaves del array son igual q las columnas de la bd*/ ?>

                            <option <?php echo $idVendedor === $vendedor['idVendedor'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['idVendedor'] ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?></option>
                        
                    <?php }?>

                    <?php 
                        /*echo $idVendedor === $vendedor['idVendedor'] ? 'selected' : ''; -> hacemos uso del operador ternario, 
                        cuando se seleccione lo va a evaluar y si llega a ser igual a lo que se está obteniendo en bd le agrega el 
                        atributo html 'selected' lo que hace que la opción quede seleccionanda en caso de que falten datos de lo contrario pone un string vacío*/
                    
                    ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>
