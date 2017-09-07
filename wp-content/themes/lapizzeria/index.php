<?php get_header(); ?>

<?php
  /* Cabecera del blog */
  $blog_page_id  = get_option( 'page_for_posts' );
  $blog_image_id = get_post_thumbnail_id( $blog_page_id );
  $image         = wp_get_attachment_image_src( $blog_image_id, 'full' );
?>

  <div class="hero" style="background-image: url( <?php echo $image[ 0 ]; ?> );">
    <div class="hero-content">
      <div class="hero-text">
        <h1><?php echo get_the_title( $blog_page_id );      # Template Tag: para imprimir el título de la página ?></h1>
      </div>
    </div>
  </div>
  <div class="principal content">
    <main class="centered-text page-content">
      <?php while( have_posts() ) : the_post(); ?>
        <article class="blog entry">
          <h3><?php the_title(); ?></h3> 
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </main>
  </div>


<?php get_footer(); ?>
