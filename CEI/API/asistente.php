<?php
$success = array("resultado" => "OK");
$error = array("resultado" =>"KO");
$error_post = array("resultado" => "KO_POST");
if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['foto'])){
    $consulta = "INSERT INTO asistentes (name,email,profile_img,passwd) VALUES ('".$_POST['nombre']."','".$_POST['email']."','".$_POST['foto']."','".password()."')";
    //ejecutamos la consulta
    if($conexion->query($consulta) === true){
       echo json_encode($success); 
    }
    else{
        echo json_encode($error);
    }
}
//si no nos llega nada por la url....
else{
    echo json_encode($error_post);
}
//funcion para generar el passaword del asistente
//va a contener letras y numeros
function password(){
    $letras = "abcdefghijklmnopqrstuvwxyz";
    $letras = str_split($letras);
    $numeros = "0123456789";
    $numeros = str_split($numeros);
    //estructura del password
    $password = [$letras[mt_rand(0,count($letras) - 1)], strtoupper($letras[mt_rand(0,count($letras)-1)]),$numeros[mt_rand(0,count($numeros)-1)]];
    for($i=0;$i<5;$i++){
        if(mt_rand(1,10)<5){
            array_push($password, $letras[mt_rand(0,count($letras)-1)]);
            $password[count($password)-1] = (mt_rand(1,10)<5)?strtoupper($password[count($password)-1]) : $password[count($password)-1];
            
        }
        else{
            array_push($password, $numeros[mt_rand(0,count($numeros)-1)]);
        }
    }
    shuffle($password);
    return implode($password);
}
?>