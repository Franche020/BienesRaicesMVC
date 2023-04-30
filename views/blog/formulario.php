<fieldset>
    <legend>Información General</legend>

    <label for"titulo">Titulo:</label>
    <input 
        type="text" 
        id="titulo" 
        name="blog[titulo]" 
        placeholder="Título Entrada" 
        value="<?php echo s($blog->titulo); ?>">
        
        <label for="entrada">Descripción</label>
    <textarea
        id="entrada" 
        name="blog[entrada]"
        ><?php echo s($blog->entrada);?></textarea>
        


    <label for="imagen">Imagen:</label>
    <input 
        type="file" 
        id="imagen" 
        name="blog[imagen]" 
        accept="image/jpeg, image/png">

    <?php if ($blog->imagen): ?>
        <img src="/imagenes/<?php echo $blog->imagen; ?>" class="imagen-actualizar">
    <?php endif; ?>
    <label for="autor">Autor:</label>
    <select name="blog[autor]" id="autor">
        <option selected disabled value="">--- Seleccione ---</option>
        <?php foreach($vendedores as $vendedor) :?>
        <option
        <?php echo $blog->autor === $vendedor->id ? 'selected': '' ?>
        value="<?php echo(s($vendedor->id)); ?>"><?php echo(s($vendedor->nombre). ' ' .s($vendedor->apellido)); ?></option>
        <?php endforeach; ?>
    </select>

        
</fieldset>

<!--//* ############## TEXT EDITOR ################## -->

<script src="/build/js/ckeditor.js"></script>
<script>
ClassicEditor
    .create( document.querySelector( 'textarea[name="blog[entrada]"]' ) )
    .catch( error => {
    console.error( error );
    } );
</script>