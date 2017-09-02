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
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" class="site-logo" alt="" />
          </a>
        </div>  <!-- .logo -->
        <div class="header-information">
          <div class="social-media">
            <?php
              $args = array(
                'theme_location'  => 'social-media-menu',
                'container'       => 'nav', # Etiqueta que lo contendrá (puede ser cualquiera)
                'container_class' => 'social-menu', # Clase de la etiqueta que lo contendrá
                'container_id'    => 'social-menu', # ID de la etiqueta que lo contendrá
                'link_before'     => '<span class="sr-text">',
                'link_after'      => '</span>'
              );

              wp_nav_menu( $args );
            ?>
          </div>  <!-- .social-media -->
          <div class="address">
            <p>Avenida Siempreviva 742, Springfield</p>
            <p>Teléfono: +1-92-456-7890</p>
          </div>
        </div>
      </div>  <!-- .content -->
    </header>
    <div class="content navigation">
      <?php
        $args = array(
          'theme_location'  => 'header-menu',
          'container'       => 'nav',         # Etiqueta que lo contendrá (puede ser cualquiera)
          'container_class' => 'site-menu'    # Clase de la etiqueta que lo contendrá
        );

        wp_nav_menu( $args );
      ?>
    </div>
