/* JavaScript File */

/* Implementación del Mapa usando la API de Google Maps V3 */
var map;
function initMap() {
  /* Creamos un objeto con las coordenadas donde deseamos visualizar el Mapa */
  var latLng = {
    lat: 4.653548,
    lng: -74.072510
  };
  map = new google.maps.Map(document.getElementById( 'location-map' ), {
    center: latLng,
    zoom: 14
  });
  /* Agregamos el Pin al Mapa */
  var marker = new google .maps .Marker({
    position: latLng,
    map: map,
    title: 'La Pizzería'
  });
}

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

      /* Ajusta Mapa */
      var map = $( '#location-map' );
      if( map .length > 0 ) {   /* Si existe el mapa */
        if( $( document ) .width() >= breakpoint ) {
          /* Other Devices */
          adjustMap( 0 );    /* Se ajusta el Mapa cada que se hace un resize */
        }
        else {
          /* Mobile First */
          adjustMap( 400 );
        }

      }

      /* Ajusta El menú de navegación
         console .log( $( document ) .width() + ' px');
      */
      if( $( document ) .width() >= breakpoint ) {
        $( 'nav.site-menu' ) .show();
      }
      else {
        $( 'nav.site-menu' ) .hide();
      }

    });   // $( window )

    /* Función para ajustar el Mapa */
    function adjustMap( heightMap ) {
      var heightElementSection = 0;
      if( heightMap == 0 ) {
        /* Miramos la altura que tiene el TAG de la sección "Localización y Reservas" */
        var elementSection = $( '.location-and-reservation' );
        heightElementSection = elementSection .height();

      }
      else {
        heightElementSection = heightMap;
      }
      console .log( 'Altura ' + heightElementSection );
      /* Le indicamos al mapa que debe tener la misma altura del elemento de la sección */
      $( '#location-map' ) .css({ 'height' : heightElementSection + 'px' });
    }

    /* Función para ajustar las cajas */
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

    /* Fluidbox */
    jQuery( '.gallery a' ) .each( function() {
      jQuery( this ) .attr({'data-fluidbox': ''});
    });

    if( jQuery( '[data-fluidbox]' ) .length > 0 ) {
      jQuery( '[data-fluidbox]' ) .fluidbox();
    }

});   // $( document )
