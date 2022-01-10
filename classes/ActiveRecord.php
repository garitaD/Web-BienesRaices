<?php

namespace App;


class ActiveRecord{
    //BASE DE DATOS
    //Base de datos | protecded porque solamente de la clase se accede a él | static porque no se requiere instanciar cada conexión a la base de datos
    protected static $db;
    //este arreglo permite identificar qué forma van a tener los datos (Siguiendo el principio de Active Record cada atributo tiene el mismo nombre que la columna en la bd)  para mapear el obj | A la hora de heredarlo se va a sobreescribir con los atributos correspondientes a la clase
    protected static $columasDB=[];

    protected static $tabla = '';
    //Validación
    protected static $errores = [];


   

     //Se define la conexión a la BD | como la  conexión es static el metodo debe ser static también
     public static function setDB($database){
        //self hace referencia a los atributos static de una misma clase
        //this a lo que este como public o sea parte del objt
        self::$db = $database;

        //la conexion la mantenemos como self porque todas las clases apuntan a la misma base de datos por lo que todo lo que tenga que ver con base de datos o metodos propios se mantiene con self
    }

    

    public function guardar(){
       // debuguear($this);
        if((!is_null($this->id)) ){
            //Actualizar
            $this->actualizar();

        }else{
            //Creando un nuevo registro
            //debuguear($this);
            $this->crear();
            
        }

    }



    public function crear(){
        //Antes se ingresar se debe sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        //debuguear($atributos);
        //array_keys y array_values nos permiten acceder tanto a las llaves y valores de un arreglo
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ',array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '",array_values($atributos));
        $query .= " ') ";

        //debuguear($query);


        $resultado=self::$db->query($query);
        if($resultado){
            // echo "Insertado Correctamente";
            //Redireccionar al usuario si se realiza el registro
            header('Location: /admin?resultado=1'); /*esto impide que se ingresen datos duplicados | lo que está despues del ? es el mensaje que 
                                                     va a tener la url (_GET['resultado'])*/

             //header ->solo funciona mientras no haya nada de html previo | Usar la redireccion donde realmente sea conveniete ya que usarla en reiteradas oacciones causa problemas
         }
     
        //debuguear($resultado);

    }

    public function actualizar(){
        //Antes se ingresar se debe sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];//va al obj y une atributos con valores

        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";

        }
        //debuguear(join(', ',$valores));
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ',$valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id). "' "; 
        $query .= "LIMIT 1";
        //debuguear($query);

        //debuguear($query);
        $resultado = self::$db->query($query);
        if($resultado){
            //Redireccionar al usuario si se realiza el registro
            header('Location: /admin?resultado=2'); /*esto impide que se ingresen datos duplicados | lo que está despues del ? es el mensaje que 
                                                     va a tener la url (_GET['resultado'])*/

             //header ->solo funciona mientras no haya nada de html previo | Usar la redireccion donde realmente sea conveniete ya que usarla en reiteradas oacciones causa problemas
         }
    }

    //Eliminar un registro
    public function eliminar(){
        //Elimina la propiedad
            $query = "DELETE FROM " . static::$tabla . " WHERE id=" . self::$db->escape_string($this->id) . " LIMIT 1";

        //debuguear($query);

        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');

        }

    }

    //Identificar y unir los atributos de la bd
    public function atributos(){
        $atributos = [];
        foreach(static::$columasDB as $columna){
            if($columna === 'id') continue; //lo que hace el continue es que cuando se cumpla la condicion lo ignora y pasa al siguiente elemento

            $atributos[$columna] = $this->$columna;
            //se crea un nuevo arreglo con los atributos y datos del obj y se unen | con el this se hace referencia al dato que esté en memoria por ej: $atributos['titulo']=$this->titulo
        }
        return $atributos;

    }


    public function sanitizarAtributos(){//se encarga de sanitizar los datos
       $atributos = $this->atributos();//toma el obj y lo sanitiza
       $sanitizado = [];

       //Arreglo asociativo donde key son las llaves del arreglo y value el valor ingresado por el usuario
       foreach($atributos as $key => $value){
           $sanitizado[$key] = self::$db->escape_string($value);

       }
       return $sanitizado;
       //debuguear($sanitizado);//para comprobar que se debugueo correctamente se puede poner un ' en el texto
    }

    //Subida de archivos
    public function setImagen($imagen){
       // debuguear($this);

        //Elima la imagen previa | Isset revisa si existe y que además qtenga un valor
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen=$imagen;
        }
    }

    //Elimar archivo
    public function borrarImagen(){
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
        //debuguear($existeArchivo);

    }

    //Validacion
    public static function getErrores(){
        return static::$errores;
    }

    public function validar(){
        //Recordar la importancia del self a la hora de usar static, sin esto nos daría error | En caso de herencia hay que usar static
        static::$errores=[];
        

        return static::$errores;
    }

    //Listar todos los registros
    public static function all(){
        //self hace referencia a la propia clase, mientras que static hereda el metodo y busca el atributo dentro clase que se esté heredando y de esta manera sobreescribe

        $query ="SELECT * FROM " .static::$tabla;

       //debuguear($query);
        $resultado = self::consultarSQL($query);
       // debuguear($resultado->fetch_assoc());

       return $resultado;
    }

    //Busca un registro por su id | static porque no se requiere una nueva instancia
    public static function find($id){
        //Consulta para traer los datos de la propiedad
            $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        
        //debuguear($query);
        $resultado= self::consultarSQL($query);
        //debuguear(array_shift($resultado));
        return array_shift($resultado);//array_shift nos devuelve la primera posicion de un arreglo
    }

    public static function consultarSQL($query){
        //Constultar la base de datos
        $resultado = self::$db->query($query);
        //debuguear($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado ->fetch_assoc()){ 
            $array[] = static::crearObjeto($registro);//se crea un arreglo de objetos
        }
        //debuguear($array);

        //Liberar la memoria 
        $resultado->free();

        //Retornar los resultados
        return $array;
    }


    //Toma los arreglos que vienen de la base de datos y crea los objs
    protected static function crearObjeto($registro){

        $objeto = new static;//se modifica a static para crear un obj de la clase que se está heredando 

        foreach($registro as $key => $value){//al ser un arreglo asociativo se hace uso de key y value

            //si el obj tiene una llave del arreglo
            if(property_exists($objeto, $key )){
                $objeto -> $key = $value;
            }

        }
        return $objeto;
    }

    //Metodo que sincroniza el obj memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        //Usamos key value ya que vamos a recorrer un arreglo asociativo
        //compara propiedades del obj con llaves del arreglo y reescribe
        foreach($args as $key=> $value){ 
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key =$value;
            }


        }
    }

}