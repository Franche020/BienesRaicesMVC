
<fieldset>
            <legend>Información General</legend>

            <label for"titulo">Titulo:</label>
            <input 
                type="text" 
                id="titulo" 
                name="propiedad[titulo]" 
                placeholder="Título Propiedad" 
                value="<?php echo s($propiedad->titulo); ?>">

            <label for"precio">Precio:</label>
            <input 
                type="number"
                step="0.01"
                maxlength="12"
                id="precio" 
                name="propiedad[precio]" 
                placeholder="Precio Propiedad" 
                value="<?php echo S($propiedad->precio); ?>">

            <label for"imagen">Imagen:</label>
            <input 
                type="file" 
                id="imagen" 
                name="propiedad[imagen]" 
                accept="image/jpeg, image/png">

            <?php if ($propiedad->imagen): ?>
                <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-actualizar">
            <?php endif; ?>
            <label for="descripcion">Descripción</label>
            <textarea
                id="descripcion" 
                name="propiedad[descripcion]"
                ><?php echo s($propiedad->descripcion);?></textarea>
             
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for"habitaciones">Habitaciones</label>
            <input 
                type="number" 
                id="habitaciones" 
                name="propiedad[habitaciones]" 
                placeholder="Numero Habitaciones" 
                min="1" 
                value="<?php echo s($propiedad->habitaciones); ?>">

            <label for="wc">Baños y aseos</label>
            <input 
                type="number" 
                id="wc" 
                name="propiedad[wc]" 
                placeholder="Numero Baños/Aseos" 
                min="1" 
                value="<?php echo s($propiedad->wc); ?>">

            <label for="estacionamiento">Plazas aparcamiento</label>
            <input 
                type="number" 
                id="estacionamiento" 
                name="propiedad[estacionamiento]" 
                placeholder="Numero plazas aparcamiento" 
                min="1" 
                value="<?php echo s($propiedad->estacionamiento); ?>">

        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <label for="vendedor">Vendedor</label>
            <select name="propiedad[vendedorId]" id="vendedor">
                <option selected disabled value="">--- Seleccione ---</option>
                <?php foreach($vendedores as $vendedor) :?>
                <option
                <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected': '' ?>
                value="<?php echo(s($vendedor->id)); ?>"><?php echo(s($vendedor->nombre). ' ' .s($vendedor->apellido)); ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>