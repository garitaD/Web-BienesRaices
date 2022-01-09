<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:"</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo sanitizar($propiedad->titulo) ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizar($propiedad->precio) ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->imagen):?>
        <img src="/imagenes/<?php echo $propiedad->imagen?>" class="imagen-peq">
    <?php endif?>

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion) ?></textarea>
    <!--textarea no tiene un atributo "value" por lo que se ingresa dentro del mismo-->
</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>
    <!--dentro del value se incluye un echo al objeto de propiedad, de esta manera se autocompleta en caso de que el obj tenga valores-->

    <label for="habitaciones">Habitaciones:</la bel>
        <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ejemplo: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->habitaciones) ?>">

        <label for="wc">Baños:</label>
        <input type="number" id="wc" name="propiedad[wc]" placeholder="Ejemplo: 3" min="1" max="9" v value="<?php echo sanitizar($propiedad->wc) ?>">

        <label for="estacionamiento">Estacionamiento:</label>
        <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ejemplo: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->estacionamiento) ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[idVendedor]" id="vendedor">
        <option selected value="">--Seleccione--</option>
        <?php foreach($vendedores as $vendedor):?>
            <option
             
                <?php echo $propiedad->idVendedor === $vendedor->id ? 'selected' : '';?>
                value="<?php echo sanitizar($vendedor->idVendedor);?>">
                <?php echo sanitizar($vendedor->nombre . " " . sanitizar($vendedor->apellido));?>
                <!-- $propiedad es una instancia del objeto que se crea en crear.php -->

            </option>
        <?php endforeach?>
    </select>

    
    

    <!-- <select name="idVendedor">
        <option value="">--Seleccione--</option>

        /*echo $idVendedor === $vendedor['idVendedor'] ? 'selected' : ''; -> hacemos uso del operador ternario, 
                        cuando se seleccione lo va a evaluar y si llega a ser igual a lo que se está obteniendo en bd le agrega el 
                        atributo html 'selected' lo que hace que la opción quede seleccionanda en caso de que falten datos de lo contrario pone un string vacío*/

        ?>
    </select> -->
</fieldset>