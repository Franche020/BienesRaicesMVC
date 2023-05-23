<h1>contacto</h1>
<main class="contenedor seccion">
  
  <?php if (isset($mensaje)) { ?>
    <p class="alerta exito"> <?php echo $mensaje?> </p>';
  <?php } ?>


<picture>
  <source srcset="build//img/destacada3.webp" type="image/webp" />
  <source srcset="build//img/destacada3.jpg" type="image/jpeg" />
  <img src="build//img/destacada3.jpg" alt="Imagen Contacto" />
</picture>

<h2>LLene el formulario de contacto</h2>
<form class="formulario" action="/contacto" method="post">
  <fieldset>
    <legend>Información Personal</legend>
    <label for="nombre">Nombre</label>
    <input id="nombre" type="text" placeholder="Tu Nombre" name="contacto[nombre]" required/> 
    <label for="mensaje">Mensaje</label>
    <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
  </fieldset>

  <fieldset>
    <legend>Información sobre la propiedad</legend>
    <label for="opciones">Vende o Compra</label>
    <select id="opciones" name="contacto[tipo]" required>
      <option value="" disabled selected>--Seleccione--</option>
      <option value="compra">Compra</option>
      <option value="Vende">Vende</option>
    </select>
    <label for="precio">Precio o Presupuesto</label>
    <input id="precio" type="number" placeholder="Tu precio o presupuesto" name="contacto[precio]" required/>
  </fieldset>

  <fieldset class="informacion-contacto">
    <legend>Información de Contacto</legend>
    <p>Como desea ser contactado</p>
    <div class="forma-contacto">
        <label for="contactar-telefono">Teléfono</label>
        <input type="radio" id="contactar-telefono" value="telefono" name="contacto[contacto]" required />
        <label for="contactar-email">Email</label>
        <input type="radio" id="contactar-email" value="email" name="contacto[contacto]" required/>
    </div>
    <div id="contacto"></div>
    
  </fieldset>

  <button type="submit" class="boton-verde" value="enviar">Enviar</button>
</form>
</main>