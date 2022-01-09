<?php
namespace App;


class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
    //este arreglo permite identificar qué forma van a tener los datos (Siguiendo el principio de Active Record cada atributo tiene el mismo nombre que la columna en la bd)  para mapear el obj 
    protected static $columasDB=['idPropiedades', 'titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','idVendedor'];

    public $idPropiedades;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $idVendedor;


    public function __construct($args = []){
        $this->idPropiedades = $args['idPropiedades'] ?? NULL;//en caso de que no esté presente va a ser un string vacío
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->creado = date('Y/m/d');
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->idVendedor = $args['idVendedor'] ?? '';
    }

    public function validar(){
        //Recordar la importancia del self a la hora de usar static, sin esto nos daría error

        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        if( strlen($this->descripcion) <60){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 60 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El número de Baños es obligatorio";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El número de espacios de Estacionamiento es obligatorio";
        }
        if(!$this->idVendedor){
            self::$errores[] = "Vendedor no elegido";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen de la propiedad es obligatoria";   
        }
       

        

        return self::$errores;
    }

    
   
}