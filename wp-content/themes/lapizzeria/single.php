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
<?php endwhile; ?>

<div class="comments content">
  <?php comment_form(); ?>
</div>

<?php get_footer(); ?>
