<?php 
    //Consulta de bd
    //Paso 1 -> Importar la conexión
    require '../includes/config/database.php';
    $db = conexion(); //instancia a la conexión de la bd


    //Paso 2 -> Escribir el Query
    $query = "SELECT * FROM propiedades";

    //Paso 3 -> Consultar la base de datos 
    $resultadoConsulta = mysqli_query($db, $query);



    //?? null-> si no encuentra un _GET con el valor de resultado le asigna un null
    $resultado = $_GET['resultado'] ?? null;//este get se realiza en 'crear.php' a la hora de que se realice un insert

    //var_dump($resultado);


    //Incluye un template
    require '../includes/funciones.php';//aqui solo se usa ../ porque de esa manera apunda hacia el directorio correcto
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if($resultado == 1): //usamos sintaxis de : ?>
            <p class="alerta exito"> Anuncio Creado Correctamente</p>
        <?php endif;?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>

                <tbody> <!--Paso 4 -> Mostrar los resultados-->
                    
                    <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)): 
                        //mientras haya resultados en la bd va a generar el tr con los table data?>
                        
                        <tr>
                        <td> <?php echo $propiedad['idPropiedades'] ?> </td>
                        <td> <?php echo $propiedad['titulo'] ?> </td>
                        <td><img src="/imagenes/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla"></td>
                        <td>$ <?php echo $propiedad['precio'] ?> </td>
                        <td>
                            <a href="#" class="boton-rojo-block">Eliminar</a>
                            <a href="#" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    
                </tbody>
            </thead>
        </table>
    </main>
    

<?php 
    //Paso 5 -> Cerrar la Conexión
    mysqli_close($db);
    incluirTemplate('footer'); 
?>