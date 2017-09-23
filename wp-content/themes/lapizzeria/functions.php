<?php
  /* Acceso a la Base de Datos de WordPress y Creación de Tablas Personalizadas */
  require get_template_directory() .'/includes/database.php';

  /* Acciones (CRUD) para tablas personalizadas */
  require get_template_directory() .'/includes/reservaciones.php';

  /* Crear opciones para el Tema (o plantilla) de WordPress */
  require get_template_directory() .'/includes/opciones.php';

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
      'fluidbox_css',                                # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/css/fluidbox.min.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array( 'normalize' ),                          # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '2.0.5'
    );
    wp_register_style(
      'style',                                      # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/style.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array( 'normalize' ),                         # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.0'                                         # Versión de la hoja de estilos
    );
    wp_register_style(
      'datetime-local',                             # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/css/datetime-local-polyfill.css',  # Ruta del fichero en el directorio CSS de la plantilla
      array( 'normalize' ),                         # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.0'                                         # Versión de la hoja de estilos
    );
    /* Agregamos el  estilo registrado */
    wp_enqueue_style( 'normalize' );
    wp_enqueue_style( 'fontawesome' );
    wp_enqueue_style( 'fluidbox_css' );
    wp_enqueue_style( 'style' );
    wp_enqueue_style( 'datetime-local' );
  }

  /* Agrega las acciones creadas al Core de WordPress:
     Ayuda a que estas sean reconocidas */
  add_action( 'wp_enqueue_scripts', 'lapizzeria_styles' );

  function lapizzeria_scripts() {
    /* Obtenemos el API Key del formulario de ajustes en la página 'ajustes' creada en el ADMIN (La Pizzería Ajustes)
       para la configuración de Google Maps */
    $APIKey = esc_html( get_option( 'lapizzeria_googlemaps_apikey' ) );

    /* Registra los archivos de script (JavaScript) en el Core de Wordpress */
    wp_register_script(
      'scripts',                                    # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/js/scripts.js',  # Ruta del fichero en el directorio JS de la plantilla
      array(),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.0.0',                                      # Versión del Script
      true                                          # Indica que carguen en el Footer (al final del documento que contiene el tema)
    );
    wp_register_script(
      'fluidbox-jquery-throttle-debounce-plugin',                                   # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/js/jquery.ba-throttle-debounce.min.js',  # Ruta del fichero en el directorio JS de la plantilla
      array( 'jquery' ),                            # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '1.1.0',                                      # Versión del Script
      true                                          # Indica que carguen en el Footer (al final del documento que contiene el tema)
    );
    wp_register_script(
      'fluidbox',                                   # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/js/jquery.fluidbox.min.js',  # Ruta del fichero en el directorio JS de la plantilla
      array( 'jquery', 'fluidbox-jquery-throttle-debounce-plugin' ),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '2.0.5',                                      # Versión del Script
      true                                          # Indica que carguen en el Footer (al final del documento que contiene el tema)
    );
    wp_register_script(
      'google-maps',                                # Nombre que toma la función registrada en el Core de Wordpress (handle)
      'https://maps.googleapis.com/maps/api/js?key=' .$APIKey.  '&callback=initMap',  # Ruta del fichero en el directorio JS de la plantilla
      array(),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      'V3',                                         # Versión del Script
      true                                          # Indica que carguen en el Footer (al final del documento que contiene el tema)
    );
    wp_register_script(
      'datetime-local-polyfill',                    # Nombre que toma la función registrada en el Core de Wordpress
      get_template_directory_uri() . '/js/datetime-local-polyfill.min.js',  # Ruta del fichero en el directorio JS de la plantilla
      array(),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '2.0.5',                                      # Versión del Script
      true                                          # Indica que carguen en el Footer (al final del documento que contiene el tema)
    );
    wp_register_script(
      'modernizr',                                  # Nombre que toma la función registrada en el Core de Wordpress
      'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js',  # Ruta del fichero en el directorio JS de la plantilla
      array(),                                      # Dependencias (ficheros que deseamos que se carguen antes, vacio por ahora)
      '2.8.3',                                      # Versión del Script
      true                                          # Indica que carguen en el Footer (al final del documento que contiene el tema)
    );


    /* Agregamos el los ficheros script registrados */
    wp_enqueue_script( 'jquery' );                  # Agregamos la versión de Bootstrap que trae WordPress
                                                    # También puede hacerse de la forma tradicional descargando el fichero de jQuery
    wp_enqueue_script( 'jquery-ui-core' );          # Agregamos la versión de Bootstrap que trae WordPress
                                                    # También puede hacerse de la forma tradicional descargando el fichero de jQueryUI
    wp_enqueue_script( 'jquery-ui-datepicker' );    # Agregamos el componente que vamos a ocupar (que vamos autilizar)

    wp_enqueue_script( 'datetime-local-polyfill' );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'scripts' );
    wp_enqueue_script( 'fluidbox-jquery-throttle-debounce-plugin' );
    wp_enqueue_script( 'fluidbox' );
    wp_enqueue_script( 'google-maps' );

    /* Pasamos los valores de las variables PHP al JavaScript donde se ajusta la: latitud, longitud y zoom del mapa
      desde la configuración del formulario de ajustes en la página 'ajustes' creada en el ADMIN (La Pizzería Ajustes)
      para la configuración de Google Maps */

      # Función de  WordPress diseñada para hacer TEMAS compatibles en diferentes lenguajes
      # En la actualidad se usa mucho para pasar variables de PHP a JavaScript
      wp_localize_script(
        'scripts',            # Nombre del Script que se desea encontrar para pasarle los datos en nuestro caso "scripts.js"
        'googlemaps_data',    # Pasamos el nombre (del Objeto) al que tenemos que hacer la referencia (Se puede usar cualquier nombre)
        array(                # Array que contienen las diferentes opciones que vamos a pasar
          'latitude'  => get_option( 'lapizzeria_googlemaps_latitud' ),     # Valor de la Latitud desde el Formulario Ajustes
          'longitude' => get_option( 'lapizzeria_googlemaps_longitud' ),    # Valor de la Longitud desde el Formulario Ajustes
          'zoom'      => get_option( 'lapizzeria_googlemaps_zoom' )         # Valor del Zoom desde el Formulario Ajustes
        )
      );

  }

  /* Agrega las propiedades "Async" y "Defer" al tag script que implementa la API de Google Maps en la vista
     Necesarios para la implementación de Mapas con la API de Google Maps
     $tag y $handle son de WordPress
  */
  function add_async_defer( $tag, $handle ) {
    if( 'google-maps' !== $handle ) {
      return $tag;
    }
    return str_replace(
      ' src',                               # Lo que queremos reemplazar
      ' async="async" defer="defer" src',   # Por lo que lo vamos a reemplazar
      $tag                                  # A quien se lo aplicamos. En nuestro caso al TAG <script>
    );
  }
  add_filter(
    'script_loader_tag',  # Hook de WordPress donde va a ejecutar
    'add_async_defer',    # Función que se va a ejecutar,
    10,                   # Prioridad
    2                     # Número de argumentos que se desean pasar ( $tag, $handle )
  );

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
    add_image_size(
      'especialidades_portrait',   # Nombre del tamaño de imagen que hemos registrado
      435,          # Alto de la imagen en pixeles
      526,          # Ancho de la imagen en pixeles
      true          # True si deseamos que puedo de la redimensión se haga cropping o recorte de la imagen
    );

    /* Cambia las dimensiones personalizadas (Ajustes Multimedia) en el ADMIN de WordPress de manera que
       queden predeterminadas al instalar esta plantilla (Tamaño de la miniatura) */
    update_option( 'thumbnail_size_w', 253 );   # Width
    update_option( 'thumbnail_size_h', 164 );   # Height
    /* Para cambiar los otros tamaños predeterminados de WordPress simplemente cambiamos la palabra 'thumbnail' por: 'medium', 'large', etc */
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

