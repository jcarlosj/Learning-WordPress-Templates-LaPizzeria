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
        <?php
          the_content();
          $url = get_page_by_title( 'Nosotros' );
        ?>
        <a class="button" href="<?php echo get_permalink( $url -> ID ); ?>">Leer más</a>
      </div>
    </div>
  </div>
  <div class="principal content">
    <main class="centered-text page-content">
      Hola desde el <b>front-page.php</b>
      <?php #the_content();    # Template Tag: para imprimir el contenido de la página ?>
    </main>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
