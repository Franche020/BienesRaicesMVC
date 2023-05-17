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
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin'
        ,'/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar'
        ,'/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar'
        ,'/blog/admin','/blog/crear','/blog/actualizar  ','/blog/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGet[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPost[$urlActual] ?? null;
        }

        // proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header('location: /');
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