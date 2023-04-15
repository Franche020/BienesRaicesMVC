<?php


if(!isset($_SESSION)){
  session_start();
}

$auth = $_SESSION['login'] ?? false;


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/build/css/app.css" />
  </head>
  <body>
    <header class="header <?php echo $inicio ? 'inicio':''; ?>">
      <div class="contenedor contenido-header">
        <div class="barra">
          <a href="/index.php">
            <img class="logo" src="/build/img/logo.svg" alt="Logotipo de bienes raíces" />
          </a>

          <div class="mobile-menu">
            <img src="/build/img/barras.svg" alt="icono menu responsivo">
          </div>

          <div class="derecha">
            <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
            <nav class="navegacion">
              <a href="/nosotros.php">Nosotros</a>
              <a href="/anuncios.php">Anuncios</a>
              <a href="/blog.php">Blog</a>
              <a href="/contacto.php">Contacto</a>
              <?php if(!$auth): ?>
              <a  href="/login.php">Login</a>
            <?php else: ?>
              <a href="/admin/index.php">Administrar</a>
              <a href="/cerrar-sesion.php">Cerrar Sesión</a>
            <?php endif; ?>
              
            </nav>

          </div>
        </div>
        <!-- .Barra-->
        <?php 
          // echo isset($inicio) ? 'inicio' : '';
          echo $inicio ? '<h1>Venta de casas y Apartamentos Exclusivos de Lujo</h1>' : '';
          /*if(isset($inicio)) { ?>
          <h1>Venta de casas y Apartamentos Exclusivos de Lujo</h1>*/
        // <?php } 
        ?>
      </div>
    </header>