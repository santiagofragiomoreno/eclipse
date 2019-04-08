<?php 

$mensaje = "";

if(isset($_GET["nombre"]) && $_GET["nombre"] != ""){
    $mensaje = "El nombre es:". $_GET["nombre"];
}
else{
    $mensaje = "No me llego ningun nombre";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta  charset="UTF-8">
<title>GET PHP</title>
</head>
<body>
	<form action="get.php" method="GET">
	<input type="text" name="nombre">
	<input type="submit" value="enviar">
	</form>
	<p><b><?php echo $mensaje;?></b></p>
</body>
</html>
