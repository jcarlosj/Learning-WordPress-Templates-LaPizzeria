<?php
  function lapizzeria_ajustes() {
    /* Creamos el item de menú dentro del ADMIN de WordPress */
    add_menu_page(
      'La Pizzería',            # Título: nombre de la página
      'La Pizzería Ajustes',    # Menú: nombre del enlace del menú
      'administrator',          # Usuario: "Capability" usuario que lo puede ver
      'lapizzeria_ajustes',     # Slug del ítem de menú que estamos creando.
      'lapizzeria_opciones',    # Función que se va a llamar.
      '',                       # Ícono
      20                        # Posición en el menú.
    );
    /* Creamos el sub-menú del item de menú principal dentro del ADMIN de WordPress */
    add_submenu_page(
      'lapizzeria_ajustes',     # Parent Slug del ítem de menú anterior
      'Reservaciones',          # Nombre de la página
      'Reservaciones',          # Título del menú
      'administrator',          # Usuario: "Capability" usuario que lo puede ver
      'lapizzeria_reservaciones', # Slug del ítem del submenú que estamos creando
      'lapizzeria_reservaciones'  # Callback o nombre de la función
    );
    /* Hook: Indicar a WordPress que tenemos campos de formulario para nuestro
             Tema (o plantilla) de Ajustes
    */
    add_action( 'admin_init', 'lapizzeria_registrar_opciones' );

  }

  add_action( 'admin_menu', 'lapizzeria_ajustes' );   # Hook al menu de administración de WordPress

  /* Registra las opciones que va a usar el formulario (Una por cada campo) */
  function lapizzeria_registrar_opciones() {
    register_setting(
      'lapizzeria_opciones_grupo',    # Nombre con el que se agrupa cada campo
      'lapizzeria_direccion'          # Nombre del campo del formulario
    );
    register_setting(
      'lapizzeria_opciones_grupo',    # Nombre con el que se agrupa cada campo
      'lapizzeria_telefono'           # Nombre del campo del formulario
    );

    register_setting(
      'lapizzeria_opciones_googlemaps',    # Nombre con el que se agrupa cada campo
      'lapizzeria_googlemaps_latitud'      # Nombre del campo del formulario
    );
    register_setting(
      'lapizzeria_opciones_googlemaps',    # Nombre con el que se agrupa cada campo
      'lapizzeria_googlemaps_longitud'     # Nombre del campo del formulario
    );
    register_setting(
      'lapizzeria_opciones_googlemaps',    # Nombre con el que se agrupa cada campo
      'lapizzeria_googlemaps_zoom'         # Nombre del campo del formulario
    );
    register_setting(
      'lapizzeria_opciones_googlemaps',    # Nombre con el que se agrupa cada campo
      'lapizzeria_googlemaps_apikey'       # Nombre del campo del formulario
    );
  }

  /* Crea página de Administración para los ajustes */
  function lapizzeria_opciones() {
    /* Despliega el tema o la vista para Opciones
       Cuando se crean páginas de opciones el 'action' del 'form' siempre debe ser 'options.php'
    */
    ?>
        <div class="wrap">
          <h1>Ajustes "La Pizzería"</h1>
          <?php
            if( isset( $_GET[ 'tab' ] ) ) :
              $active_tab = $_GET[ 'tab' ];
            else:
              $active_tab = 'site';   # Valor por defecto si no viene ningún valor vía GET
            endif;
          ?>

          <h2 class="nav-tab-wrapper">
            <a href="?page=lapizzeria_ajustes&tab=site" class="nav-tab <?php echo $active_tab == 'site' ? 'nav-tab-active' : ''; ?> ">Sitio</a>
            <a href="?page=lapizzeria_ajustes&tab=google-maps" class="nav-tab <?php echo $active_tab == 'google-maps' ? 'nav-tab-active' : ''; ?> ">Google Maps</a>
          </h2>

          <form action="options.php" method="post">
            <?php # var_dump( $active_tab ); ?>

            <?php if( $active_tab == 'site' ) : ?>
              <h2>Sitio</h2>
              <?php
                settings_fields( 'lapizzeria_opciones_grupo' );       # Le indicamos al formulario cual es el grupo de campos que va a usar
                do_settings_sections( 'lapizzeria_opciones_grupo' );  # Le indicamos a WordPress que utilice los campos del grupo
              ?>
              <table id="site" class="form-table">
                <tr valign="top">
                  <th scope="row">Dirección</th>
                  <td>
                    <input type="text" name="lapizzeria_direccion" value="<?php echo esc_attr( get_option( 'lapizzeria_direccion' ) ); ?>" />
                  </td>
                </tr>
                <tr valign="top">
                  <th scope="row">Teléfono</th>
                  <td>
                    <input type="text" name="lapizzeria_telefono" value="<?php echo esc_attr( get_option( 'lapizzeria_telefono' ) ); ?>" />
                  </td>
                </tr>
              </table>    <!-- #site -->

            <?php else: ?>

              <h2>Google Maps</h2>
              <?php
                settings_fields( 'lapizzeria_opciones_googlemaps' );       # Le indicamos al formulario cual es el grupo de campos que va a usar
                do_settings_sections( 'lapizzeria_opciones_googlemaps' );  # Le indicamos a WordPress que utilice los campos del grupo
              ?>
              <table id="google-maps" class="form-table">
                <tr valign="top">
                  <th scope="row">Latitud</th>
                  <td>
                    <input type="text" name="lapizzeria_googlemaps_latitud" value="<?php echo esc_attr( get_option( 'lapizzeria_googlemaps_latitud' ) ); ?>" />
                  </td>
                </tr>
                <tr valign="top">
                  <th scope="row">Longitud</th>
                  <td>
                    <input type="text" name="lapizzeria_googlemaps_longitud" value="<?php echo esc_attr( get_option( 'lapizzeria_googlemaps_longitud' ) ); ?>" />
                  </td>
                </tr>
                <tr valign="top">
                  <th scope="row">Zoom</th>
                  <td>
                    <input type="number" name="lapizzeria_googlemaps_zoom" value="<?php echo esc_attr( get_option( 'lapizzeria_googlemaps_zoom' ) ); ?>" />
                  </td>
                </tr>
                <tr valign="top">
                  <th scope="row">API Key (Google Maps)</th>
                  <td>
                    <input type="text" name="lapizzeria_googlemaps_apikey" value="<?php echo esc_attr( get_option( 'lapizzeria_googlemaps_apikey' ) ); ?>" />
                  </td>
                </tr>
              </table>  <!-- #google-maps -->

            <?php endif; ?>

            <?php submit_button(); ?>
          </form>
        </div>
    <?php
  }

  /* Crea página de Administración para las reservaciones */
  function lapizzeria_reservaciones() {
    /* Despliega el tema o la vista para Reservaciones */
    ?>
        <div class="wrap">
          <h1>Reservaciones</h1>
          <table class="wp-list-table widefat fixed striped">
            <thead>
              <tr>
                <th class="manage-column">ID</th>
                <th class="manage-column">Nombre del cliente</th>
                <th class="manage-column">Fecha de la reservación</th>
                <th class="manage-column">Correo del cliente</th>
                <th class="manage-column">Teléfono del cliente</th>
                <th class="manage-column">Mensaje</th>
                <th class="manage-column">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                /* Acceso a la tabla */
                global $wpdb;   # Clase de acceso a las funciones de CRUD de WordPress
                $name_table = $wpdb -> prefix .'reservaciones'; # Prefijo de la tabla fijado en la configuración inicial

                /* Obtenemos los registros de la misma a través de una consulta */
                $rows = $wpdb -> get_results(
                  "SELECT id, nombre, fecha, correo, telefono, mensaje FROM $name_table ", # Consulta SQL: Soporta cualquier tipo de consulta SQL
                  ARRAY_A         # Indica a $wpdb que nos retorne los datos como un Array Asociativo, por defecto retorna un Array de Objetos.
                );
                # Otras opciones:
                #  - ARRAY_A:  Array Asociativo
                #  - ARRAY_N:  Array Numérico
                #  - OBJECT:   Array Objetos (Si no se pone opción esta es la que queda por defecto)
                #  - OBJECT_K: Array Objetos donde el primer ítem comienza por 1

                /* Imprime los resultados de la consulta en la vista dentro de cada uno de los campos de la tabla */
                foreach ( $rows as $key => $row ) :
              ?>
                  <tr>
                    <td class=""><?php echo $row[ 'id' ]; ?></td>
                    <td class=""><?php echo $row[ 'nombre' ]; ?></td>
                    <td class=""><abbr title="<?php echo $row[ 'fecha' ]; ?>"><?php echo $row[ 'fecha' ]?></abbr></td>
                    <td class=""><?php echo $row[ 'correo' ]; ?></td>
                    <td class=""><?php echo $row[ 'telefono' ]; ?></td>
                    <td class=""><?php echo $row[ 'mensaje' ]; ?></td>
                    <td class="">
                      <a href="#" class="delete-register" data-reservations="<?php echo $row[ 'id' ]; ?>">Eliminar</a>
                    </td>
                  </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th class="manage-column">ID</th>
                <th class="manage-column">Nombre del cliente</th>
                <th class="manage-column">Fecha de la reservación</th>
                <th class="manage-column">Correo del cliente</th>
                <th class="manage-column">Teléfono del cliente</th>
                <th class="manage-column">Mensaje</th>
                <th class="manage-column">Opciones</th>
              </tr>
            </tfoot>
          </table>
        </div>
    <?php
  }
?>
