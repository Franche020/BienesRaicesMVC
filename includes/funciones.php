<?php


define('TEMPLATES_URL',__DIR__ . '/templates');
define('FUNCIONES_URL',__DIR__ .'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');




function incluirTemplates(string $nombre , bool $inicio = false) {
    include TEMPLATES_URL ."/{$nombre}.php";
}

function estaAutenticado () {
    session_start(); 

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function debugear ($variable) {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}
// Escapar / Sanitizar el HTML
function s ($html) :string{
   $s = htmlspecialchars($html);
   return $s;
}

// Validar el tipo de datos

function validarTipoDato ($tipo) {
    $tipos = ['propiedad', 'vendedor'];

    return in_array($tipo , $tipos);
}

function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo){
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default;
            $mensaje = '';
            break;
        }
        return $mensaje;
}

function validarORedireccionar (string $url) {
    $id = $_GET['id'];
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
    }
    return $id;
}