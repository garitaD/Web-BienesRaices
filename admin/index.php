<?php 
    require '../includes/funciones.php';//aqui solo se usa ../ porque de esa manera apunda hacia el directorio correcto
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>