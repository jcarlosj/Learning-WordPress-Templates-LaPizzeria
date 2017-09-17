<?php get_header(); ?>

<?php while( have_posts() ): the_post(); # Agregamos el loop de WordPress ?>
  <div class="hero" style="background-image: url( <?php echo get_the_post_thumbnail_url(); ?> );">
    <div class="hero-content">
      <div class="hero-text">
        <h1>
          <?php
              bloginfo( 'description' );                          # O puedes usar una segunda opción
              #echo esc_html( get_option( 'blogdescription' ) );  # que traerá en ambos casos la 'descripción corta'
                                                                  # de la sección 'Ajuestes generales' en el ADMIN de WordPress
            ?>
        </h1>
        <?php the_content();?>
        <?php $url = get_page_by_title( 'Nosotros' ); ?>
        <a class="button orange" href="<?php echo get_permalink( $url -> ID ); ?>">Leer más</a>
      </div>
    </div>
  </div>
<?php endwhile; ?>

<div class="principal content">
  <main class="centered-text page-content">
    <h1 class="red">Nuestras especialidades</h1>
    <?php
      $args = array(
        'posts_per_page' => 3,
        'orderby'        => 'rand',
        'post_type'      => 'especialidades',
        'category_name'  => 'pizzas'
      );

      $specialties = new WP_Query( $args );
      while( $specialties -> have_posts() ):
        $specialties -> the_post();
    ?>
      <div class="speciality">
        <?php the_title(); ?>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </main>
</div>

<?php get_footer(); ?>
