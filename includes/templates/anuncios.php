<?php
    /*Paso 1 -> Importar la conexión ->Al ser una ruta que incluye en otros archivos (index y anuncios en la raiz del proyecto)
    la ruta debe ser relativa a esos archivos o relativa desde el archivo en el que estamos, para eso hacemos uso de __DIR__*/
    require __DIR__ .'/../config/database.php';
    $db = conexion();

    //Paso 2 -> Escribir el Query
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    //Paso 3 -> Consultar la base de datos
    $resultado = mysqli_query($db, $query);


?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)):
        //guardamos en propiedad el arreglo de resultados
        //Se generará un anuncio por cada resultado o iteración 
    ?>
    <div class="anuncio">

        <!--Al estar subiendo los archivos al servidor la versión webp de la img no va a estar disponible
        por lo que dejamos solo img-->
        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio" >
       

        <div class="contenido-anuncio">
            <h3> <?php echo $propiedad['titulo'];?> </h3>
            <p><?php echo $propiedad['descripcion'];?></p>
            <p class="precio">$ <?php echo $propiedad['precio'];?></p>

            <div class="iconos">
                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" >
                        <p><?php echo $propiedad['wc'];?></p>
                    </li>

                    <li>
                        <img loading="lazy" class="icono-anuncio" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" >
                        <p><?php echo $propiedad['estacionamiento'];?></p>
                    </li>

                    <li>
                        <img loading="lazy" class="icono-anuncio" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" >
                        <p><?php echo $propiedad['habitaciones'];?></p>
                    </li>
                </ul>

            </div>
            <a href="anuncios.php" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div><!--contenido-anuncio-->
    </div><!--anuncio-->
    <?php endwhile;?>
</div><!--contenedor-anuncios-->

<?php 
    //Cerrar la conexión
    mysqli_close($db);
?>