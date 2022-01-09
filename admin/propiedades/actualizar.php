<?php 
    //Autenticamos al usuario
//se importa la clase para poder hacer uso de los metodos

use App\Propiedad; //importar la clase propiedad
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';
    estaAutenticado();

    
    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";

    //Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);//sobreescribimos la variable 

    if(!$id){
        header('Location/admin');
    }

    //Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);
    //debuguear($propiedad);
    
    //podedemos sobreescribir las variables ya que dentro de 'propiedad' guardamos el dato de la consulta que se requiere para llenar los campos

    //COnsultar base de datos para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta); //se obtiene los vendedores de la base de datos

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();//arreglo dinamico en el que se irán añadiendo los mensajes de error 
    
  
     /*$_SERVER -> Es una super globlal de php que nos permite obtener los datos del servidor,
    como por ejemplo el method que se está enviando, este lo evaluamos y podemos obtener los datos de manera de array*/
    /*_SERVER-> trae informacion detallada de lo que pasa en el servidor
        _POST-> tree a informacion cuando se envia una petición tipo post en el formulario 
        _FILES-> Permite ver el contenido de los archivos*/
        
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //ejecutar el codigo despues que el usuario envie el formulario
        //debuguear($_POST);
        //debuguear($_FILES['propiedad']);

        //Asignar los atributos
        $args =$_POST['propiedad'];//esto es posible gracias a dentro del name del formulario de agregó que fuera un aray
        $propiedad->sincronizar($args);
        //debuguear($propiedad);

        //Validacion
        $errores = $propiedad->validar();

        //Generar un nombre unico para que las imagenes no se sobreescriban
        $nombreImagen = md5( uniqid( rand(), true) ).".jpg";

        
        
        //debuguear($_FILES['propiedad']);
        //debuguear($nombreImagen);
        //Subida de archivos
        if($_FILES['propiedad']['tmp_name']['imagen']){//si existe la img dentreo de FILES la setea 
            
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
       // debuguear($propiedad);

        //

     
        
        //Revisar que el arreglo de errores esté vacío para poder hacer el insert en base de datos

        if(empty($errores)){
            //Amacenar la imagen 
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            $resultado=$propiedad->guardar();
               
        }
    }

    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

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
        
        <!--Cuando se quiere subir archivos dentro de un formulario se debe agregar el atributo ""enctype""
            en este caso quitamos el atributo "action" para que redireccione a las misma pag respetando la url que tiene el id-->
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'?>

           
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>
