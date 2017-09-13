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

  }

  add_action( 'admin_menu', 'lapizzeria_ajustes' );   # Hook al menu de administración de WordPress

  /* Crea página de Administración para los ajustes */
  function lapizzeria_opciones() {
    ?>
        <div class="wrap">
          <h1>Ajustes</h1>

        </div>
    <?php
  }

  /* Crea página de Administración para las reservaciones */
  function lapizzeria_reservaciones() {
    ?>
        <div class="wrap">
          <h1>Reservaciones</h1>
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

            # To Debug: Verificamos que todos los registros sean extraidos de la Base de datos.
            #           Todos estos como un Array de Objetos
            echo '<pre>'; var_dump( $rows ); echo '</pre>';

          ?>
        </div>
    <?php
  }
?>
