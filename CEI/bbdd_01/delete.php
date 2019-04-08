<?php
//creamos la conexion
$conexion = new mysqli('localhost','root','','estudiantes');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}

$consulta = "DELETE FROM estudiantes WHERE nombre = 'antoñito'";

if($conexion->query($consulta) === true){
    echo "delete realizado con exito";
}
else{
    echo "error al borrar";
}

$conexion->close();
?>