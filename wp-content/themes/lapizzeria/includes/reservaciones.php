<?php
  /* Arquitectura por Eventos:
     Si un usuario llena un formulario se dispara un evento y este realiza las
     tareas que tenga que hacer */

  /* Evento Guardar */
  function lapizzeria_save() {
    if( isset( $_POST[ 'enviar' ] ) && $_POST[ 'save' ] == 1 ) {
      /* Recogemos los datos del formulario */
      echo '<code><pre>'; var_dump( $_POST ); echo '</pre></code>';
      
    }
  }

  add_action( 'init', 'lapizzeria_save' );    # Hook al init
?>
