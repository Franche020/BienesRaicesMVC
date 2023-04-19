<?php

namespace MVC;

class Router {  

    public $rutasGet = [];
    public $rutasPost = [];

    public function get ($url , $fn) {
        $this->rutasGet[$url] = $fn;
    }
    public function post ($url , $fn) {
        $this->rutasPost[$url] = $fn;
    }
    
    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPost[$urlActual] ?? null;
        }


        if ($fn) {
            // La url existe y hay funcion asociadas
            call_user_func($fn, $this);
            
        } else {
            echo 'Página no encontrada';
        }
    }

    // Muestra una vista
    public function render($view , $datos = []){
        foreach($datos as $key=>$value){
            $$key = $value;
        }

        ob_start(); // Almacena en memoria lo queviene a continuacion
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();// Lo limpia de la memoria una vez ha sido asignado a contenido
        include __DIR__ . "/views/layout.php";
    }
}