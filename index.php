<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/app.php';
    //si da un error relacionado a la clase puede que sea la version, en ese caso aplicar el comando composer dumpautoload 
    
    incluirTemplate('header', $inicio = true);// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="icono-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat ab magni praesentium in officia
                    harum mollitia reprehenderit consequatur iste modi, dolore recusandae exercitationem? Atque omnis
                    consequatur laudantium nemo libero illum.</p>
            </div>
            <!--.icono-->

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat ab magni praesentium in officia
                    harum mollitia reprehenderit consequatur iste modi, dolore recusandae exercitationem? Atque omnis
                    consequatur laudantium nemo libero illum.</p>
            </div>
            <!--.icono-->

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat ab magni praesentium in officia
                    harum mollitia reprehenderit consequatur iste modi, dolore recusandae exercitationem? Atque omnis
                    consequatur laudantium nemo libero illum.</p>
            </div>
            <!--.icono-->

        </div>


    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>

        <?php 
            $limite = 3;//esta variable se pasa al include y determina la cantidad de anuncios que se muestran en la pagina
            include 'includes/templates/anuncios.php'
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <!--El section es utilizado cuando se tiene un heading que introduce a una nueva seccion-->
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <!--El section es utilizado cuando se tiene un heading que introduce a una nueva seccion-->
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <!--Cada entrada de blog siempre debe estar dentro de un article-->
                <!--queremos que la imagen y el texto se acomode en dos columnas-->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img src="build/img/blog1.jpg" alt="Entrada blog" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>12/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Consejos para construir una terreaza en el techo de tu casa con los mejores
                            materiales y ahorrando dinero.
                        </p>
                    </a>
                </div>

            </article>

            <article class="entrada-blog">
                <!--Cada entrada de blog siempre debe estar dentro de un article-->
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img src="build/img/blog2.jpg" alt="Entrada blog" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>12/10/2021</span> por: <span>Admin</span></p>
                        <p>
                            Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores
                            para darle vida a tu espacio.
                        </p>
                    </a>
                </div>

            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena antención y la casa que me
                    ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>-Daniel Garita</p>
            </div>
        </section>
    </div>
<?php 
    incluirTemplate('footer'); 
?>
    
    <script src="build/js/bundle.min.js"></script>
</body>

</html>