<?php

?>
<main class="contenedor seccion">
<h1>Administracion del Blog</h1>

<?php 
    if(isset($resultado)){
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje) { ?> 
            <p class="alerta exito"> <?php echo s($mensaje) ?> </p>
        <?php 
        }
    } ?>

<a class="boton-verde" href="/admin">Volver</a>
<a class="boton-verde" href="/blog/crear">Crear entrada</a>

<h2>Entradas</h2>

<?php foreach($entradas as $entrada) { ?>
<article class="entrada-blog">
<div class="imagen">
    <a href="../entrada?id=<?php echo $entrada->id ?>">
        <picture>
            <img loading="lazy" src="/imagenes/<?php echo $entrada->imagen ?>" alt="Texto Entrada blog">
        </picture>
    </a>
</div> <!--.imagen-->

<div class="texto-entrada">
  <a href="../entrada?id=<?php echo $entrada->id ?>">
    <h4 id="<?php echo "blog".$entrada->id; ?>"><?php echo $entrada->titulo ?></h4>
    <p class="informacion-meta">Escrito el: <span><?php echo(date("d-m-Y", strtotime($entrada->fecha))); ?></span> por: <span>
      <?php echo obtenerNombre(extraerPorId($entrada->autor, $vendedores)); 
      ?></span></p>
  </a>
  <div class="botones-admin__blog">
    <form method="POST" class="w-100" id="<?php echo "form". $entrada->id?>" action="/blog/eliminar">
      <input type="hidden" name="id" value="<?php echo  $entrada->id?>">
      <input type="hidden" name="tipo" value="entrada">
      <input type="submit" class="boton-rojo-block eliminar-blog" value="Eliminar" id="<?php echo "submit". $entrada->id?>">
    </form>
    <a href="actualizar?id=<?php echo $entrada->id ?>" class="boton-amarillo">Actualizar</a>
  </div>

</article>
<?php } ?>
</main>