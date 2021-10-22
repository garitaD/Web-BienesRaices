<?php 
    //?? null-> si no encuentra un _GET con el valor de resultado le asigna un null
    $resultado = $_GET['resultado'] ?? null;//este get se realiza en 'crear.php' a la hora de que se realice un insert

    //var_dump($resultado);

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

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Casa en la playa</td>
                        <td><img src="/imagenes/3f6a6293a519525cda98687c1a65213ejpg" class="imagen-tabla"></td>
                        <td>$20000000</td>
                        <td>
                            <a href="#" class="boton-rojo-block">Eliminar</a>
                            <a href="#" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                </tbody>
            </thead>
        </table>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>