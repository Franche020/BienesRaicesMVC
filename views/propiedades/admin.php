
<main class="contenedor seccion">
    <h1>Administrador de bienes raíces</h1>

    <?php 
    if($resultado){
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje) { ?> 
            <p class="alerta exito"> <?php echo s($mensaje) ?> </p>
        <?php 
        }
    } ?>
 
    
    <div class="botones-admin">
    <a class="boton-verde" href ="/propiedades/crear">Nueva Propiedad</a>
    <a class="boton-amarillo" href ="/vendedores/crear">Nuevo Vendedor</a>
    <a class="boton-verde alinear-derecha" href ="/blog/admin">Administracion del Blog</a>
    </div>

    <h2>Propiedades</h2>

    <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
    <!-- Mostrar los resultados -->
            <tbody> 

            <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id;?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><div><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="<?php echo($propiedad->imagen==='null')? "Imagen Propiedad" : "Imagen no disponible";  ?>"></div></td>
                    <td><?php echo $propiedad->precio . "$" ?></td>
                    <td>
                        <form method="POST" class="w-100" id="<?php echo "form". $propiedad->id?>" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block eliminar-propiedad" value="Eliminar" id="<?php echo "submit". $propiedad->id?>">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
    <!-- Mostrar los resultados -->
            <tbody> 

            <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id;?></td>
                    <td><?php echo $vendedor->nombre; ?></td>
                    <td><?php echo $vendedor->apellido;?></td>
                    <td><?php echo $vendedor->telefono;?></td>
                    <td>
                        <form method="POST" class="w-100" id="<?php echo "form". $vendedor->id?>" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo  $vendedor->id?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block eliminar-vendedor" value="Eliminar" id="<?php echo "submit". $vendedor->id?>">
                        </form>
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
    </table>
</main>