<?php 
    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";

    //Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);//sobreescribimos la variable 

    if(!$id){
        header('Location/admin');
    }
    //Conexion a base de datos
    require '../../includes/config/database.php';
    $db = conexion();

    //Consulta para traer los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE idPropiedades= ${id}";
    $resultadoPropiedad = mysqli_query($db, $consulta);
    //echo  $resultado;
    
    $propiedad = mysqli_fetch_assoc($resultadoPropiedad);
    //podedemos sobreescribir las variables ya que dentro de 'propiedad' guardamos el dato de la consulta que se requiere para llenar los campos

    //COnsultar base de datos para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta); //se obtiene los vendedores de la base de datos

    //Arreglo con mensajes de errores
    $errores = [];//arreglo dinamico en el que se irán añadiendo los mensajes de error 
    
    //A diferencia del create aquí iniciamos las variables con los valores que obtenemos de la base de datos
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc =$propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $idVendedor = $propiedad['idVendedor'];
    $imagenPropiedad =$propiedad['imagen'];

    $num1 = "correo@correo.com/";
    $num2 = 1;
    /*
    //Sanitizar
    $resultado = filter_var($num1, FILTER_SANITIZE_EMAIL);
    //validar
    $resultado = filter_var($num2, FILTER_VALIDATE_INT);//Valida si es un numero entero, si no pasa retorna el false
    var_dump($resultado);
    */
    

    
    /*$_SERVER -> Es una super globlal de php que nos permite obtener los datos del servidor,
    como por ejemplo el method que se está enviando, este lo evaluamos y podemos obtener los datos de manera de array*/
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //ejecutar el codigo despues que el usuario envie el formulario

        /*_SERVER-> trae informacion detallada de lo que pasa en el servidor
            _POST-> tree la informacion cuando se envia una petición tipo post en el formulario 
            _FILES-> Permite ver el contenido de los archivos*/
            
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        // exit;
        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

        //leemos lo que el usuario ha escrito en el formulario y lo guardamos en variables para poder validarlo
        $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string( $db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento'] );
        $idVendedor = mysqli_real_escape_string( $db, $_POST['vendedor'] );
        $creado = date('Y/m/d');

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

    require '../../includes/funciones.php';
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
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:"</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                <img src="/imagenes/<?php echo $imagenPropiedad?>" alt="Imagen de la propiedad" class="imagen-peq">

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
                    value="<?php echo $wc ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">--Seleccione--</option>
                    
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)){ /* con fetech assoc podemos acceder a un arreglo de resultados 
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

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

        </form>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>
