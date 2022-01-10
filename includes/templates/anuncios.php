<?php
    use App\Propiedad;
    
    //debuguear($_SERVER);

    //De esta manera podemos saber en qué página está el usuario y de esta manera hacer la consulta para que traiga todos o cierta cantidad de resultados
    if($_SERVER['SCRIPT_NAME'] === '/anuncios.php'){
        $propiedades = Propiedad::all();//se trae todas las propiedades
    }else{
        $propiedades = Propiedad::get(3);//se trae solo 3 registros
    }

?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad):
        //guardamos en propiedad el arreglo de resultados
        //Se generará un anuncio por cada resultado o iteración 
    ?>
    <div class="anuncio">

        <!--Al estar subiendo los archivos al servidor la versión webp de la img no va a estar disponible
        por lo que dejamos solo img-->
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen;?>" alt="anuncio" >
       

        <div class="contenido-anuncio">
            <h3> <?php echo $propiedad->titulo;?> </h3>
            <p><?php echo $propiedad->descripcion;?></p>
            <p class="precio">$ <?php echo $propiedad->precio;?></p>

            <div class="iconos">
                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" >
                        <p><?php echo $propiedad->wc;?></p>
                    </li>

                    <li>
                        <img loading="lazy" class="icono-anuncio" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" >
                        <p><?php echo $propiedad->estacionamiento;?></p>
                    </li>

                    <li>
                        <img loading="lazy" class="icono-anuncio" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" >
                        <p><?php echo $propiedad->habitaciones;?></p>
                    </li>
                </ul>

            </div>
            <a href="anuncio.php?id=<?php echo $propiedad->id;?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div><!--contenido-anuncio-->
    </div><!--anuncio-->
    <?php endforeach;?>
</div><!--contenedor-anuncios-->

