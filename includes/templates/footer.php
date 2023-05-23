<?php 

if(!isset($_SESSION)){
  session_start();
}

$auth = $_SESSION['login'] ?? false
?>


<footer class="footer seccion">
      <div class="contenedor contenedor-footer">
        <nav class="navegacion">
          <div>
            <a href="/nosotros">Nosotros</a>
            <a href="/anuncios">Anuncios</a>
            <a href="/blog">Blog</a>
            <a href="/contacto">Contacto</a>
          </div>
          <div class="login">
            <?php if(!$auth): ?>
              <a  href="/login">Login</a>
            <?php else: ?>
              <a href="/admin/index">Administrar</a>
              <a href="/cerrar-sesion">Cerrar Sesión</a>
            <?php endif; ?>
          </div>
        </nav>
      </div>
      <p class="copyright">Todos los derechos reservados. <?php echo date('Y'); ?> &copy</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
  </body>
</html>