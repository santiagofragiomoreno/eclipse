<?php

class Carta{
    
    //propiedades
    public $imagen = "";
    private $id = 0;
    
    //metodos
    public function __construct($id,$imagen){
        $this->id = $id;
        $this->imagen = $imagen;
    }
    
    public function getId(){
        return $this->id;
    }
}
?>