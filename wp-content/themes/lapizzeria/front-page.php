<?php get_header(); ?>

<?php while( have_posts() ): the_post(); # Agregamos el loop de WordPress ?>
  <div class="hero" style="background-image: url( <?php echo get_the_post_thumbnail_url(); ?> );">
    <div class="hero-content">
      <div class="hero-text">
        <h1>Front Page<?php # the_title();      # Template Tag: para imprimir el título de la página ?></h1>
      </div>
    </div>
  </div>
  <div class="principal content">
    <main class="centered-text page-content">
      Hola desde <b>front-page.php</b>
      <?php #the_content();    # Template Tag: para imprimir el contenido de la página ?>
    </main>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
