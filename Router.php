<?php

namespace MVC;

class Router {  

    public $rutasGet = [];
    public $rutasPost = [];

    public function get ($url , $fn) {
        $this->rutasGet[$url] = $fn;
    }
    
    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGet[$urlActual] ?? null;
        }


        if ($fn) {
            // La url existe y hay funcion asociadas
            call_user_func($fn, $this);
            
        } else {
            echo 'Página no encontrada';
        }
    }

    // Muestra una vista
    public function render($view){
        include __DIR__ . "/views/$view.php";
    }
}