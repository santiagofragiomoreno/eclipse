<?php
//funcion que inicializa una peticion curl
//necesitamos un fichero al que conectarnos
$peticion = curl_init("http://localhost/CEI/curl_02.php?a=jeje");
//configuramos curl
curl_setopt($peticion, CURLOPT_RETURNTRANSFER, true);
//ejecutamos la peticion
$resultado = curl_exec($peticion);
echo $resultado;
?>