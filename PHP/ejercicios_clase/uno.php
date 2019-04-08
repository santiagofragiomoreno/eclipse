<?php

//concepto de variable ////
/*
 * "contenedor de memoria
 * donde podemos almacenar un valor
 * y modificarlo a lo largo de la ejecuacion
 * del programa.
 *   $nombre_variable = el valor que le queramos dar
 */
$edad = 18;
//peticion por GET para el paso de valores en la url
$nombre = $_GET['nombre'];

echo 'Hola '.$nombre. ' tu edad es: '.$edad;
?>
