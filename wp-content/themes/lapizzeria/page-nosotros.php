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
  <div class="information-boxes content">
    <div class="box">
      <?php #Imprimimos los valores de los campos como lo indica el plugin AFE: Advanced Custom Fields ?>
      <img src="<?php the_field( 'imagen_1' ); ?>" alt="" />
      <div class="box-content">
        <?php the_field( 'descripcion_1' ); ?>
      </div>
    </div>
    <div class="box">
      <?php #Imprimimos los valores de los campos como lo indica el plugin AFE: Advanced Custom Fields ?>
      <img src="<?php the_field( 'imagen_2' ); ?>" alt="" />
      <div class="box-content">
        <?php the_field( 'descripcion_2' ); ?>
      </div>
    </div>
    <div class="box">
      <?php #Imprimimos los valores de los campos como lo indica el plugin AFE: Advanced Custom Fields ?>
      <img src="<?php the_field( 'imagen_3' ); ?>" alt="" />
      <div class="box-content">
        <?php the_field( 'descripcion_3' ); ?>
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
