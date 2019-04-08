<?php
//creamos la conexion
$conexion = new mysqli('localhost','root','','estudiantes');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}

$consulta = "UPDATE estudiantes SET nombre = 'antoñito' WHERE id=2";

if($conexion->query($consulta) === true){
    echo "update realizado con exito";
}
else{
    echo "error al actualizar";
}

$conexion->close();
?>