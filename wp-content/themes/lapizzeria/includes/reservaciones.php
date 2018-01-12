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

  /* Evento Guardar */
  function lapizzeria_delete() {

    /* Valida que los datos llegaron por POST */
    if( isset( $_POST[ 'tipo_registro' ] ) ) {
      /* Valida que el tipo de registro es Eliminar */
      if( $_POST[ 'tipo_registro' ] == 'eliminar' ) {

        # Clase de WordPress para crear tablas personalizadas y consultas en la Base de Datos (Funciones de CRUD de WordPress)
        global $wpdb;

        $name_table = $wpdb -> prefix .'reservaciones'; # Prefijo de la tabla fijado en la configuración inicial
        $registration_id = $_POST[ 'id' ];

        /* Elimina */
        $response = $wpdb -> delete(
          $name_table,        # Nombre de la tabla (Obligatorio)
          array(              # WHERE de la consulta (Obligatorio)
            'id' => $registration_id    # ID del registro a eliminar
          ),
          array(              # Tipo de dato (Opcional)
            '%d'              # El tipo de dato que se esta pasando en el WHERE es un número decimal
          )
        );

        /* Prepara mensajes de resuesta */
        if( $response == 1 ) {
          $response = array(
            'respuesta' => 1,
            'id'        => $registration_id
          );
        }
        else {
          $response = array(
            'respuesta' => 'error'
          );
        }

      }
    }

    # TO DO: Falta elimnar registro en la vista

    die( json_encode( $response ) );      # Todo lo que se reciba por POST se devuelve como un objeto JSON
                                          # Siempre debe ponerse de lo contrario no va a funcionar pues los llamados con AJAX lo requieren
  }
  /* Agrega las acciones creadas a la zona de administración de WordPress */
  add_action(
    'wp_ajax_lapizzeria_delete',  # prefijo 'wp_ajax_' y nombre de la función (así WordPress le da tratamiento de petición AJAX)
    'lapizzeria_delete'
  );


  /* Aplica la Sanitización de tipo 'sanitize_text_field' de WordPress */
  function lapizzeria_sanitize_text_field( $field_name ) {
    return sanitize_text_field( $_POST[ $field_name ] );
  }

  add_action( 'init', 'lapizzeria_save' );    # Hook al init (Se ejecuta todo el tiempo en el que WordPress este ejecutandose)
?>
