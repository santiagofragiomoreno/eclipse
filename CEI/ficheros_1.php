<?php
//readfile------> la mas basica para leer un json y nos devuelve los caracteres y su numero
//file_get_comtents------->nos devuelve el contenido del fichero
//json_decode()-----de un string json a un objeto php
//$datos = json_decode(file_get_contents("estudiantes.json"));
//ahora ya tenemos el objeto $datos en php
//echo $datos[0]->edad;
//echo '<br/>';
//////conexion a una base de datos
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
$lista = json_encode($estudiantes)
?>
<pre><?php print_r($estudiantes);?></pre>
<pre><?php echo($lista);?></pre>

