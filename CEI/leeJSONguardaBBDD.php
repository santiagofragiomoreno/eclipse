<?php
//1 conexion con la BBDD
$conexion = new mysqli('localhost','root','','estudiantes2');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}
else{
    // si tenemos conexio, leemos el fichero JSON
    //$lista = array();
    $fichero = file_get_contents("estudiantes/estudiantes.json");
    //cargamos el JSON como un array en $fichero
    $fichero = json_decode($fichero,true);
    //recorremos todo el array y lo vamos insertando en la BBDD
    for($i=0;$i<count($fichero);$i++){
        //hacemos el INSERT en la tabla estudiantes
        $consulta = "INSERT INTO estudiantes (nombre,apellido) VALUES ('".$fichero[$i]['nombre']."','".$fichero[$i]['apellido']."')";
        echo $i. ": ".$fichero[$i]['nombre'].",".$fichero[$i]['apellido']." ";
        if($conexion->query($consulta) === true){
            echo "insert realizado con exito";
        }
        else{
            echo "error al insertar";
        }
        echo "<br>";
    }
    
    $conexion->close();
}
?>