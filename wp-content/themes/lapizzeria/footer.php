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
        <p>Avenida Siempreviva 742, Springfield</p>
        <p>Teléfono: +1-92-456-7890</p>
      </div>
      <p class="copyright">
        Todos los derechos reservados <?php echo date( 'Y' ); ?>.
      </p>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
