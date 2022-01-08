<?php 
    //Autenticamos al usuario
//se importa la clase para poder hacer uso de los metodos
use App\Propiedad;

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
    $errores = [];//arreglo dinamico en el que se irán añadiendo los mensajes de error 
  


    
    /*$_SERVER -> Es una super globlal de php que nos permite obtener los datos del servidor,
    como por ejemplo el method que se está enviando, este lo evaluamos y podemos obtener los datos de manera de array*/
    /*_SERVER-> trae informacion detallada de lo que pasa en el servidor
        _POST-> tree a informacion cuando se envia una petición tipo post en el formulario 
        _FILES-> Permite ver el contenido de los archivos*/
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //ejecutar el codigo despues que el usuario envie el formulario
        //debuguear($_POST);

        //Asignar los atributos
        $args =$_POST['propiedad'];//esto es posible gracias a dentro del name del formulario de agregó que fuera un aray
        $propiedad->sincronizar($args);
        debuguear($propiedad);

       
        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];
        //var_dump($imagen['name']); // si contiene un nombre quiere decir que se agregó una imagen
     

        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }
        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }
        if( strlen($descripcion) <60){
            $errores[] = "La descripcion es obligatoria y debe tener al menos 60 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc){
            $errores[] = "El número de Baños es obligatorio";
        }
        if(!$estacionamiento){
            $errores[] = "El número de espacios de Estacionamiento es obligatorio";
        }
        if(!$idVendedor){
            $errores[] = "Vendedor no elegido";
        }

        //Validar por tamaño (100kb máximo)
        $medida = 1000 * 1000; //para pasar se bytes a kilobytes
        if($imagen['size'] > $medida){
            $errores[] = "La imagen supera el tamaño maximo permitido";   
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";
        
        //Revisar que el arreglo de errores esté vacío para poder hacer el insert en base de datos

        if(empty($errores)){
            
            //Crear Carpeta
            $carpetaImagenes = '../../imagenes/';//crea la carpeta en la raiz del proyecto(importa)

            if(!is_dir($carpetaImagenes)){ //is_dir-> retorna si una carpeta existe o no
                mkdir($carpetaImagenes); //si no existe la carpeta la crea
            }
            $nombreImagen = '';//se declara la variable en este punto para asignarle un nombre segun el condicional

            /*SUBIDA DE ARCHIVOS*/
            //ese condicional elimina la imagen previa en caso que se suba una nueva y mantiene la inicial en caso que no se modifique
            if($imagen['name']){
                //Eliminar imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);//eliminar un archivo, toma como valor el arvhivo a eliminar
                //Generar un nombre unico para que las imagenes no se sobreescriban
                $nombreImagen = md5( uniqid( rand(), true) )."jpg";

                //Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes. $nombreImagen);
            }else{
                $nombreImagen= $propiedad['imagen'];
            }
            //exit;
    
            //Actualizar en la base de datos | Es importante respetar esta sintaxis en cuantos a las comullas dobles y sencillas, las '' indican que son string
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen ='${nombreImagen}', descripcion = '${descripcion}', habitaciones = '${habitaciones}', 
                    wc = '${wc}', estacionamiento = '${estacionamiento}', titulo = '${titulo}', idVendedor = '${idVendedor}' WHERE idPropiedades = ${id}"; //este ultimo id es que tenemos arriba

            // echo $query; //->para validar que la sintaxis y pobrarlo dentro de workbench
            // exit;

            $resultado = mysqli_query($db, $query);

            if($resultado){
               // echo "Insertado Correctamente";
               //Redireccionar al usuario si se realiza el registro
               header('Location: /admin?resultado=2'); /*esto impide que se ingresen datos duplicados | lo que está despues del ? es el mensaje que 
                                                        va a tener la url (_GET['resultado'])*/

                //header ->solo funciona mientras no haya nada de html previo | Usar la redireccion donde realmente sea conveniete ya que usarla en reiteradas oacciones causa problemas
            }
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
