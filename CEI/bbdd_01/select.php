<?php

$conexion = new mysqli('localhost','root','','proyecto');
if($conexion->connect_error){
    die ($conexion->connect_error);
}

$consulta = "SELECT * FROM usuarios WHERE email = 'santiagofragio@gmail.com'";
$resultado_consulta = $conexion->query($consulta);//nos devuelve un objeto 

//echo $resultado_consulta->num_rows;
$usuario = array();
$contador = 0;
if($resultado_consulta->num_rows>0){
    while ($fila = $resultado_consulta->fetch_assoc()){
       //$estudiantes[$contador]["id"]       = $fila["id"];
       $usuario[$contador]["id"]   = $fila["id"];
       $usuario[$contador]["nombre"] = $fila["nombre"];
       $usuario[$contador]["apellidos"] = $fila["apellidos"];
       $usuario[$contador]["email"] = $fila["email"];
       $usuario[$contador]["telefono"] = $fila["telefono"];
       $usuario[$contador]["hash"] = $fila["hash"];
       //$estudiantes[$contador]["aula"]     = $fila["aula"];
       $contador++;
    }
}

////////////cerramos conexion //////////////////
$conexion->close();
?>

<pre><?php print_r($usuario);?></pre>