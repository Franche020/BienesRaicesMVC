<main class="contenedor seccion">

<a class="boton-verde" href="/blog/admin">Volver</a>

<?php foreach($errores as $error):  ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
<?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include "formulario.php"; ?>
        <input type="submit" value="Actualizar Entrada" class="boton-amarillo">
    </form>

</main>