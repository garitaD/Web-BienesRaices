<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/funciones.php';
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>
        <picture>
            <source src="build/img/destacada2.webp" type="image/webp">
            <source src="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen De la Propiedad">
        </picture>
        <p class="informacion-meta">Escrito el: <span>12/10/2021</span> por: <span>Admin</span></p>

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