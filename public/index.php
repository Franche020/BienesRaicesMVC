<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PaginasController;
use Controllers\VendedorController;
use Controllers\PropiedadController;
use Controllers\BlogController;


$router = new Router();


$router->get('/admin', [PropiedadController::class, 'index']);
//* PRIVADO
    // Propiedades
    $router->get('/propiedades/crear', [PropiedadController::class , 'crear']);
    $router->post('/propiedades/crear', [PropiedadController::class , 'crear']);
    $router->get('/propiedades/actualizar', [PropiedadController::class , 'actualizar']);
    $router->post('/propiedades/actualizar', [PropiedadController::class , 'actualizar']);
    $router->post('/propiedades/eliminar', [PropiedadController::class , 'eliminar']);
    // Vendedores
    $router->get('/vendedores/crear', [VendedorController::class , 'crear']);
    $router->post('/vendedores/crear', [VendedorController::class , 'crear']);
    $router->get('/vendedores/actualizar', [VendedorController::class , 'actualizar']);
    $router->post('/vendedores/actualizar', [VendedorController::class , 'actualizar']);
    $router->post('/vendedores/eliminar', [VendedorController::class , 'eliminar']);
    // Blog
    $router->get('/blog/admin', [BlogController::class, 'index']);
    $router->get('/blog/crear',[BlogController::class, 'crear']);
    $router->post('/blog/crear',[BlogController::class, 'crear']);
    $router->get('/blog/actualizar',[BlogController::class, 'actualizar']);
    $router->post('/blog/actualizar',[BlogController::class, 'actualizar']);
    $router->post('/blog/eliminar',[BlogController::class, 'eliminar']);

//* paginas publicas
    $router->get('/',[PaginasController::class, 'index']);
    $router->get('/nosotros',[PaginasController::class, 'nosotros']);
    $router->get('/propiedades',[PaginasController::class, 'propiedades']);
    $router->get('/propiedad',[PaginasController::class, 'propiedad']);
    $router->get('/blog',[PaginasController::class, 'blog']);
    $router->get('/entrada',[PaginasController::class, 'entrada']);
    $router->get('/contacto',[PaginasController::class, 'contacto']);
    $router->post('/contacto',[PaginasController::class, 'contacto']);


$router->comprobarRutas();
