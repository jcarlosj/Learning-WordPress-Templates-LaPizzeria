/* JS File (Reservaciones) */
$ = jQuery .noConflict();

$( document ) .ready( function() {

  /* Obtener la URL de admin-ajax.php */
  //console .log( delete_reservation .ajax_url );     /* 'delete_reservation' retorna el objeto JS generado en el 'function.php' */

  $( '.delete-register' ) .on( 'click', function( event ) {
    event .preventDefault();        /* preventDefault() es una función de JavaScript previene el evento por defecto que se registre en un formulario, enlace o cualquier elemento del HTML */

    /* this hace referencia al elemento que lo ejecuta */
    var id = $( this ) .attr( 'data-reservations' );  /* Obtenemos el ID del elemento en el atributo especificado */
    // console .log( id );

    swal({
      title: '¿Esta seguro?',
      text: "Esta acción no se puede deshacer!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminalo!',
      cancelButtonText: 'Cancelar'
    })
    .then( ( result ) => {

      if ( result .value ) {
        /* Crea petición AJAX */
        $.ajax({
          type: 'post',     /* Tipo de petición */
          data: {           /* El conjunto de datos que se desean enviar */
              'action' : 'lapizzeria_delete',     /* nombre de la función a ejecutar la acción */
              'id'     : id,                      /* ID del registro que vamos a eliminar */
              'tipo_registro' : 'eliminar'
          },
          url: delete_reservation .ajax_url,      /* URL del archivo PHP que va a ejecutar la acción (que se va a encargar de esta petición AJAX) */
          success : function( data ) {            /* Se ejecutará cuando la petición al archivo de AJAX sea correcta */
            console .log( data );                 /* Datos que recibimos como respuesta en un objeto JSON */

            var resultado = JSON .parse( data );     /* Convierte el String JSON a un Objeto JavaScript */

            if( resultado .respuesta == 1 ) {
              /* Buscamos el objeto del DOM que deseamos remover */
              $( '[data-reservations="' + resultado .id + '"]' ) .parent() .parent() .remove();

              /* Despliega mensaje emergente SweetAlert 2 */
              swal(
                'Reserva Eliminada',
                'Se eliminó el registro correctamente!',
                'success'       /* Define el tipo de Alerta en SweetAlert 2 */
              );
            }

          }
        }); /* $.ajax */
      }   /* if ( result .value ) */

    }); /* swal/then */

  });

});
