<?php


class ActiveRecord{
    //BASE DE DATOS
    protected static $db;//static porque no requiere de una nueva instancia
    //de esta manera se puede iterar y realizar la sanitizacion
    protected static $columnasDB = []; //este atributo existe pero a la hora de heredar se va a sobreescribir con los datos necesario según cada clase

    protected static $tabla; //esta variable será sobreescrita en las clases que hereden haciendo referencia a la tabla a consultar
    //Errores
    protected static $errores = [];//obtenemos los errores



    //Definir la conexión a ka basae de datos | como la  conexión es static el metodo debe ser static también
    public static function setDB($database){
        self::$db = $database;//self hace referencia a los atributos estaticos de una misma clase
    }

    


    public function guardar(){
        if(!is_null($this->idPropiedades)){
            //actualizar | En caso se tenga un id 
            $this->actualizar();
        }else{
            //Crear un nuevo registro | No se cuenta con un id
            $this -> crear();
        }
        
    }

    public function crear()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        debugear($atributos); 
        $string = join(', ', array_keys($atributos));//join une un agrreglo y separa cada valor por comas en este caso

        $query = "INSERT INTO ". static::$tabla ." ( ";
        $query.= join(', ', array_keys($atributos));
        $query.= " ) VALUES (' ";   
        $query.=join("', '", array_values($atributos));
        $query.= " ')";

        $resultado = self::$db->query($query);
        debugear($query);

        //Mensaje de exito
        if($resultado){
            // echo "Insertado Correctamente";
            //Redireccionar al usuario si se realiza el registro
            header('Location: /admin?resultado=1'); /*esto impide que se ingresen datos duplicados | lo que está despues del ? es el mensaje que 
                                                     va a tener la url (_GET['resultado'])*/

             //header ->solo funciona mientras no haya nada de html previo | Usar la redireccion donde realmente sea conveniete ya que usarla en reiteradas oacciones causa problemas
         }
    }

    public function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach($atributos as $key => $value){
            $valores[] = "{$key}= '{$value}'";
        }
       
        $query = "UPDATE ". static::$tabla ." SET ";
        $query .= join(', ', $valores);
        $query .=" WHERE idPropiedades = '". self::$db->escape_string($this->idPropiedades) ."' "; 
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);//siempre que se interactua con la base de datos se hace uso de este código
        
        if($resultado){
            //Redireccionar al usuario si se realiza el registro
            header('Location: /admin?resultado=2'); /*esto impide que se ingresen datos duplicados | lo que está despues del ? es el mensaje que 
                                                     va a tener la url (_GET['resultado'])*/

             //header ->solo funciona mientras no haya nada de html previo | Usar la redireccion donde realmente sea conveniete ya que usarla en reiteradas oacciones causa problemas
         }
        
    }

    public function eliminar(){
        //Elimina el registro
        $query = "DELETE FROM ". static::$tabla ." WHERE idPropiedades= " . self::$db->escape_string($this->idPropiedades) . " LIMIT 1"; 
        //usamos escape_string para prevenir las inyecciones sql     
        
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //Identificar y unir los atributos de la bd
    public function atributos()
    {
        $atributos = [];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue; //para ignorar la columna de id 
            $atributos[$columna] = $this -> $columna;//se crea un nuevo arreglo con los atributos y los datos del arreglo | Al ser una variable sí va con el signo de dolar ($columna)
        }
        return $atributos;
    }

    public  function sanitizarAtributos()
    {
        $atributos = $this -> atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){ //arreglo asociativo key -> muestra las llaves del arreglo (titulo-precio-imagen...) || value-> lo que el usuario escribió
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Determinar si existe una imagen previa para eliminarla o agregar una en caso de que no la haya
        //A la hora de crear una propiedad no se cuenta con un id, a la hora de actualizar sí por lo que con eso evaluamos

        //Elimina la imagen previa
        if( !is_null($this->idPropiedades)){
            $this -> borrarImagen();
        }
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen(){
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPERTA_IMAGENES . $this->imagen);

        if($existeArchivo){
            unlink(CARPERTA_IMAGENES . $this->imagen);
        }
    }

    //Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        /* con $this-> se hace referencia a todo lo que forma parte de una instancia que está en un constructor 
        mientras lo que está static se hace referencia con self::*/

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

        if(!$this->imagen ){
            self::$errores[] = "La imagen es obligatoria";   
        }

        return self::$errores;
        
    }

    //Lista todas las propiedades
    public static function all(){
        /*Usamos el modificador de acceso static en lugar del self ya que self hace referencia a la clase en la que se encuentra
        mientras que static busca el atributo de la clase de la cual se esté heredando*/
        $query = "SELECT * FROM " . static::$tabla;
        


        //retorna un arreglo asociativo por lo que hay que convertirlo a un objeto
       $resultado = self::consultarSQL($query);

       return $resultado;
       
    }

    //Busca un registro por su id
    public static function find($id){
        $query = "SELECT * FROM ". static::$tabla ." WHERE idPropiedades= ${id}";
        $resultado = self::consultarSQL($query);

        return(array_shift($resultado) );//array_shift es una función de php que nos retorna el primer elemento de un arreglo
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db -> query($query);
    
        //Iterar los resultados
        $array = [];
        while($registro = $resultado ->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
           
        }
         //debugear($array);

        //Liberar la memoria 
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;//crea nuevos objetos de la clase actual

        foreach($registro as $key => $value){

            if( property_exists($objeto, $key )){
                $objeto-> $key = $value;
            }
        }
        return $objeto;//arerglo de objs
    }

    //Sincroniza el obj en memoria con los cambios realizados por el usuario para modificarlo
    public function sincronizar($args=[]){
        //vamos leyendo el post(arreglo) para irlos asignado del array al objeto
        foreach($args as $key => $value){

            //este "this" hace referecia al objeto actual, que tiene todo lo que está en el formulario
            if(property_exists($this, $key) && !is_null($value)){//si una propieda existe en nuestro arreglo this(tiene la forma del constructor)
                $this->$key = $value;

            }

        }
    }

}