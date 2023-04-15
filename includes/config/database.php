<?php



function conectarDB() : mysqli {
    //error_reporting(0);
    $db = new mysqli('localhost', 'user', '1234', 'bienesraices_crud');
    $db->set_charset("utf8");
    

    if(!$db) {
        trigger_error(mysqli_connect_error());

        echo "Error no se pudo conectar";

        exit;
    }

    return $db;
}