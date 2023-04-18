<?php 

namespace Model;

class ActiveRecord {

    public $id;


    //*VARIABLES ESTATICAS Y PUBLICAS

    // Base de datos, protegida para limitar el acceso y static para que todos los objetos usen la misma conexión
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    
    // Errores
    protected static $errores = [];




    //* DATABASE
    // Definir la conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    protected static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }




    //* GUARDAR Y ACTUALIZAR
    public function guardar()
    {
        if (!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Crear un nuevo registro
            $this->crear();
        }
    }

    protected function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Crea un string a partir de un arreglo
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(", ", array_keys($atributos))/* Crea un string a partir de un arreglo y los array keys son las llaves del arreglo */;
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos))/* Crea un string a partir de un arreglo y los array values son los valores del arreglo */;
        $query .= " ');";

        // Insertar en la base de datos
        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuario.
            header('location: /admin?resultado=1');
        }
    }

    protected function actualizar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Crea un string a partir de un arreglo
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = ";
        $query .= self::$db->escape_string($this->id);
        $query .= " LIMIT 1;";

        // Insertar en la base de datos
        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuario.
            header('location: /admin?resultado=2');
        }
    }




    //* LEER REGISTROS DATABASE
    // Listar todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtiene un determinado numero de registros
    public static function get(int $cantidad) :array
    {
        $query = "SELECT * FROM " . static::$tabla ." LIMIT " .$cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla ." WHERE id ={$id}";
        $resultado = self::consultarSQL($query);

        return (array_shift($resultado));
    }




    //* ELIMINAR REGISTROS
    //Elimina los registros de la bs
    public function eliminar()
    {
        // Genero el query
        $query = "DELETE FROM " . static::$tabla ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        // ejecuto la consulta
        $resultado = self::$db->query($query);
        // Si el query es correcto redirecciono
        if ($resultado) {
            header('location: /admin?resultado=3');
            $this->borrarImagen();
        }
    }




    //* MAPEADO, SANITIZADO Y VALIDACION
    // Crea un objeto desde un array
    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Mapea de objeto a array asociativo para poder iterarlo por medio de foreach
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
 
    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {

        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Sanitiza los datos llamando para ello el mapeo a array asociatvo
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Validacion
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }





    //* IMAGENES Y ARCHIVOS
    public function setImagen($imagen)
    {
        // Eliminar si hay una imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    private function borrarImagen()
    {
        if (file_exists(CARPETA_IMAGENES . $this->imagen)) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
}