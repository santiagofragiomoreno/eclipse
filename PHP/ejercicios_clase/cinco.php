<?php
$nombre='Santi Fragio';
///////// funcion strlen() //////////
/*
 * nos cuenta los caracteres de un string (incluyendo los espacios en blanco)
 */

////////// funcion explode() ////////////////
/*
 * nos convierte un string en un array de tantos elementos como 
 * tenga el string con el delimitador que le hayamos indicado
 */
//$nombre_separado = explode(' ', $nombre);

//////////////// funcion implode() /////////////////
/*
 * hace lo contrario que explode
 */
$nombre_completo = array('Santiago','Fragio');

$nombre_unido = implode(',',$nombre_completo);
/////////////// funcion str_split() /////////////
/*
 * transformamos una cadena de caracteres en un array
 * de tantos elementos como caracteres tenga la cadena
 * si le ponemos un numero como segundo argumento le
 * decimos el numero de caracteres que va a tener cada elemeneto del array
 */
$letras_nombre = str_split($nombre,2);
?>
<!DOCTYPE html>
<html>
<head>
<meta  charset="UTF-8">
<title></title>
</head>
<body>
	<p><?php echo strlen($nombre);?></p>
	<pre><?php print_r($letras_nombre);?></pre>
	<p><?php echo $nombre_unido;?></p>
</body>
</html>
