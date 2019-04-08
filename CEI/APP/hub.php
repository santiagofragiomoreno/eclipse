<?php
//fichero intermedio para hacer las llamadas a la API
session_start();
include "functions.php";
$ruta_api = "http://localhost/CEI/API/";
//echo $_SESSION['preguntas_temporales'][$_POST['voto']]->pregunta;
if(isset($_POST['voto'])){
   $argumentos = array( "url"        => $ruta_api."votar/".token(),
                        "metodo"     => "POST",
                        "argumentos" => array("id_pregunta" => $_SESSION['preguntas_temporales'][$_POST['voto']]->id,
                                              "id_votante"  => $_SESSION['usuario']
                                              )
                         );
   $respuesta = conexion($argumentos);
   echo $respuesta;
}
if(isset($_FILES['imagen'])){
    //print_r($_FILES['imagen']);
    echo "data:".$_FILES['imagen']['type'].";base64,".base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
}
?>