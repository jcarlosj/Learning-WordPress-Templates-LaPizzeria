<?php
  /* A través de este archivo se agregan todas las funcionalidades y archivos
     relacionadas con la plantilla. Se recomienda crear las funciones con el
     prefijo del "Text Domain" de la plantilla más la acción que deseamos realizar,
     ej: "lapizzeria_styles". */

  /* Agregamos la función que nos permitirá hacer uso de una hoja de estilos
     para la plantilla */
  function lapizzeria_styles() {
    /* Registra las funciones en el Core de Wordpress */
    wp_register_style(
      'normalize',                                  # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/css/normalize.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array(),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '7.0.0'
    );
    wp_register_style(
      'style',                                      # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/style.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array( 'normalize' ),                         # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.0'                                         # Versión de la hoja de estilos
    );
    /* Agregamos el  estilo registrado */
    wp_enqueue_style( 'normalize' );
    wp_enqueue_style( 'style' );
  }

  /* Agrega las acciones creadas al Core de WordPress:
     Ayuda a que estas sean reconocidas */
  add_action( 'wp_enqueue_scripts', 'lapizzeria_styles' );
?>
