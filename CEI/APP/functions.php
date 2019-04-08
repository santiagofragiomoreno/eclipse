<?php
/*
 * funcion creada para las redirecciones
 */
function redirect($url){
    header("Location:".$url);
    exit;
}
/*
 * funcion para generar tokens
 */
function token(){
    return (mt_rand(10,10000)*7)+6;
}
/*
 * funcion para devolver el JSON que nos devuelva la API
 * $argumentos------->array("url"=>.....URL
 *                          "metodo" =>.....POST
 *                          "argumentos" =>....array())
 */
function conexion($argumentos){
    $conexion = curl_init($argumentos['url']);
    curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);
    if($argumentos['metodo'] == 'POST'){
        curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($conexion, CURLOPT_POSTFIELDS, $argumentos['argumentos']);
    }
    $resultado = curl_exec($conexion);
    return $resultado;
}