<?php
//inicializamos el request a curl
$peticion = curl_init("http://placehold.it/300x300");
//configuramos curl
curl_setopt($peticion, CURLOPT_RETURNTRANSFER, true);
//ejecutamos la peticion
$resultado = curl_exec($peticion);

$imagen = fopen("imagen.png", "wb");
fwrite($imagen, $resultado);
fclose($imagen);
//echo $resultado;
?>
<img src="imagen.png"></img>