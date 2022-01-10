<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/app.php';
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion seccion-nosotros">
        <h2>Conozca Sobre Nosotros</h2>
        <div class="contenido-seccion">
            
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Entrada nosotros" loading="lazy">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote><!--etiqueta usada cuando se está citando-->
                    25 Años de Experiencia
                </blockquote>
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
    <section class="contenedor seccion">
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


    </section>


<?php 
    incluirTemplate('footer'); 
?>

    <script src="build/js/bundle.min.js"></script>
</body>

</html>