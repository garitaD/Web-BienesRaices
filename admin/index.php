<?php 
    //Autenticamos al usuario
    require '../includes/app.php';//aqui solo se usa ../ porque de esa manera apunda hacia el directorio correcto

    use App\Propiedad;
    use App\Vendedor;
    
    estaAutenticado();

    //Implementar un metodo para obtener todas las propiedades utilizando active record
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    //debuguear($vendedores);


    //?? null-> si no encuentra un _GET con el valor de resultado le asigna un null
    $resultado = $_GET['resultado'] ?? null;//este get se realiza en 'crear.php' a la hora de que se realice un insert

    //var_dump($resultado);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //debuguear($_POST);


        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);//validamos que lo que se ingrese sea unicamente numeros
        
        if($id){

            $tipo = $_POST['tipo'];
            
            if(validarTipoContenido($tipo)){
                
                //Compara lo que vamos a eliminar
                if($tipo === 'vendedor'){
                    $vendedor = Vendedor::find($id);
                    //debuguear($vendedor);
                    $vendedor -> eliminar();


                }else if($tipo === 'propiedad'){
                    $propiedad = Propiedad::find($id);
                    //debuguear($propiedad);

                    $propiedad -> eliminar();


                }
            }
            
            

            
            

            
        }
    }


    //Incluye un template
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <!--Mostramos los anuncios de las acciones-->
        
        <?php
            $mensaje = mostarNotificacion(intval($resultado));
            if($mensaje): ?>
                <p class="alerta exito"> <?php echo sanitizar($mensaje);?> </p>
            <?php endif?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

        <h2>Propiedades</h2>

        <table class="propiedades">
            <thead>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>

                <tbody> <!--Paso 4 -> Mostrar los resultados-->
                    
                    <?php  foreach($propiedades as $propiedad): 
                        //mientras haya resultados en la bd va a generar el tr con los table data?>
                        
                    <tr>
                        <td> <?php echo $propiedad->id ?> </td>
                        <td> <?php echo $propiedad->titulo ?> </td>
                        <td><img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"></td>
                        <td>$ <?php echo $propiedad->precio ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>"> 
                                <input type="hidden" name="tipo" value="propiedad"> 
                                <!--hidden es una atributo que hace que un input no sea visible-->
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            
                            <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" 
                            class="boton-amarillo-block">Actualizar</a> <?php /* gracias a este codigo agregado al enlace obtenedremos el id de
                                                                        cada propieda que se vaya iterando*/?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </thead>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>

                <tbody> <!--Paso 4 -> Mostrar los resultados-->
                    
                    <?php  foreach($vendedores as $vendedor): 
                        //mientras haya resultados en la bd va a generar el tr con los table data?>
                        
                    <tr>
                        <td> <?php echo $vendedor->id ?> </td>
                        <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido?> </td>
                        <td><?php echo $vendedor->telefono ?> </td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>"> 
                                <input type="hidden" name="tipo" value="vendedor"> 
                                <!--hidden es una atributo que hace que un input no sea visible-->
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            
                            <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" 
                            class="boton-amarillo-block">Actualizar</a> <?php /* gracias a este codigo agregado al enlace obtenedremos el id de
                                                                        cada propieda que se vaya iterando*/?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </thead>
        </table>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>