<?php
require "includes/funciones.php";
incluirTemplate("header");
?>


<main class="contenedor seccion">
  <h1>Contacto</h1>
  <picture>
    <source srcset="build/img/destacada3.webp" type="image/webp" />
    <source srcset="build/img/destacada3.jpg" type="image/jpeg" />
    <img src="build/img/destacada3.jpg" alt="imagen destacada" loading="lazy" />
  </picture>
  <h3>Rellene el formulario de contacto</h3>
  <form action="" class="formulario">
    <fieldset>
      <legend>Información personal</legend>
      <label for="nombre">Nombre</label>
      <input type="text" placeholder="Tu nombre" id="nombre" />
      <label for="email">E-mail</label>
      <input type="text" placeholder="Tu e-mail" id="email" />
      <label for="telefono">Teléfono</label>
      <input type="tel" placeholder="Tu telefono" id="telefono" />
      <label for="mensaje">Mensaje:</label>
      <textarea id="mensaje"></textarea>
    </fieldset>
    <fieldset>
      <legend>Información sobre Propiedad</legend>
      <label for="opciones">Vende o Compra</label>
      <select name="" id="opciones">
        <option value="" disabled selected>-- Seleccione --</option>
        <option value="compra">Compra</option>
        <option value="vende">Vende</option>
      </select>
      <label for="presupuesto">Precio o Presupuesto</label>
      <input type="number" placeholder="Tu precio o o prespuesto" id="presupuesto" />
    </fieldset>
    <fieldset>
      <legend>Contacto</legend>
      <p>Como desea ser contactado</p>
      <div class="forma-contacto">
        <label for="contactar-telefono">Teléfono</label>
        <input type="radio" value="telefono" id="contactar-telefono" name="contacto" />
        <label for="contactar-email">E-mail</label>
        <input type="radio" value="email" id="contactar-email" name="contacto" />
      </div>
      <p>Si eligió teléfono eliga la fecha la hora</p>
      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" />
      <label for="hora">Hora</label>
      <input type="time" id="hora" min="09:00" max="18:00" />
    </fieldset>
    <input type="submit" value="Enviar" class="btn-verde" />
  </form>
</main>
<?php
incluirTemplate("footer");
?>