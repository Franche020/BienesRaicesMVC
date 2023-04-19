<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController  {

    public static function index(Router $router) {

        // Muestra el mensaje original de la informacion $_GET y en caso de que no haya datos lo asigna null para evitar errores
        $resultado = $_GET['resultado'] ?? null;

        // Accede a la base de datos y escribe los datos en la variable
        $propiedades = Propiedad::all();
        $resultado = null;

        /* Hace  una llamada a la función del router de render pasándole tanto la ruta de la pagina que va a renderizar, como los
        datos que se van a incluir y en este caso la variable propiedades con la key propiedades */
        $router->render("propiedades/admin", [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();


        if($_SERVER['REQUEST_METHOD'] === 'POST'){

                
            // Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);


            /*//* SUBIDA DE ARCHIVOS */
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la image con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
            

            // Validar
            $errores = $propiedad->validar(); 

            if(empty($errores)) {

                // Crear carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);        
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES.$nombreImagen);

                // Guardar en la base de datos
                $resultado = $propiedad->guardar();

                // Mensaje de exito o error
                if ($resultado) {
                    // Redireccionar al usuario.
                    
                    header('location: /admin?resultado=1');
                }
            }    
        }

        $router->render('propiedades/crear' , [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar() {
        echo "Propiedad actualizar";
    }

}