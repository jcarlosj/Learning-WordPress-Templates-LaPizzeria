/* JavaScript File */

/* jQuery */
$ = jQuery.noConflict();    /* Elimina Error de Referencia cuando el $ no aparece definido */

$( document ) .ready( function() {
    /* Agrega funcionalidad al botón para mostrar u ocultar el menú */
    $( '.button-mobile-menu a' ) .on( 'click', function() {
      $( 'nav.site-menu' ) .toggle( 'slow' );
    });   // ( '.button-mobile-menu a' )

    /* Muestra u oculta el menú al redimensionar la ventana del navegador */
    var breakpoint = 768;
    $( window ) .resize( function() {
      /* console .log( $( document ) .width() + ' px'); */
      if( $( document ) .width() >= breakpoint ) {
        $( 'nav.site-menu' ) .show();
      }
      else {
        $( 'nav.site-menu' ) .hide();
      }
    });   // $( window )
});   // $( document )
