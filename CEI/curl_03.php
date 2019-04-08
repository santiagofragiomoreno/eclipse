<?php
//funcion que inicializa una peticion curl
//necesitamos un fichero al que conectarnos
$peticion = curl_init("http://localhost/CEI/curl_05.php");
//configuramos curl
curl_setopt($peticion, CURLOPT_RETURNTRANSFER, true);
//ejecutamos la peticion
curl_setopt($peticion, CURLOPT_CUSTOMREQUEST, "POST");

curl_setopt($peticion, CURLOPT_HTTPHEADER, array('Content_Type:appilication/json'));

curl_setopt($peticion, CURLOPT_POSTFIELDS, '{"nombre":"santi"}');
$resultado = curl_exec($peticion);
echo $resultado;
?>