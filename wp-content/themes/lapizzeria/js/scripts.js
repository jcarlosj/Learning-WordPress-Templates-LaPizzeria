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
      adjustBoxes();  /* Se ajustan cada que se hace un resize */

      /* console .log( $( document ) .width() + ' px'); */
      if( $( document ) .width() >= breakpoint ) {
        $( 'nav.site-menu' ) .show();
      }
      else {
        $( 'nav.site-menu' ) .hide();
      }

    });   // $( window )

    /* Fluidbox */
    jQuery( '.gallery a' ) .each( function() {
      jQuery( this ) .attr({'data-fluidbox': ''});
    });

    if( jQuery( '[data-fluidbox]' ) .length > 0 ) {
      jQuery( '[data-fluidbox]' ) .fluidbox();
    }

    /* Funci[on para ajustar las cajas] */
    function adjustBoxes() {
      /* Ajustar las cajas de información adicional de la página de nosotros */
      var images = $( '.box-image' );   /* Obtenemos todas las imagenes del DOM */
      /* console .log( images ); */

      /* Validamos la existencia de las imagenes */
      if( images .length > 0 ) {
        var height_image = images[ 0 ] .height;  /* Capturamos la altura de una imagen, no importa cual */
        var boxes = $( 'div.box-content' );     /* Obtenemos todas las Cajas del DOM */
        /* console .log( boxes ); */

        $( boxes ) .each( function( item, htmlElement ) {
          $( htmlElement ) .css({
            'height' : height_image + 'px'
          });
        });
      }
    }
});   // $( document )
