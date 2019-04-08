<?php

$ruta = explode("/", $_SERVER['REQUEST_URI']);

$profundidad_directorios = 3;

for($i=0;$i<$profundidad_directorios;$i++){
    array_shift($ruta);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ROUTER DE URLS AMIGABLES</title>
</head>
<body>
	<?php switch($ruta[0]){
	       
	           case'':
	               include "home.php";
	               break;
	           case'uno':
	               include "uno.php";
	               break;
	           case'dos':
	               include "dos.php";
	               break;
	             default:
	                 header("Location: http://localhost/CEI/router/");
	                 exit();
	                 break;
	 }?>
</body>
</html>
