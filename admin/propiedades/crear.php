<?php 
    //Autenticamos al usuario
    require '../../includes/app.php';

    use App\Propiedad; //importar la clase propiedad
    use Intervention\Image\ImageManagerStatic as Image;
    
    // debuguear($propiedad);
    estaAutenticado();

   
    $db = conexion();


    $propiedad = new Propiedad;

    //COnsultar base de datos para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resuldado = mysqli_query($db, $consulta); //se obtiene los vendedores de la base de datos

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();//arreglo dinamico en el que se irán añadiendo los mensajes de error 
 
    
    /*$_SERVER -> Es una super globlal de php que nos permite obtener los datos del servidor,
    como por ejemplo el method que se está enviando, este lo evaluamos y podemos obtener los datos de manera de array*/

    /*_SERVER-> trae informacion detallada de lo que pasa en el servidor
        _POST-> tree la informacion cuando se envia una petición tipo post en el formulario 
        _FILES-> Permite ver el contenido de los archivos, dentro de esta super global se almacenan los archivos*/
    

    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //ejecutar el codigo despues que el usuario envie el formulario

        $propiedad = new Propiedad($_POST); // se crea la nueva instancia de propidad -> en su constructor recibe un arreglo por lo que le podemos pasar post 

        /*SUBIDA DE ARCHIVOS*/
        

        //Generar un nombre unico para que las imagenes no se sobreescriban
        $nombreImagen = md5( uniqid( rand(), true) ).".jpg";

        //Setear la imagen
        //Realiza un resize a la imagen con intervation
        if($_FILES['imagen']['tmp_name']){//si existe la img dentreo de FILES la setea 
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);


        }
        
        //Validar
        $errores =$propiedad->validar();

        //Revisar que el arreglo de errores esté vacío para poder hacer el insert en base de datos

        if(empty($errores)){

            $propiedad->guardar();

            //Crear Carpeta
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
        
            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES. $nombreImagen);

            //Guarda en la base de datos
            $resultado = $propiedad->guardar();


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

        <?php include '../../includes/templates/formulario_propiedades.php'?>
            

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>
