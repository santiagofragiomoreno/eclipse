<?php
//funcion que inicializa una peticion curl
//necesitamos un fichero al que conectarnos
$peticion = curl_init("http://imove.ws/ws/api/ponencias.json");
//configuramos curl
curl_setopt($peticion, CURLOPT_RETURNTRANSFER, true);
//ejecutamos la peticion

$resultado = curl_exec($peticion);
echo $resultado;
//ahora ya tenemos el JSON en $resultado

//cargamos el JSON como un array en $fichero
//1 conexion con la BBDD
$conexion = new mysqli('localhost','root','','datos_api');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}
else{
    
    
    //cargamos el JSON como un array en $ponencias
    $resultado = json_decode($resultado,true);
    print_r ($resultado);
    //recorremos todo el array y lo vamos insertando en la BBDD
    for($i=0;$i<count($resultado);$i++){
        //hacemos el INSERT en la tabla estudiantes
        $consulta = "INSERT INTO ponencias (titulo,descripcion) VALUES ('".$resultado[$i]['ponencia']['titulo']."','".$resultado[$i]['ponencia']['descripcion']."')";
       // echo $i. ": ".$resultado[$i]['ponencia']['titulo'].",".$resultado[$i]['ponencia']['descripcion']." ";
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