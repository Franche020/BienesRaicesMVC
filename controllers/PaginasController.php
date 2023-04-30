<?php

namespace Controllers;

use Model\Blog;
use Model\Propiedad;
use MVC\Router;
use Model\Vendedor;

class PaginasController {
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $entradas = Blog::getIndex(2,100);
        $vendedores = Vendedor::all();
        $inicio = true;
        
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
            'entradas' => $entradas,
            'vendedores' => $vendedores
        ]);
    }
    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
        
    }
    public static function blog(Router $router){
        $entradas = Blog::all();
        $vendedores = Vendedor::all();

        $router->render('paginas/blog', [
            'entradas'=> $entradas,
            'vendedores' => $vendedores
        ]);
    }
    public static function entrada(Router $router){
        $id = validarORedireccionar('/blog');
        $entrada = Blog::find($id);
        $vendedores = Vendedor::all();

        $router->render('paginas/entrada',[
            'entrada' => $entrada,
            'vendedores' => $vendedores
        ]);
    }
    public static function contacto(){
        echo 'Desde contacto';
    }
}