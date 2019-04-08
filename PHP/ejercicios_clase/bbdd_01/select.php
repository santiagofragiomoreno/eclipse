<?php 

$conexion = new mysqli('localhost','root','','estudiantes');
if($conexion->connect_error){
    echo $conexion->connect_error;
}
else{
    echo "ok";
}

?>