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
    <header class="site-header">
      <div class="content">
        <div class="logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="" />
          </a>
        </div>  <!-- .logo -->
      </div>  <!-- .content -->
    </header>
