<?php
$datos = array("nombre" => "Santi", "email" => "santi@gmail.com", "foto" => "");
$conexion = curl_init("http://localhost/CEI/API/asistente/5039");
curl_setopt($conexion,CURLOPT_RETURNTRANSFER, true);
curl_setopt($conexion,CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($conexion,CURLOPT_POSTFIELDS, $datos);
$resultado = curl_exec($conexion);
curl_close($conexion);
echo $resultado;
?>


