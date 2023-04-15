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
            <a href="/nosotros.html">Nosotros</a>
            <a href="/anuncios.html">Anuncios</a>
            <a href="/blog.html">Blog</a>
            <a href="/contacto.html">Contacto</a>
          </div>
          <div class="login">
            <?php if(!$auth): ?>
              <a  href="/login.php">Login</a>
            <?php else: ?>
              <a href="/admin/index.php">Administrar</a>
              <a href="/cerrar-sesion.php">Cerrar Sesión</a>
            <?php endif; ?>
          </div>
        </nav>
      </div>
      <p class="copyright">Todos los derechos reservados. <?php echo date('Y'); ?> &copy</p>
    </footer>

    <script src="/build/js/bundle.min.js"></script>
  </body>
</html>