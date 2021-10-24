<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/funciones.php';
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Anuncios</h1>
        <h2>Casas y Departamentos en Venta</h2>

        <?php 
            $limite = 10;//esta variable se pasa al include y determina la cantidad de anuncios que se muestran en la pagina
            include 'includes/templates/anuncios.php'
        ?>

    </main>
    

<?php 
    incluirTemplate('footer'); 
?>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>