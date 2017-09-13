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

        </div>
    <?php
  }
?>
