<main class="contenedor seccion">
    <h1>Registrar Vendedores</h1>

    <a class="boton-verde" href="/admin">Volver</a>

    <?php foreach($errores as $error):  ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/vendedores/crear">
        <?php 
        include 'formulario.php';
         ?>
        <input type="submit" value="Registrar Vendedor" class="boton-verde">
    </form>
</main>