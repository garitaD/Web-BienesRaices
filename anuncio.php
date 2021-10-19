<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/funciones.php';
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>
        <picture>
            <source src="build/img/destacada.webp" type="image/webp">
            <source src="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen De la Propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000 </p>
            <div class="iconos">
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono-anuncio"src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                        <p>3</p>
                    </li>

                    <li>
                        <img class="icono-anuncio" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento"
                            loading="lazy">
                        <p>3</p>
                    </li>

                    <li>
                        <img class="icono-anuncio" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                        <p>4</p>
                    </li>
                </ul>
            </div>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure adipisci tempore, ab maiores natus sit,
                quisquam sunt distinctio odit, velit qui non! Id similique ullam accusamus deserunt blanditiis ut
                aliquam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, ad illum magni excepturi ipsam
                eligendi sunt minima architecto atque harum voluptate sequi, amet ipsa, aspernatur facere quisquam
                accusantium nostrum hic.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure adipisci tempore, ab maiores natus sit,
                quisquam sunt distinctio odit, velit qui non! Id similique ullam accusamus deserunt blanditiis ut
                aliquam?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, ad illum magni excepturi ipsam
                eligendi sunt minima architecto atque harum voluptate sequi, amet ipsa, aspernatur facere quisquam
                accusantium nostrum hic 
            </p>
        </div>
        </div>
    </main>


<?php 
    incluirTemplate('footer'); 
?>

    <script src="build/js/bundle.min.js"></script>
</body>

</html>