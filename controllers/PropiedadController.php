<?php

namespace Controllers;
use MVC\Router;

class PropiedadController  {

    public static function index(Router $router) {
        $router->render("propiedades/admin");
    }

    public static function crear() {
        echo "Propiedad crear";
    }

    public static function actualizar() {
        echo "Propiedad actualizar";
    }

}