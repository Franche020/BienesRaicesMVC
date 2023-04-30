<main class="contenedor seccion contenido-centrado">

      <h3><?php echo $propiedad->titulo;?></h3>

        <img loading="lazy" src="<?php echo 'imagenes/'.$propiedad->imagen; ?>" alt="Imagen propiedad <?php echo $propiedad->titulo; ?>" />

      <div class="resumen-propiedad">
        <p class="precio" ><?php echo number_format($propiedad->precio,2,'.',',').'$'; ?></p>
        <ul class="iconos-caracteristicas">
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC" />
            <p><?php echo $propiedad->wc;?></p>
          </li>
          <li>
            <img
            class="icono"
              loading="lazy"
              src="build/img/icono_estacionamiento.svg"
              alt="icono aparcamiento"
            />
            <p><?php echo $propiedad->estacionamiento;?></p>
          </li>
          <li>
            <img
            class="icono"
              loading="lazy"
              src="build/img/icono_dormitorio.svg"
              alt="Icono Dormitorios"
            />
            <p><?php echo $propiedad->habitaciones;?></p>
          </li>
        </ul>
        <p><?php echo $propiedad->descripcion;?></p>
      </div>

    </main>