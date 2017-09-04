<?php get_header(); ?>

<?php while( have_posts() ): the_post(); # Agregamos el loop de WordPress ?>
  <div class="hero" style="background-image: url( <?php echo get_the_post_thumbnail_url(); ?> );">
    <div class="hero-content">
      <div class="hero-text">
        <h1><?php the_title();      # Template Tag: para imprimir el título de la página ?></h1>
      </div>
    </div>
  </div>
  <div class="principal content">
    <main class="centered-text page-content">
      <?php the_content();    # Template Tag: para imprimir el contenido de la página ?>
    </main>
  </div>

  <h2>Detalles</h2>
  <p>Agregaremos más detalles a la vista de nosotros. Para ello instalaremos el plugin <b>Advanced Custom Fields</b> y registraremos los campos que estarán disponibles en el ADMIN de WordPress para generar contenido en este espacio de la vista personalizada de nosotros <i>"page-<b>nosotros</b>.php"</i>. </p>
<?php endwhile; ?>

<?php get_footer(); ?>
