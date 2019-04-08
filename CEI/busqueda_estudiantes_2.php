<?php
$conexion = new mysqli('localhost','root','','estudiantes');

if($conexion->connect_error){
    die($conexion->connect_error);
}
$consulta = "SELECT * FROM estudiantes";
$resultado = $conexion->query($consulta);
$estudiantes = array();
$contador = 0;
if($resultado->num_rows > 0){
    while($fila = $resultado->fetch_assoc()){
        $estudiantes[$contador]['nombre'] = $fila['nombre'];
        $estudiantes[$contador]['apellido'] = $fila['apellido'];
        $contador++;
    }
}
$lista = json_encode($estudiantes);
echo $lista;

//////////////////// escribir los datos en un fichero
//creamos el fichero ----> con el parametro 'x', y el nombre que le queramos dar
$fichero = fopen("busqueda.json","x");

//// para escribir en el fichero
fwrite($fichero, $lista);
// por ultimos cerramos el fichero
fclose($fichero);
?>

