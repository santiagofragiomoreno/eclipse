<?php
$success = array("resultado" => "OK");
$error = array("resultado" =>"KO");
$success = array("resultado" => "OK");
$error = array("resultado" =>"KO");
if(isset($_POST['nombre']) && isset($_POST['foto'])&& isset($_POST['id_asistente'])){
    //actializamos los datos del asistente
    $update_asistente = "UPDATE asistentes SET name = '".$_POST['nombre']."',profile_img ='".$_POST['foto']."' WHERE id = ".$_POST['id_asistente'];
    if($conexion->query($update_asistente) === true){
        echo json_encode($success);
    }
    else{
        echo json_encode($error);
    }
}
else{
    echo json_encode($error);
}