    <footer>
      <?php
      $args = array(
        'theme_location'  => 'header-menu',
        'container'       => 'nav',         # Etiqueta que lo contendrá (puede ser cualquiera)
        'after'           => '<span class="separator"> | </span>',  # Lo que se imprimirá después de cada uno de los enlaces
        'container_class' => ''    # Clase de la etiqueta que lo contendrá
      );

      wp_nav_menu( $args );
      ?>
      <div class="location">
        <p><?php echo esc_html( get_option( 'lapizzeria_direccion' ) ); ?></p>
        <p>Teléfono: <?php echo esc_html( get_option( 'lapizzeria_telefono' ) ); ?></p>
      </div>
      <p class="copyright">
        Todos los derechos reservados <?php echo date( 'Y' ); ?>.
      </p>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