/* ACF - Advanced Custom Fields
   Exportamos todos los campos creados con el plugin ACF de manera que queden integrados (incluidos) a la plantilla
*/

/* Para eliminar todas las interfaces visuales del complemento ACF, puede utilizar una constante para habilitar el modo lite. */
define( 'ACF_LITE', true );

# Movemos el directorio del pluging hacía el interior de la plantilla y hacemos el llamado al mismo.
include_once( 'includes/advanced-custom-fields/acf.php' );

/* Agregamos el código GENERADO por Custom Fields */
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_especialidades',
		'title' => 'Especialidades',
		'fields' => array (
			array (
				'key' => 'field_59b01952a80e1',
				'label' => 'Precio',
				'name' => 'precio',
				'type' => 'text',
				'instructions' => 'Añada el precio del platillo',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'especialidades',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_inicio',
		'title' => 'Inicio',
		'fields' => array (
			array (
				'key' => 'field_59c142ab3abe9',
				'label' => 'Contenido',
				'name' => 'contenido',
				'type' => 'wysiwyg',
				'instructions' => 'Agregue la descripción destacada',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_59c142e03abea',
				'label' => 'Imagen',
				'name' => 'imagen',
				'type' => 'image',
				'instructions' => 'Agregue la imagen destacada',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '2',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_nosotros',
		'title' => 'Nosotros',
		'fields' => array (
			array (
				'key' => 'field_59adaaf8bb9e5',
				'label' => 'Imagen 1',
				'name' => 'imagen_1',
				'type' => 'image',
				'instructions' => 'Suba una imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_59adac1bbb9e8',
				'label' => 'Descripcion 1',
				'name' => 'descripcion_1',
				'type' => 'wysiwyg',
				'instructions' => 'Agrega aquí la descripción',
				'required' => 1,
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_59adabefbb9e6',
				'label' => 'Imagen 2',
				'name' => 'imagen_2',
				'type' => 'image',
				'instructions' => 'Suba una imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_59adac6dbb9e9',
				'label' => 'Descripcion 2',
				'name' => 'descripcion_2',
				'type' => 'wysiwyg',
				'instructions' => 'Agrega aquí la descripción',
				'required' => 1,
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_59adabfdbb9e7',
				'label' => 'Imagen 3',
				'name' => 'imagen_3',
				'type' => 'image',
				'instructions' => 'Suba una imagen',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_59adac7cbb9ea',
				'label' => 'Descripcion 3',
				'name' => 'descripcion_3',
				'type' => 'wysiwyg',
				'instructions' => 'Agrega aquí la descripción',
				'required' => 1,
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '6',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>
