<?php 
    //Conexion a base de datos
    require '../../includes/config/database.php';
    $db = conexion();

    /*$_SERVER -> Es una super globlal de php que nos permite obtener los datos del servidor,
    como por ejemplo el method que se está enviando, este lo evaluamos y podemos obtener los datos de manera de array*/
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        //leemos lo que el usuario ha escrito en el formulario y lo guardamos en variables para poder validarlo
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $idVendedor = $_POST['vendedor'];

        //Insertar en la base de datos | Es importante respetar esta sintaxis en cuantos a las comullas dobles y sencillas
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, idVendedor) 
        VALUES( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$idVendedor')" ;

        //echo $query; ->para validar que la sintaxis y pobrarlo dentro de workbench

        $resuldado = mysqli_query($db, $query);

        if($resuldado){
            echo "Insertado Correctamente";

        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <!--action-> es hacia dónde se enviaran esos datos del formulario para ser procesada-->
        <!--name=""-> dentro de los input 'name'  es el nombre que se la a la variable que contiene los datos (nos permite leer lo que el usuario escriba)-->
        <!--method="GET"-> expone los datos en la url por lo que se recomienda usarlo en tiendas virtuales donde se requiere el enlace para poder compartirlo por ejemplo -->
        <!--method="POST"-> maneja los datos internamente por lo que se usa en logins o cuando se envian datos o info muy sensible-->
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:"</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejemplo: 3" min="1" max="9">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ejemplo: 3" min="1" max="9">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo: 3" min="1" max="9">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="1">Daniel</option>
                    <option value="2">Andres</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>
