<?php
namespace App;

class Propiedad{

    //Base de datos | protecded porque solamente de la clase se accede a él | static porque no se requiere instanciar cada conexión a la base de datos
    protected static $db;
    //este arreglo permite identificar qué forma van a tener los datos (Siguiendo el principio de Active Record cada atributo tiene el mismo nombre que la columna en la bd)  para mapear el obj 
    protected static $columasDB=['idPropiedades', 'titulo','imagen','descripcion','habitaciones','wc','estacionamiento','creado','idVendedor'];


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

     //Se define la conexión a la BD
     public static function setDB($database){
        //self hace referencia a los atributos static de una misma clase
        //this a lo que este como public o sea parte del objt
        self::$db = $database;
    }

    public function __construct($args = []){
        $this->idPropiedades = $args['idPropiedades'] ?? '';//en caso de que no esté presente va a ser un string vacío
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->creado = date('Y/m/d');
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->idVendedor = $args['idVendedor'] ?? '';
    }

    public function guardar(){
        //Antes se ingresar se debe sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        //debuguear($atributos);
        //array_keys y array_values nos permiten acceder tanto a las llaves y valores de un arreglo



        //Insertar en la base de datos | Es importante respetar esta sintaxis en cuantos a las comullas dobles y sencillas | Al estar en una instancia usamos this dentro de la consulta
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ',array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '",array_values($atributos));
        $query .= " ') ";

        //debuguear($query);


        $resultado=self::$db->query($query);
        debuguear($resultado);

    }

    //Identificar y unir los atributos de la bd
    public function atributos(){
        $atributos = [];
        foreach(self::$columasDB as $columna){
            if($columna === 'idPropiedades') continue; //lo que hace el continue es que cuando se cumpla la condicion lo ignora y pasa al siguiente elemento

            $atributos[$columna] = $this->$columna;
            //se crea un nuevo arreglo con los atributos y datos del obj y se unen | con el this se hace referencia al dato que esté en memoria por ej: $atributos['titulo']=$this->titulo
        }
        return $atributos;

    }


    public function sanitizarAtributos(){//se encarga de sanitizar los datos
       $atributos = $this->atributos();
       $sanitizado = [];

       //Arreglo asociativo donde key son las llaves del arreglo y value el valor ingresado por el usuario
       foreach($atributos as $key => $value){
           $sanitizado[$key] = self::$db->escape_string($value);

       }
       return $sanitizado;
       //debuguear($sanitizado);//para comprobar que se debugueo correctamente se puede poner un ' en el texto
    }


   
}