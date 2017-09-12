<?php
  /* Inicializa la creación de la base de datos personalizada */
  function lapizzeria_database() {
    global $wpdb;                   # Clase de WordPress para crear tablas personalizadas y consultas en la Base de Datos
    global $lapizzeria_dbversion;

    $lapizzeria_dbversion = '1.0.0';                          # DEBEMOS CAMBIAR este Número de versión que le asignamos a nuestra
                                                              # Base de Datos cada que creemos una nueva o hagamos la actualización
                                                              # de la misma.
    $name_table           = $wpdb -> prefix .'reservaciones'; # Prefijo de la tabla fijado en la configuración inicial
    $charset_collate      = $wpdb -> get_charset_collate();   # Cotejación de caracteres actual usado por la Base de Datos de WordPress

    /* Consulta para la creación de la tabla
       Usar siempre las dobles comillas para la cadena de texto que contiente la consulta
    */
    $sql = "CREATE TABLE $name_table (
      id mediumint( 9 ) NOT NULL AUTO_INCREMENT,
      nombre varchar( 50 ) NOT NULL,
      fecha datetime NOT NULL,
      correo varchar( 50 ) DEFAULT '' NOT NULL,
      telefono varchar( 10 ) NOT NULL,
      mensaje longtext NOT NULL,
      PRIMARY KEY ( id )
    ) $charset_collate; ";

    # Requerido por dbDelta().
    # Es necesario llamar el siguiente archivo cuando estamos creando tablas nuevas en nuestra base de datos
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );   # (Obligatorio) ABSPATH: Imprime la ruta absoluta

    # Funcion para encargarse de examinar la estructura de las tablas, agregando o modificando la tabla como sea necesario.
    # Ejemplo: Si hay alguna actualización 'dbDelta' se encargaría de hacerlo
    dbDelta( $sql );

    # Agregamos la versión de la Base de Datos a WordPress
    add_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );

    /*************************************************/
    /* Actualizar Versión (En caso de ser necesario) */
    $current_version = get_option( 'lapizzeria_dbversion' );  # Obtenemos la versión de la Base de Datos que registramos en WordPress

    /* Comparamos los números de versión de las bases de datos */
    if ( $lapizzeria_dbversion != $current_version ) {
      $name_table = $wpdb -> prefix .'reservaciones'; # Prefijo de la tabla fijado en la configuración inicial

      /* # DEBEMOS CAMBIAR esta Consulta para la actualización de la tabla */
      $sql = "CREATE TABLE $name_table (
        id mediumint( 9 ) NOT NULL AUTO_INCREMENT,
        nombre varchar( 50 ) NOT NULL,
        fecha datetime NOT NULL,
        correo varchar( 50 ) DEFAULT '' NOT NULL,
        telefono varchar( 10 ) NOT NULL,
        mensaje longtext NOT NULL,
        PRIMARY KEY ( id )
      ) $charset_collate; ";

      # Es necesario llamar el siguiente archivo cuando estamos creando tablas nuevas en nuestra base de datos
      require_once( ABSPATH .'wp-admin/includes/upgrade.php' );   # (Obligatorio) ABSPATH: Imprime la ruta absoluta

      # Funcion para encargarse de examinar la estructura de las tablas, agregando o modificando la tabla como sea necesario.
      # Ejemplo: Si hay alguna actualización 'dbDelta' se encargaría de hacerlo
      dbDelta( $sql );

      add_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );
    }
  }

  /* Agrega la configuración de la Base de Datos a WordPress y le indica cuando debe ejecutarse
     'after_setup_theme' Despues de cargar la configuración del tema (o plantilla)
  */
  add_action( 'after_setup_theme', 'lapizzeria_database' );     # Hook

/* Revisa versión */
function lapizzeria_review_version() {
  global $lapizzeria_dbversion;

  if( get_site_option( 'lapizzeria_dbversion' ) != $lapizzeria_dbversion ) {
    /* En caso de no ser igual */
    lapizzeria_database();
  }
}

add_action( 'plugins_loaded', 'lapizzeria_review_version' );

?>
