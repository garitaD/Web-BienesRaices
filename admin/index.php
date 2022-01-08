<?php 
    //Autenticamos al usuario
    require '../includes/app.php';//aqui solo se usa ../ porque de esa manera apunda hacia el directorio correcto

    use App\Propiedad;
    
    estaAutenticado();

    //Implementar un metodo para obtener todas las propiedades utilizando active record
    $propiedades = Propiedad::all();


    //?? null-> si no encuentra un _GET con el valor de resultado le asigna un null
    $resultado = $_GET['resultado'] ?? null;//este get se realiza en 'crear.php' a la hora de que se realice un insert

    //var_dump($resultado);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);//validamos que lo que se ingrese sea unicamente numeros
        
        if($id){
            //Eliminar el archivo 
            $query  = "SELECT imagen FROM propiedades WHERE idPropiedades = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            //var_dump($propiedad);
            unlink('../imagenes/' .$propiedad['imagen']);

            
            //Elimina la propiedad
            $query = "DELETE FROM propiedades WHERE idPropiedades= ${id}";
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('location: /admin?resultado=3');
            }
        }
    }


    //Incluye un template
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <!--Mostramos los anuncios de las acciones-->
        <?php if($resultado == 1): //usamos sintaxis de : ?>
            <p class="alerta exito"> Anuncio Creado Correctamente</p>
        <?php elseif($resultado == 2):?>
            <p class="alerta exito"> Anuncio Actualizado Correctamente</p>
        <?php elseif($resultado == 3):?>
            <p class="alerta exito"> Anuncio Eliminado Correctamente</p>
        <?php endif;?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>

                <tbody> <!--Paso 4 -> Mostrar los resultados-->
                    
                    <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)): 
                        //mientras haya resultados en la bd va a generar el tr con los table data?>
                        
                        <tr>
                        <td> <?php echo $propiedad['idPropiedades'] ?> </td>
                        <td> <?php echo $propiedad['titulo'] ?> </td>
                        <td><img src="/imagenes/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla"></td>
                        <td>$ <?php echo $propiedad['precio'] ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad['idPropiedades']; ?>"> <!--hidden es una atributo que hace que un input no sea visible-->
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            
                            <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['idPropiedades']; ?>" 
                            class="boton-amarillo-block">Actualizar</a> <?php /* gracias a este codigo agregado al enlace obtenedremos el id de
                                                                        cada propieda que se vaya iterando*/?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    
                </tbody>
            </thead>
        </table>
    </main>
    

<?php 
    //Paso 5 -> Cerrar la Conexión
    mysqli_close($db);
    incluirTemplate('footer'); 
?>