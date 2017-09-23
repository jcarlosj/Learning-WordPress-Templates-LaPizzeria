<!-- Formulario de reservas -->
<form class="reservation" method="post">
  <h2>Realiza una reservación</h2>
  <div class="field">
    <input type="text" name="nombre" placeholder="Nombre" required />
  </div>
  <div class="field">
    <input type="datetime-local" name="fecha" placeholder="Fecha" step="300" required />
  </div>
  <div class="field">
    <input type="email" name="email" placeholder="Correo" required />
  </div>
  <div class="field">
    <input type="tel" name="telefono" placeholder="Teléfono" required />
  </div>
  <div class="field">
    <textarea name="mensaje" placeholder="Mensaje" required></textarea>
  </div>

  <button type="submit" name="enviar" class="button">Enviar</button>
  <input type="hidden" name="save" value="1" />
</form> <!-- form.reservation -->
