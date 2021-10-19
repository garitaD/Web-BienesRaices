<?php 
    /* include sirve bien para templates y requiere se usa para codigo más complejo como funciones (en caso 
    de que no lo pueda cargar va a ser un error) */
    require 'includes/funciones.php';
    
    incluirTemplate('header');// se llama a la funcion que agrega el template con el nombre del template como parametro
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>
        <h2>Llene el fromulario del Contacto</h2>

        <form class="formulario"><!--Todos los formularios van dentro de un form-->

            <fieldset><!--Cuando se agrupan una serie de datos relacionados-->

                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu Nombre">

                <label for="email">E-mail</label> 
                <input type="email" id="email" placeholder="Tu Email"><!--type email hace que en un disp movil el @ se encuentre en el teclado-->
                 
                <label for="telefono">Telefono</label>
                <input type="trl" id="telefono" placeholder="Tu Telefono"><!--type tel hace que en un disp movil se muestre el teclado numerico-->
            
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" ></textarea>
            </fieldset>

            <fieldset><!--Cuando se agrupan una serie de datos relacionados-->

                <legend>Informacion sobre la Propiedad</legend>

                <label for="opciones">Vende o Compra</label>

                <select name="" id="opciones">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option><!--value es el valor que se manda al servidor-->
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto">

            </fieldset>

            <fieldset><!--Cuando se agrupan una serie de datos relacionados-->

                <legend>Informacion sobre la Propiedad</legend>
                <p>Cómo deser ser Contactado</p>

                <div class="forma-contacto"> <!--para poder acomodarlos-->
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono"><!--name es importante ya que es con lo que se puede leer la informacion usando php-->

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si eligió télefono, elija la fecha y la hora</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="9:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">

        </form>
    </main>
    

<?php 
    incluirTemplate('footer'); 
?>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>