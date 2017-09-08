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
  <div class="grid-content clear">

    <main class="cols_2-3 page-content">
      <?php while( have_posts() ) : the_post(); # Imprime las entradas de Blog?>
        <article class="blog-entry">
          <a href="<?php the_permalink(); # Template Tag: Enlace a la entrada completa, para la imagen ?>" >
            <?php the_post_thumbnail( 'especialidades' ); # Template Tag: Imagen, con el formato de especialidades ?>
          </a>
          <header class="information-blog-entry clear">
            <div class="date-entry">
              <time>
                <?php the_time( 'd' ); # Template Tag: Imprime día de la publicación ?>
                <span><?php the_time( 'M' ); # Template Tag: Imprime mes de la publicación ?></span>
              </time>
            </div>
            <div class="title-blog-entry">
              <h2><?php the_title(); # Template Tag: Título de la entrada ?></h2>
              <p class="author-blog-entry">
                <i class="fa fa-user" aria-hidden="true"></i>
                <?php the_author(); # Template Tag: Autor de la entrada ?>
              </p>
            </div>
          </header>
          <div class="content-blog-entry">
            <?php the_excerpt(); # Template Tag: Contenido abreviado de la entrada ?>
            <a href="<?php the_permalink(); # Template Tag: Enlace a la entrada completa ?>" class="button red">Leer más</a>
          </div>
        </article>
      <?php endwhile; ?>

      <div class="pagination">
        <div class="previous">
          <?php next_posts_link( 'Anteriores' ); # Paginación (Método 2) ?>
        </div>
        <div class="next">
          <?php previous_posts_link( 'Siguientes' ); # Paginación (Método 2) ?>
        </div>
      </div>

    </main>

    <?php get_sidebar(); ?>

  </div>  <!-- .grid-container -->
</div>  <!-- .principal .content -->

<?php get_footer(); ?>
