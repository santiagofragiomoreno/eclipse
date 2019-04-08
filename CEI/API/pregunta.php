<?php 
$error = array("resultado" => "ko");
$success = array("resultado" => "ok");

if(isset($_POST['pregunta']) && isset($_POST['autor']) && isset($_POST['receptor'])){
    
    $consulta = "INSERT INTO preguntas (pregunta,autor,receptor,votos,votantes) VALUES ('".$_POST['pregunta']."', ".$_POST['autor']." , ".$_POST['receptor'].", 1 , '".$_POST['autor']."' )";

    if($conexion -> query($consulta) === TRUE){
        echo json_encode($success);
    }else{
        echo json_encode($error);
    }
}else{
 echo json_encode($error);
}


?>