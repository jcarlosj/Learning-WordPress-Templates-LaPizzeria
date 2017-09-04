<?php get_header(); ?>

<?php while( have_posts() ): the_post(); # Agregamos el loop de WordPress ?>
  <?php the_post_thumbnail(); # Template Tag: para imprimir imagen destadaca de la página ?>
  <h1><?php the_title();      # Template Tag: para imprimir el título de la página ?></h1>
  <div class="principal content">
    <main>
      <?php the_content();    # Template Tag: para imprimir el contenido de la página ?>
    </main>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
