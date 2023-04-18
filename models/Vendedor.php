<?php

namespace Model;

class Vendedor extends ActiveRecord {

      //*VARIABLES ESTATICAS Y PUBLICAS
    
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;


    //* CONSTRUCTOR
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    //* VALIDACION Y SANITIZACION

    public function validar()
    {
        // Validador
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre";
        }
        if (!$this->apellido) {
            self::$errores[] = "Debes añadir apellidos";
        }
        if (!$this->telefono) {
            self::$errores[] = "Debes añadir un teléfono";
        } else {
            if (!preg_match('/^[0-9]{9,12}$/',$this->telefono)){
            self::$errores[] = "El número de teléfono no es correcto";
            }
        }
        
        return self::$errores;
    }
}