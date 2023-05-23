<?php

namespace Controllers;

use Model\Blog;
use Model\Propiedad;
use MVC\Router;
use Model\Vendedor;
use PHPMailer\PHPMailer\PHPMailer;

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
    public static function contacto(Router $router){
        $mensaje = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $respuestas = $_POST['contacto'];


            // Crear una instancia de PHPMail
            $mail = new PHPMailer();
            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = "sandbox.smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = "9ec3d33bf2136f";
            $mail->Password = "8512a1c947dad9";
            $mail->SMTPSecure = "tls";
            $mail->Port = "2525";
            
            
            // Configurar el contenido del email

            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com' , 'BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            // Habilitar HTML

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido

            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje </p>';
            $contenido .= '<p>Nombre:  '. $respuestas['nombre'] . '</p>';
            

            // Enviar de forma condicional 
            if ($respuestas['contacto'] === 'telefono'){
                // Telefono
                $contenido .= '<p>Solicita ser contactado por teléfono </p>';
                $contenido .= '<p>Teléfono:  '. $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha:  '. $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora:  '. $respuestas['hora'] . '</p>';

            } else {
                // Email
                $contenido .= '<p>Solicita ser contactado por email </p>';
                $contenido .= '<p>Mail:  '. $respuestas['email'] . '</p>';
            }
            $contenido .= '<p>Mensaje:  '. $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra:  '. $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio:  $'. $respuestas['precio'] . '</p>';

            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un cuerpo alternativo sin HTML';

            // Enviar el email

            if ($mail->send()){
                $mensaje = 'Mensaje enviado Correctamente';
            } else {
                $mensaje =  'El mensaje no se puede enviar';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}