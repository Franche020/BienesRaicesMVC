<?php
namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController{
    public static function crear (Router $router){
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);
        
            // Validar que no haya campos vacíos
            $errores = $vendedor->validar();
        
            if(empty($errores)) {
                $resultado = $vendedor->guardar();   
                if ($resultado){
                    header('location: /admin?resultado=1');
                }
            }
        }

        $router->render('../views/vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar (Router $router){
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');

        // Obtener datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Asignar los valores
            $args = $_POST['vendedor'];
        
            // Sincronizar 
            $vendedor->sincronizar($args);
        
            // Validacion
            $errores = $vendedor->validar();
        
            if(empty($errores)) {
                $resultado = $vendedor->guardar();
                if ($resultado){
                    header('location: /admin?resultado=2');
                }
            }
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar (Router $router){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            // Valida el ID
            $id = $_POST['id'];
            $id = filter_var($id,FILTER_VALIDATE_INT);

            if ($id){
                // Valida el tipo a eliminar
                $tipo = $_POST['tipo'];
                if (validarTipoDato($tipo)){
                    $vendedor = Vendedor::find($id);
                    $resultado = $vendedor->eliminar();

                    if ($resultado){
                        header('location: /admin?resultado=3');
                    }
                }
            }
        }
    }
}