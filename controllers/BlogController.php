<?php 

namespace Controllers;

use Model\Blog;
use Model\Vendedor;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController {
    
    public static function index (Router $router){
        $entradas = Blog::all();

        $resultado = $_GET['resultado'] ?? null;
        $resultado = filter_var($resultado,FILTER_VALIDATE_INT) ?? null;

        $vendedores = Vendedor::all();

        $router->render('blog/admin', [
            'entradas' => $entradas,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }
    public static function crear (Router $router){
        $errores = Blog::getErrores();
        $blog = new Blog();
        $vendedores = Vendedor::all();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            // Crea una nueva instancia
            $blog = new Blog($_POST['blog']);
            $image ='';

            /*//* SUBIDA DE ARCHIVOS */
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";

            // Setear la imagen
            // Realiza un resize a la image con intervention
            if ($_FILES['blog']['tmp_name']['imagen']){
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                $blog->setImagen($nombreImagen);
            }

            // Validar
            $errores = $blog->validar();

            if (empty($errores)){

                
            if(empty($errores)) {

                // Crear carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);        
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES.$nombreImagen);

                // Guardar en la base de datos
                $resultado = $blog->guardar();

                // Mensaje de exito o error
                if ($resultado) {
                    // Redireccionar al usuario.
                    
                    header('location: /blog/admin?resultado=1');
                }
            }     
            }

        }
        $router->render('blog/crear', [
            'errores' => $errores,
            'blog' => $blog,
            'vendedores' => $vendedores
        ]);

    }
    public static function actualizar (Router $router){
        $errores = Blog::getErrores();
        $id = validarORedireccionar('blog/admin');
        $blog = Blog::find($id);
        $vendedores = Vendedor::all();

        $imagenOld = $blog->imagen;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $args = $_POST['blog'];

            $blog->sincronizar($args);
                        
            //TODO Imagenes REVISAR
            // Compruebo si se ha subido un archivo
            if ($_FILES['blog']['tmp_name']['imagen']){
                // Genero un nuevo nombre
                $nombreImagen = md5(uniqid(rand(),true)) . ".jpg";
                // Creo una instancia de imagen y agrego el fichero temporal
                $image = Image::make($_FILES['blog']['tmp_name']['imagen']);
                // Ajusto el tamaño de la imagen
                $image->fit(800,600);
                // Asigno el nuevo nombre de imagen al modelo
                $blog->setImagen($nombreImagen);
            }
            $errores = $blog->validar();

            if(empty($errores)) {
                
                // Compruebo si ya existia una imagen
                if ($_FILES['blog']['tmp_name']['imagen']) {
                    // Compruebo que existe la carpeta para crearla si no existe
                    if (!is_dir('imagenes')) {
                        mkdir('imagenes');
                    }
                    // Si la imagen existe la elimino
                    if (file_exists('imagenes/'.$imagenOld)) {
                        // Elimino la imagen anterior
                        unlink('imagenes/'.$imagenOld);
                    }
                    // Guardo la nueva en el servidor
                    $image->save('imagenes/'.$nombreImagen);
                }
                // Guardo el modelo en la DB
                $resultado = $blog->guardar();

                if ($resultado) {
                    header('location: admin?resultado=2');
                }
            }
            
        }
                
        $router->render('blog/actualizar', [
            'errores' => $errores,
            'blog' => $blog,
            'vendedores' => $vendedores
        ]);
    }
    public static function eliminar (Router $router){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'] ?? '';
            $id = filter_var($id,FILTER_VALIDATE_INT);
           
            if ($_POST['tipo'] === 'entrada'){
            $blog = Blog::find($id);
            $resultado = $blog->eliminar();

            if ($resultado) {
                header('location: /blog/admin?resultado=3');
            }
        }
        }

        
    }
}