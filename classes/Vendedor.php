<?php
namespace App;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $idtabla = 'id';
    
    //este arreglo permite identificar qué forma van a tener los datos (Siguiendo el principio de Active Record cada atributo tiene el mismo nombre que la columna en la bd)  para mapear el obj 
    protected static $columasDB=['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []){
        $this->id = $args['id'] ?? NULL;//en caso de que no esté presente va a ser un string vacíoE
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar(){
        //Recordar la importancia del self a la hora de usar static, sin esto nos daría error

        if(!$this->nombre){
            self::$errores[] = "El nombre es obligatorio";
        }

        if(!$this->apellido){
            self::$errores[] = "El apellido es obligatorio";
        }

        if(!$this->telefono){
            self::$errores[] = "El teléfono es obligatorio";
        }


        //Para validar que solo se ingresen numeros hacemos uso de la expresión regular preg_match | Una expresión regular se puede definir como la forma de buscar un patrón dentro de un texto

        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = "Formato no válido";
        }
        return self::$errores;
    }
}



?>