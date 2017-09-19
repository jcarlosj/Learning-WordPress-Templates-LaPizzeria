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
      <?php
        # Llamamos al formulario de reservación (que ha sido creado en una plantilla)
        get_template_part(
          'templates/form',   # Path Template: path/primera parte del nombre del archivo sin guión
          'reservacion'       # Name: nombre de la segunda parte del archivo sin guión
        );
      ?>
    </main>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
