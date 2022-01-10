<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="titulo" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo sanitizar($vendedor->nombre) ?>">

    <label for="nombre">Apellido:</label>
    <input type="text" id="titulo" name="vendedor[apellido]" placeholder="Apellido Vendedor" value="<?php echo sanitizar($vendedor->apellido) ?>">

    <label for="telefono">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor" value="<?php echo sanitizar($vendedor->telefono) ?>">


</fieldset>