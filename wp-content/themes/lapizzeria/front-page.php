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
  <main class="grid-container">
    <h1 class="centered-text red">Nuestras especialidades</h1>
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
      <div class="speciality cols_1-3">
        <div class="speciality-content">
          <?php the_post_thumbnail( 'especialidades_portrait' ); ?>
          <div class="dish-information">
            <h3><?php the_title(); ?></h3>
            <?php the_content(); ?>
            <p class="price">$<?php the_field( 'precio' ); ?></p>
            <a href="<?php the_permalink(); ?>" class="button">Leer más</a>
          </div>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </main>
</div>

<section class="ingredients">
  <div class="content">
    <div class="grid-container">
      <?php while( have_posts() ): the_post(); # Agregamos el loop de WordPress ?>
      <div class="cols_2-4">
        <?php the_field( 'contenido' ); ?>
        <a href="<?php the_permalink(); ?>" class="button">Leer más</a>
      </div>
      <div class="cols_2-4 imagen">
        <img src="<?php the_field( 'imagen' ); ?>" alt="" />
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<section class="content">
  <h2 class="centered-text red">Galería de Imágenes</h2>
  <?php $url = get_page_by_title( 'Galería' ); ?>
  <?php echo get_post_gallery( $url -> ID ); ?>
</section>

<section class="location-and-reservation">
  <div class="grid-container">
    <div class="cols_2-4">
      <div id="location-map">

      </div>
    </div>
    <div class="cols_2-4">
      <?php
        # Llamamos al formulario de reservación (que ha sido creado en una plantilla)
        get_template_part(
          'templates/form',   # Path Template: path/primera parte del nombre del archivo sin guión
          'reservacion'       # Name: nombre de la segunda parte del archivo sin guión
        );
      ?>
    </div>
  </div>
</section>

<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById( 'location-map' ), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg1Z4cnIMEvFo5e8ASJYt2tVO_zEFt-vE&callback=initMap"
    async defer></script>

<?php get_footer(); ?>
