/* JS File (Reservaciones) */
$ = jQuery .noConflict();

$( document ) .ready( function() {
  /* Obtener la URL de admin-ajax.php */
  console .log( delete_reservation .ajax_url );     /* 'delete_reservation' retorna el objeto JS generado en el 'function.php' */

  $( '.delete-register' ) .on( 'click', function( event ) {
    event .preventDefault();        /* preventDefault() es una función de JavaScript previene el evento por defecto que se registre en un formulario, enlace o cualquier elemento del HTML */

    /* this hace referencia al elemento que lo ejecuta */
    var id = $( this ) .attr( 'data-reservations' );  /* Obtenemos el ID del elemento en el atributo especificado */
    console .log( id );
  });

});
