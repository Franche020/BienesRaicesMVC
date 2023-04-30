/* 
Para hacer funcionar el código al formmulario le he asignado con PHP las ID: id="<?php echo "form". $propiedad['id']?>"
y a los botones submit la ID: id="<?php echo "submit". $propiedad['id']?>" de esta forma ambas ID son unicas y referenciadas 
a la id de la base de datos
*/

// constante hacia los botones eliminar a los que previamente se les ha añadido la clase eliminar
const eliminarPropiedad = document.querySelectorAll('.eliminar-propiedad');
const eliminarVendedor = document.querySelectorAll('.eliminar-vendedor');
const eliminarBlog = document.querySelectorAll('.eliminar-blog');

eliminarPropiedad.forEach(boton => {
    
    boton.addEventListener('click', function(e){
        // Prevengo ejecucion por defecto
        e.preventDefault();
        // Creo las constantes para la ID y para el mensaje
        const id = parseInt(e.target.id.substring(6));
        const mensaje = `¿Quieres eliminar la propiedad con la ID ${id}`
        
        // Condiciono el resultado de la ventana modal a la salida
        if (confirm(mensaje)) {
            document.getElementById(boton.form.attributes.id.value).submit();
        }
    });

});

eliminarVendedor.forEach(boton => {
    
    boton.addEventListener('click', function(e){
        // Prevengo ejecucion por defecto
        e.preventDefault();
        // Creo las constantes para la ID y para el mensaje
        const id = parseInt(e.target.id.substring(6));
        const mensaje = `¿Quieres eliminar el Vendedor con la ID ${id}`
        
        // Condiciono el resultado de la ventana modal a la salida
        if (confirm(mensaje)) {
            document.getElementById(boton.form.attributes.id.value).submit();
        }
    });

});
eliminarBlog.forEach(boton => {
    
    boton.addEventListener('click', function(e){
        // Prevengo ejecucion por defecto
        e.preventDefault();
        // Creo las constantes para la ID y para el mensaje
        const id = parseInt(e.target.id.substring(6));
        
        // Obtengo el nombre de la entrada
        const titulo = document.getElementById(`blog${id}`).innerHTML;
        
        const mensaje = `¿Quieres eliminar la entrada de blog: "${titulo}"`
        
        // Condiciono el resultado de la ventana modal a la salida
        if (confirm(mensaje)) {
            document.getElementById(boton.form.attributes.id.value).submit();
        }
    });

});