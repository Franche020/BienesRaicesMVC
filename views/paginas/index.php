<main class="contenedor seccion">
      <h1>Más Sobre Nosotros</h1>

      <?php include 'iconos.php'; ?>

    </main>

    <section class="seccion contenedor">
      <h2>Casas y apartamentos en Venta</h2>
      
      <?php 
      $limite = 3;
      include 'listado.php'; 
      ?>

      <div class="ver-todas alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
      </div>
    </section>

    <section class="imagen-contacto">
      <h2>Encuentra la casa de tus sueños</h2>
      <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la mayor brevedad</p>
      <a href="contacto.php" class="boton-amarillo">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
      <section class="blog">
        <h3>Nuestro Blog</h3>
  
        <?php include "entradas.php" ?>  

      </section>

      <section class="testimoniales">
        <h3>testimoniales</h3>

        <div class="testimonial">
          <blockquote>
            El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
          </blockquote>
          <p>-Francisco J. Casado</p>
        </div>
      </section>
    </div> <!--.contenedor seccion-->