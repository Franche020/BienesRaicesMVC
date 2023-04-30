<?php foreach($entradas as $entrada) { ?>
          <article class="entrada-blog">
          <div class="imagen">
              <a href="entrada">
                  <picture>
                      <img loading="lazy" src="/imagenes/<?php echo $entrada->imagen ?>" alt="Texto Entrada blog">
                  </picture>
              </a>
          </div> <!--.imagen-->

          <div class="texto-entrada">
            <a href="entrada?id=<?php echo $entrada->id;?>">
              <h4><?php echo $entrada->titulo ?></h4>
              <p class="informacion-meta">Escrito el: <span><?php echo(date("d-m-Y", strtotime($entrada->fecha))); ?></span> por: <span>
                <?php echo obtenerNombre(extraerPorId($entrada->autor, $vendedores)); 
                ?></span></p>
              <p><?php echo $entrada->entrada." ..."; ?><b>Leer mas</b></p>
            </a>
          </div>
          </article>
        <?php } ?>