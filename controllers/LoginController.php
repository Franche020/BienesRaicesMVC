<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController{

    public static function login (Router $router){

        $errores = [];
        $email = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Admin($_POST);  
            $email = $auth->email;

            $errores = $auth->validar();

            if (empty($errores)){
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if (!$resultado){
                    //Verificacion (mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    // Verificar el password
                    $auntenticado = $auth->comprobarPassword($resultado);
                    // Autenticar el usuario
                    if ($auntenticado) {
                        // Autenticar al usuario
                        $auth->autenticar();
                    } else {
                        // Password incorrecto (Mensaje de error)
                        $errores = Admin::getErrores();
                    }
                }

            }
        }

        $router->render('/auth/login', [
            'errores' => $errores,
            'email' => $email
        ]);
    }
    public static function logout (){
        session_start();
        
        $_SESSION = [];

        header('location: /');
    }
}

