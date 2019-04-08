<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>
<?php 

	$to = "santiagofragio@gmail.com";
	$subject = "codigo inexistente";
	$txt = "Se ha supervisado el parte de " . $_GET['codigo'];
	$headers = "De: Apps on-line" . "\r\n" ;
	mail($to,$subject,$txt,$headers);


 ?>
<body>
</body>
</html>
