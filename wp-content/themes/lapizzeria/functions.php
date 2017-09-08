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
      'google_fonts',                                # Nombre que toma la función registrada en el Core de Wordpress
      'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900',  # Ruta del fichero en el directorio CSS de la plantilla
      array(),                                       # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.0.0'
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

    /* Personalizamos un nuevo tamaño de imagen para la página de nosotros adicional a los que
       podemos encontrar en el ADMIN en la sección de Medios en Ajustes multimedia.
       Si las imagenes ya han sido subidas estos cambios no se les van a aplicar, por lo que
       hay que volver a subirlas o usar un plugin que las regenere automáticamente, en nuestro
       caso haciendo uso del plugin "regenerate thumnails", muy util en la etapa de desarrollo
    */
    add_image_size(
      'nosotros',   # Nombre del tamaño de imagen que hemos registrado
      437,          # Alto de la imagen en pixeles
      291,          # Ancho de la imagen en pixeles
      true          # True si deseamos que puedo de la redimensión se haga cropping o recorte de la imagen
    );
    add_image_size(
      'especialidades',   # Nombre del tamaño de imagen que hemos registrado
      768,          # Alto de la imagen en pixeles
      515,          # Ancho de la imagen en pixeles
      true          # True si deseamos que puedo de la redimensión se haga cropping o recorte de la imagen
    );
  }

  /* Agregamos la función que nos permitirá integrar imagenes destacadas al contenido */
  add_action( 'after_setup_theme', 'lapizzeria_setup' );

  /* Custom Post Type:
     En WordPress existen 5 tipos de "Custom Post Types" por defecto: Entradas, Medios, Páginas, Menues y Comentarios
     Estos sirven para personalizar el contenido y tener un tipo de contenido o Tipo de Post con los campos necesarios
     y las personalizaciones adecuadas de acuerdo al tipo de contenido que van a administrar
  */

  /* Custom Post Type: Pizzas */
  add_action( 'init', 'lapizzeria_especialidades' );
  function lapizzeria_especialidades() {
  	$labels = array(
  		'name'               => _x( 'Pizzas', 'lapizzeria' ),
  		'singular_name'      => _x( 'Pizzas', 'post type singular name', 'lapizzeria' ),
  		'menu_name'          => _x( 'Pizzas', 'admin menu', 'lapizzeria' ),
  		'name_admin_bar'     => _x( 'Pizzas', 'add new on admin bar', 'lapizzeria' ),
  		'add_new'            => _x( 'Añadir nueva', 'book', 'lapizzeria' ),
  		'add_new_item'       => __( 'Añadir nueva Pizza', 'lapizzeria' ),
  		'new_item'           => __( 'Nueva Pizza', 'lapizzeria' ),
  		'edit_item'          => __( 'Editar Pizza', 'lapizzeria' ),
  		'view_item'          => __( 'Ver Pizza', 'lapizzeria' ),
  		'all_items'          => __( 'Todas las Pizzas', 'lapizzeria' ),
  		'search_items'       => __( 'Buscar Pizza', 'lapizzeria' ),
  		'parent_item_colon'  => __( 'Parent Pizzas:', 'lapizzeria' ),
  		'not_found'          => __( 'Pizzas no encontradas.', 'lapizzeria' ),
  		'not_found_in_trash' => __( 'No se encontraron pizzas en la papelera.', 'lapizzeria' )
  	);

  	$args = array(
  		'labels'             => $labels,
      'description'        => __( 'Description.', 'lapizzeria' ),
  		'public'             => true,
  		'publicly_queryable' => true,
  		'show_ui'            => true,
  		'show_in_menu'       => true,
  		'query_var'          => true,
  		'rewrite'            => array( 'slug' => 'especialidades' ),
  		'capability_type'    => 'post',
  		'has_archive'        => true,
  		'hierarchical'       => false,
  		'menu_position'      => 6,
  		'supports'           => array( 'title', 'editor', 'thumbnail' ),
      'taxonomies'         => array( 'category' )
  	);

	register_post_type( 'especialidades', $args );
}

/* Widgets:  */

function lapizzeria_widgets() {
  register_sidebar( $args = array(
    'name' => 'Blog Sidebar',    # Nombre con el que se identificará en el Back-End de WordPress
    'id' => 'blog_sidebar', # El ID es especial para poderlo imprimir
    'before_widget' => '<div class="widget">', # Esto es lo que se va a imprimir antes (Apertura)
    'after_widget' => '</div>', #  Esto es lo que se va a imprimir después (Cierre)
    'before_title' => '<h3>', # Tag contenedor del título (Apertura)
    'after_title' => '</h3>' # Tag contenedor del título (Cierre)

  ) );
}
add_action( 'widgets_init', 'lapizzeria_widgets' );

?>
