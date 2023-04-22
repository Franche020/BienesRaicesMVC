<fieldset>
    <legend>Información General</legend>

    <label for"nombre">Nombre:</label>
    <input 
        type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        placeholder="Nombre" 
        value="<?php echo s($vendedor->nombre); ?>">
    
    <label for"apellidos">Apellidos:</label>
    <input 
        type="text" 
        id="apellidos" 
        name="vendedor[apellido]" 
        placeholder="Apellidos" 
        value="<?php echo s($vendedor->apellido); ?>">
    
    </fieldset>
<fieldset>
    <legend>Información Extra</legend>
    <label for"apellidos">Teléfono:</label>
    <input 
    type="tel" 
    id="telefono" 
    name="vendedor[telefono]" 
    placeholder="Teléfono" 
    value="<?php echo s($vendedor->telefono); ?>">
        
</fieldset>