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
  <div class="boxes-information content clear">
    <div class="box">
      <?php #Imprimimos los valores de los campos como lo indica el plugin AFE: Advanced Custom Fields ?>
      <?php #Cambiamos desde el ADMIN de WordPress la forma como se desplegarán las imagenes en la vista a la opción "Image ID"
        $image_id = get_field( 'imagen_1' );
        $image    = wp_get_attachment_image_src( $image_id, 'nosotros' );  # ID de la imagen y nombre de la personalización
      ?>
      <img src="<?php echo $image[ 0 ]; ?>" class="box-image" />
      <div class="box-content">
        <?php the_field( 'descripcion_1' ); ?>
      </div>
    </div>  <!-- .box #1 -->
    <div class="box">
      <?php
        $image_id = get_field( 'imagen_2' );
        $image    = wp_get_attachment_image_src( $image_id, 'nosotros' );  # ID de la imagen y nombre de la personalización
      ?>
      <div class="box-content">
        <?php the_field( 'descripcion_2' ); ?>
      </div>
      <img src="<?php echo $image[ 0 ]; ?>" class="box-image" />
    </div>  <!-- .box #2 -->
    <div class="box">
      <?php
        $image_id = get_field( 'imagen_3' );
        $image    = wp_get_attachment_image_src( $image_id, 'nosotros' );  # ID de la imagen y nombre de la personalización
      ?>
      <img src="<?php echo $image[ 0 ]; ?>" class="box-image" />
      <div class="box-content">
        <?php the_field( 'descripcion_3' ); ?>
      </div>
    </div>  <!-- .box #3 -->
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
