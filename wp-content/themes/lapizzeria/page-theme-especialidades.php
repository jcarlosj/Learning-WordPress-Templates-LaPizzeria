<?php
  /*
   * Template Name: Especialidades
   */
?>
<?php # En jerarquía de plantillas de WordPress esta es una 'Custom Template' -> $custom.php  ?>
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

<div class="specialties content">
  <h3 class="title-specialties">Pizzas</h3>
  <div class="grid-container">
    <?php
      # Creamos los argumentos de la consulta que deseamos hacer a WordPress
      $args = array(
        'post_type'      => 'especialidades',   # Nombre del 'Post Type' (Se puede ver en la URL del ADMIN)
        'posts_per_page' => -1,                 # Cantidad de registros a mostrar por página (-1 significa imprimirlos todos
        'orderby'        => 'title',            # Ordenar por: Fecha de publicación, orden alfabético, Author etc.
        'order'          => 'ASC',              # Tipo de orden: Ascendente, Descendente
        'category_name'  => 'Pizzas'            # Muestra el Slug de una categoría previamente creada
      );
      #
      $pizzas = new WP_Query( $args );          # Hacemos la consulta usando el 'WP_Query' y pasamos los argumentos de la misma
      while ( $pizzas -> have_posts() ): $pizzas -> the_post();    # Creamos un loop para imprimir los valores traidos por la consulta
    ?>

      <div class="">
        <?php the_post_thumbnail( 'especialidades' ); ?>
        <div class="specialty-text">
          <h4><?php the_title(); ?> <span>$ <?php the_field( 'precio' ); ?></span></h4>
          <?php the_content(); ?>
        </div>  <!-- .specialty-text -->
      </div>

    <?php endwhile; wp_reset_postdata(); # Solo usamos 'wp_reset_postdata()' cuando se use el 'WP_Query()' ?>
  </div>
</div>

<?php get_footer(); ?>
