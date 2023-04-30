<main class="contenedor seccion contenido-centrado">
      <h3><?php echo $entrada->titulo ?></h3>
      
      <picture>
        <img loading="lazy" src="/imagenes/<?php echo $entrada->imagen ?>" alt="Texto Entrada blog">
      </picture>
      <p class="informacion-meta">Escrito el: <span><?php echo(date("d-m-Y", strtotime($entrada->fecha))); ?></span> Por: <span><?php echo obtenerNombre(extraerPorId($entrada->autor, $vendedores)); 
      ?></span></p>
      <div class="resumen-propiedad">     
        <p><?php echo $entrada->entrada ?></p>
      </div>
    </main>