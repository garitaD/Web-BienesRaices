<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/funciones.php';
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro

      //Validar la URL por ID valido
      $id = $_GET['id']; // al enviar por medio del enlace el "id" de la propiedad lo podemos obtener de esta manera
      $id = filter_var($id, FILTER_VALIDATE_INT);//sobreescribimos la variable 
      //var_dump($id);

      if(!$id){
          header('Location: /');
      }
      //Conexion a base de datos
      require 'includes/config/database.php';
      $db = conexion();

  
      //Consulta para traer los datos de la propiedad
      $query = "SELECT * FROM propiedades WHERE idPropiedades= ${id}";
      $resultado = mysqli_query($db, $query);

    //   echo "<pre>";
    //   var_dump($resultado);/*dentro de "num_rows" tendremos 1 si la consulta tuvo exito y 0 si no, por lo que podemos usar
    //                         ese obj para validar*/
    //   echo "</pre>";

    if($resultado->num_rows === 0){
        header('Location: /');
    }

    
      $propiedad = mysqli_fetch_assoc($resultado);

?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo'];?></h1>

        <!--Al estar subiendo los archivos al servidor la versión webp de la img no va a estar disponible
        por lo que dejamos solo img-->
        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio" >

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio'];?></p>
            <div class="iconos">
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono-anuncio"src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                        <p><?php echo $propiedad['wc'];?></p>
                    </li>

                    <li>
                        <img class="icono-anuncio" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento"
                            loading="lazy">
                        <p><?php echo $propiedad['estacionamiento'];?></p>
                    </li>

                    <li>
                        <img class="icono-anuncio" src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                        <p><?php echo $propiedad['habitaciones'];?></p>
                    </li>
                </ul>
            </div>

            <p><?php echo $propiedad['descripcion'];?>
            </p>
        </div>
        </div>
    </main>


<?php 
    mysqli_close($db);
    incluirTemplate('footer'); 
?>

    <script src="build/js/bundle.min.js"></script>
</body>

</html>