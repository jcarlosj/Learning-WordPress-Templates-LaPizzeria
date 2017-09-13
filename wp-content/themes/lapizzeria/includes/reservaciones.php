<?php
  /* Arquitectura por Eventos:
     Si un usuario llena un formulario se dispara un evento y este realiza las
     tareas que tenga que hacer */

  /* Evento Guardar */
  function lapizzeria_save() {

    global $wpdb;   # Clase de acceso a las funciones de CRUD de WordPress

    if( isset( $_POST[ 'enviar' ] ) && $_POST[ 'save' ] == 1 ) {

      $name_table      = $wpdb -> prefix .'reservaciones'; # Prefijo de la tabla fijado en la configuración inicial

      # To Debug
      # echo '<code>Formulario <pre>'; var_dump( $_POST ); echo '</pre></code>';

      /* Recogemos los datos del formulario
         Sanitizando los datos del formulario (Cuando entran los datos) */
      $reservation_data = array(
        'nombre'   => lapizzeria_sanitize_text_field( 'nombre' ),
        'fecha'    => lapizzeria_sanitize_text_field( 'fecha' ),
        'correo'   => lapizzeria_sanitize_text_field( 'email' ),
        'telefono' => lapizzeria_sanitize_text_field( 'telefono' ),
        'mensaje'  => lapizzeria_sanitize_text_field( 'mensaje' )
      );

      # To Debug
      # echo '<code>Sanatizado <pre>'; var_dump( $reservation_data ); echo '</pre></code>';

      /* Formato de tipos para la inserción de datos */
      $data_types = array(
        '%s',     # Tipo 'String' para nombre
        '%s',     # Tipo 'String' para fecha
        '%s',     # Tipo 'String' para email
        '%s',     # Tipo 'String' para telefono
        '%s'      # Tipo 'String' para mensaje
      );

      /* Realizamos inserción de los datos a la base de datos, usando el Objeto $wpdb */
      $done = $wpdb -> insert(
        $name_table,        # Nombre de la tabla en la base de datos
        $reservation_data,  # Nombre del Array que contiene los datos Sanitizados
        $data_types         # Nombre del Array con los tipos de datos que vamos a insertar en la tabla
      );
      # To Debug
      # echo '<code>Inserta <pre>'; var_dump( $done ); echo '</pre></code>';

      /* Realizamos la redirección (Así evitamos además que haga multiples registros al actualizar la página) */
      $url = get_page_by_title( 'Gracias por su reserva' );   # Título de la página de agradecimiento creada desde el ADMIN
      wp_redirect( get_permalink( $url -> ID ) );
      exit();

    }
  }

  /* Aplica la Sanitización de tipo 'sanitize_text_field' de WordPress */
  function lapizzeria_sanitize_text_field( $field_name ) {
    return sanitize_text_field( $_POST[ $field_name ] );
  }

  add_action( 'init', 'lapizzeria_save' );    # Hook al init (Se ejecuta todo el tiempo en el que WordPress este ejecutandose)
?>
