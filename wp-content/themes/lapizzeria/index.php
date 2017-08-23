<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>La Pizzería</title>
    <?php
      /* Esta función "wp_head()" de WP llama las funciones agregadas a la plantilla.
         En nuestro caso la acción "wp_enqueue_scripts"  */
      wp_head();
    ?>
  </head>
  <body>
    <h1>La Pizzería</h1>
    <p>Esta es una plantilla base para WordPress</p>
    <hr />
     <?php
     /* Loop de WordPress
        Con este Loop podemos traer todas los "post" publicados al index.
      */
      while ( have_posts() ) {
        the_post();
        the_title( '<h1>', '</h1>' );
        the_content();
      }
      ?>
  </body>
</html>
