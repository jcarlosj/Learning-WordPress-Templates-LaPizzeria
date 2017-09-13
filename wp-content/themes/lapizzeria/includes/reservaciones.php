<?php
  /* Arquitectura por Eventos:
     Si un usuario llena un formulario se dispara un evento y este realiza las
     tareas que tenga que hacer */

  /* Evento Guardar */
  function lapizzeria_save() {
    if( isset( $_POST[ 'enviar' ] ) && $_POST[ 'save' ] == 1 ) {
      /* Recogemos los datos del formulario */
      echo '<code>Formulario <pre>'; var_dump( $_POST ); echo '</pre></code>';

      /* Sanitizando datos del formulario (Cuando entran los datos) */
      $reservation_data = array(
        'nombre'   => lapizzeria_sanitize_text_field( 'nombre' ),
        'fecha'    => lapizzeria_sanitize_text_field( 'fecha' ),
        'email'    => lapizzeria_sanitize_text_field( 'email' ),
        'telefono' => lapizzeria_sanitize_text_field( 'telefono' ),
        'mensaje'  => lapizzeria_sanitize_text_field( 'mensaje' )
      );

      /* Recogemos los datos del formulario */
      echo '<code>Sanatizado <pre>'; var_dump( $reservation_data ); echo '</pre></code>';

    }
  }

  /* Aplica la Sanitización de tipo 'sanitize_text_field' de WordPress */
  function lapizzeria_sanitize_text_field( $field_name ) {
    return sanitize_text_field( $_POST[ $field_name ] );
  }

  add_action( 'init', 'lapizzeria_save' );    # Hook al init
?>
