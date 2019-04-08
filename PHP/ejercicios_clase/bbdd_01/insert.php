<?php
//creamos la conexion
$conexion = new mysqli('localhost','root','','estudiantes');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}

$consulta = "INSERT INTO estudiantes (nombre,apellido) VALUES ('antonio','otero fragio')";
if($conexion->query($consulta) === true){
    echo "insert realizado con exito";
}
else{
    echo "error al insertar";
}
$conexion->close();
?>