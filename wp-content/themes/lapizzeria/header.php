<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>La Pizzería</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Agregamos compatilibidad para WebApp de iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- Agrega el soporte para iOS -->
    <meta name="apple-mobile-web-app-title" content="La Pizzería" />
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.jpg" />
    <!-- Agregamos compatilibidad para WebApp de Android -->
    <meta name="mobile-web-app-capable" content="yes" /> <!-- Agrega el soporte para Android -->
    <meta name="theme-color" content="#A61206" />
    <meta name="application-name" content="La Pizzería" />
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/android-icon.png" sizes="180x180" />
    <?php
      /* Esta función "wp_head()" de WP llama las funciones agregadas a la plantilla.
         En nuestro caso la acción "wp_enqueue_scripts"  */
      wp_head();
    ?>
  </head>
  <body <?php body_class(); # WordPress agrega estilos diferentes al cuerpo de cada una de las páginas ?> >
    <header class="site-header">
      <div class="content">
        <div class="logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php
              /* Personalización de Logo del sitio */
              if( function_exists( 'the_custom_logo' ) ) {
                the_custom_logo();
              }
            ?>
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
            <p><?php echo esc_html( get_option( 'lapizzeria_direccion' ) ); ?></p>
            <p>Teléfono: <?php echo esc_html( get_option( 'lapizzeria_telefono' ) ); ?></p>
          </div>
        </div>
      </div>  <!-- .content -->
    </header>
    <div class="site-main-menu">
      <div class="button-mobile-menu">
        <a href="#" class="mobile">Menú
          <i class="fa fa-bars" aria-hidden="true"></i>
        </a>
      </div>
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
    </div>
