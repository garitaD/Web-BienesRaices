<?php
namespace App;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    //este arreglo permite identificar qué forma van a tener los datos (Siguiendo el principio de Active Record cada atributo tiene el mismo nombre que la columna en la bd)  para mapear el obj 
    protected static $columasDB=['idVendedor', 'nombre', 'apellido', 'telefono'];

    public $idVendedor;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []){
        $this->idPropiedades = $args['idPropiedades'] ?? NULL;//en caso de que no esté presente va a ser un string vacío
        $this->idVendedor = $args['idVendedor'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
}




?>