<?php get_header(); ?>

<?php while( have_posts() ): the_post(); # Agregamos el loop de WordPress ?>
  <div class="hero" style="background-image: url( <?php echo get_the_post_thumbnail_url(); ?> );">
    <div class="hero-content">
      <div class="hero-text">
        <h1><?php the_title();      # Template Tag: para imprimir el título de la página ?></h1>
      </div>
    </div>
  </div>
  <div class="principal content contact">
    <main class="page-content">
      <form class="reservation" method="post">
        <h2>Realiza una reservación</h2>
        <div class="field">
          <input type="text" name="nombre" placeholder="Nombre" required />
        </div>
        <div class="field">
          <input type="datetime-local" name="fecha" placeholder="Fecha" required />
        </div>
        <div class="field">
          <input type="text" name="email" placeholder="Correo" required />
        </div>
        <div class="field">
          <input type="tel" name="telefono" placeholder="Teléfono" required />
        </div>
        <div class="field">
          <textarea name="mensaje" placeholder="Mensaje" required></textarea>
        </div>
        <button type="submit" name="enviar" class="button">Enviar</button>
      </form>
    </main>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
