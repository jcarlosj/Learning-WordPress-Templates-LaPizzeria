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
