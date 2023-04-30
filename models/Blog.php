<?php

namespace Model;

class Blog extends ActiveRecord {

    protected static $tabla = 'blog';
    protected static $columnasDB = ['id','titulo','entrada','autor','fecha','imagen'];

    public $id;
    public $titulo;
    public $entrada;
    public $autor;
    public $fecha;
    public $imagen;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->entrada = $args['entrada'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar(){


        if(!$this->titulo || strlen($this->titulo)>149){
            self::$errores[] = 'La entrada de blog ha de tener un título de menos de 150 caracteres';
        }
        if(!$this->entrada || strlen($this->entrada)>2499 || strlen($this->entrada)<150){
            self::$errores[] = 'El blog ha de tener texto en la entrada con una longitud entre 150 y 2500 caracteres';
        }
        if(!$this->autor){
            self::$errores[] = 'la entrada ha de tener un autor válido';
        }
        return self::$errores;
    }
    public static function all()
    {
        $query = "SELECT id, titulo, SUBSTR(entrada, 1, 250) AS entrada, autor, fecha, imagen FROM " . static::$tabla;
        //$query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function getIndex(int $cantidad, int $caracteres) :array
    {
        $query = "SELECT id, titulo, SUBSTR(entrada, 1," . $caracteres. ") AS entrada, autor, fecha, imagen FROM " . static::$tabla ." LIMIT " .$cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}