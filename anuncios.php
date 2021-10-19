<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/funciones.php';
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Anuncios</h1>
        <h2>Casas y Departamentos en Venta</h2>

        <div class="contenedor-anuncios">

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio1.webp" type="image/webp">
                    <!--En caso de que el navegador soporte webp cargará está igual, de lo contrario pasará a la siguiente por lo que el orden es muy importante-->
                    <source srcset="build/img/anuncio1.jpg" type="image/jpeg">
                    <img src="build/img/anuncio1.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa de Lujo en el Lago</h3>
                    <p>Casa en el lago con excelente vista, acabados de lujo y un precio excelente</p>
                    <p class="precio">$3,000,000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                            <p>3</p>
                        </li>

                        <li>
                            <img class="icono-anuncio" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                            <p>3</p>
                        </li>

                        <li>
                            <img class="icono-anuncio" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                            <p>4</p>
                        </li>
                    </ul>

                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div>
                <!--contenido-anuncio-->
            </div>
            <!--anuncio-->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio2.webp" type="image/webp">
                    <!--En caso de que el navegador soporte webp cargará está igual, de lo contrario pasará a la siguiente por lo que el orden es muy importante-->
                    <source srcset="build/img/anuncio2.jpg" type="image/jpeg">
                    <img src="build/img/anuncio2.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa terminados de lujo</h3>
                    <p>Casa con diseño moderno, así como tecnología inteligente y amueblada</p>
                    <p class="precio">$2,000,000</p>

                    <div class="iconos">
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
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


                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div>
                <!--contenido-anuncio-->
            </div>
            <!--anuncio-->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio3.webp" type="image/webp">
                    <!--En caso de que el navegador soporte webp cargará está igual, de lo contrario pasará a la siguiente por lo que el orden es muy importante-->
                    <source srcset="build/img/anuncio3.jpg" type="image/jpeg">
                    <img src="build/img/anuncio3.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa con Piscina</h3>
                    <p>Casa con Piscina y acabados de lujo en la ciudad, una exclente oportuinidad</p>
                    <p class="precio">$3,000,000</p>

                    <div class="iconos">
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div> <!--contenido-anuncio-->
            </div> <!--anuncio-->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio4.webp" type="image/webp">
                    <!--En caso de que el navegador soporte webp cargará está igual, de lo contrario pasará a la siguiente por lo que el orden es muy importante-->
                    <source srcset="build/img/anuncio4.jpg" type="image/jpeg">
                    <img src="build/img/anuncio4.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa con Piscina</h3>
                    <p>Casa con Piscina y acabados de lujo en la ciudad, una exclente oportuinidad</p>
                    <p class="precio">$3,000,000</p>

                    <div class="iconos">
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div> <!--contenido-anuncio-->
            </div> <!--anuncio-->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio5.webp" type="image/webp">
                    <!--En caso de que el navegador soporte webp cargará está igual, de lo contrario pasará a la siguiente por lo que el orden es muy importante-->
                    <source srcset="build/img/anuncio5.jpg" type="image/jpeg">
                    <img src="build/img/anuncio5.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa con Piscina</h3>
                    <p>Casa con Piscina y acabados de lujo en la ciudad, una exclente oportuinidad</p>
                    <p class="precio">$3,000,000</p>

                    <div class="iconos">
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div> <!--contenido-anuncio-->
            </div> <!--anuncio-->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio6.webp" type="image/webp">
                    <!--En caso de que el navegador soporte webp cargará está igual, de lo contrario pasará a la siguiente por lo que el orden es muy importante-->
                    <source srcset="build/img/anuncio6.jpg" type="image/jpeg">
                    <img src="build/img/anuncio6.jpg" alt="anuncio" loading="lazy">
                </picture>

                <div class="contenido-anuncio">
                    <h3>Casa con Piscina</h3>
                    <p>Casa con Piscina y acabados de lujo en la ciudad, una exclente oportuinidad</p>
                    <p class="precio">$3,000,000</p>

                    <div class="iconos">
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img class="icono-anuncio" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div> <!--contenido-anuncio-->
            </div> <!--anuncio-->

        </div><!--contenedor-anuncios-->
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>