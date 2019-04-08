<?php

///////////// OBJETOS PHP ///////////////
//CONCEPTO 1 : CLASE
// ES UN POSIBLE OBJETO
//CONCEPTO 2 : INSTANCIAÇ

class Persona{
    public $nombre = "";
    public $apellido = "";
    private $edad = 0;
    public $altura = 0;
    
    //contructor//
    public function __construct($nombre,$apellido,$edad,$altura){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->altura = $altura;
    }
    
    
    //metodos//
    public function Saludo(){
        return "Hola, soy ".$this->nombre;
    }
    
    //geter y seter
    public function setEdad($edad){
        $this->edad = $edad;
    }
    
    public function getEdad(){
        return $this->edad;
    }
}

class niño extends Persona{
    
}

$Luis = new Persona("santi","fragio",25,1.65);
$Luis->nombre = "alvaro";
$Luis->setEdad(33);
?>
<pre><?php print_r($Luis)?></pre>
<p><?php echo $Luis->nombre;?></p>
<p><?php echo $Luis->Saludo();?></p>
<p><?php echo $Luis->getEdad();?></p>
