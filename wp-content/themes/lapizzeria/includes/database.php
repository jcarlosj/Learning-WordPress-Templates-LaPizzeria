<?php
  function lapizzeria_database() {
    global $wpdb;                   # Clase de WordPress para crear tablas personalizadas y consultas en la Base de Datos
    global $lapizzeria_dbversion;

    $lapizzeria_dbversion = '0.1';                            # Número de versión que le asignamos a nuestra Base de Datos
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

    # Es necesario llamar el siguiente archivo cuando estamos creando tablas nuevas en nuestra base de datos
    require_once( ABSPATH .'wp-admin/includes/upgrade.php' );   # (Obligatorio) ABSPATH: Imprime la ruta absoluta

    # Funcion para encargarse de examinar la estructura de las tablas, agregando o modificando la tabla como sea necesario.
    # Ejemplo: Si hay alguna actualización 'dbDelta' se encargaría de hacerlo
    dbDelta( $sql );

    add_option( 'lapizzeria_dbversion', $lapizzeria_dbversion );

  }

  add_action( 'after_setup_theme', 'lapizzeria_database' );
?>
