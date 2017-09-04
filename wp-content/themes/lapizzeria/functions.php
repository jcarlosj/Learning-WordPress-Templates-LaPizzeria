<?php
  /* A través de este archivo se agregan todas las funcionalidades y archivos
     relacionadas con la plantilla. Se recomienda crear las funciones con el
     prefijo del "Text Domain" de la plantilla más la acción que deseamos realizar,
     ej: "lapizzeria_styles". */

  /* Agregamos la función que nos permitirá hacer uso de una hoja de estilos
     para la plantilla */
  function lapizzeria_styles() {
    /* Registra los archivos de estilos en el Core de Wordpress */
    wp_register_style(
      'normalize',                                  # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/css/normalize.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array(),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '7.0.0'
    );
    wp_register_style(
      'fontawesome',                                # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/css/font-awesome.min.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array( 'normalize' ),                         # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '4.7.0'
    );
    wp_register_style(
      'style',                                      # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/style.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array( 'normalize' ),                         # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.0'                                         # Versión de la hoja de estilos
    );
    /* Agregamos el  estilo registrado */
    wp_enqueue_style( 'normalize' );
    wp_enqueue_style( 'fontawesome' );
    wp_enqueue_style( 'style' );
  }

  /* Agrega las acciones creadas al Core de WordPress:
     Ayuda a que estas sean reconocidas */
  add_action( 'wp_enqueue_scripts', 'lapizzeria_styles' );

  function lapizzeria_scripts() {
    /* Registra los archivos de script (JavaScript) en el Core de Wordpress */
    wp_register_script(
      'scripts',                                    # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/js/scripts.js',  # Ruta del fichero en el directorio JS de la plantilla
      array(),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.0.0',                                      # Versión del Script
      true                                          # Indica que carguen en el Footer (al final del documento que contiene el tema)
    );
    /* Agregamos el los ficheros script registrados */
    wp_enqueue_script( 'jquery' );                  # Agregamos la versión de Bootstrap que trae WordPress
                                                    # También puede hacerse de la forma tradicional descargando el fichero de bootstrap
    wp_enqueue_script( 'scripts' );

  }

  /* Agrega las acciones creadas al Core de WordPress:
     Ayuda a que estas sean reconocidas */
  add_action( 'wp_enqueue_scripts', 'lapizzeria_scripts' );

  /* Agregamos la función que nos permitirá integrar los menues existentes en el tema */
  function lapizzeria_menues() {
    /* Registra los menues en el Core de Wordpress (Habilita el módulo de menues en el Backend Admin de WordPress) */
    register_nav_menus(
      array(
        /* Theme location   => __( '', 'Text Domain' ) */
        'header-menu'       => __( 'Header Menu', 'lapizzeria'),
        'social-media-menu' => __( 'Header Social Media Menu', 'lapizzeria')
      )
    );
  }

  /* Agregamos el menú registrado en "init", que es cuando se ejecuta o inicializa WordPress */
  add_action( 'init', 'lapizzeria_menues' );

  /* Agregamos soporte para imagenes destacadas:
     Esta correrá después de que el tema ha sido instalada correctamente en nuestro WordPress
  */
  function lapizzeria_setup() {
    add_theme_support( 'post-thumbnails' );    # Habilitamos las imágenes destacadas
  }

  /* Agregamos la función que nos permitirá integrar imagenes destacadas al contenido */
  add_action( 'after_setup_theme', 'lapizzeria_setup' );
?>
