<?php
///////////////////////7 bucle while /////////

/////////////////////////////////////////////
////////////// BOOLEANS /////////////////////
$nombre = 'Santi';

?>
<!DOCTYPE html>
<html>
<head>
<meta  charset="UTF-8">
<title></title>
</head>
<body>
	<?php $x=0;?>
	<?php while($x<7){?>
	<p><?php echo $x + 1;?></p>
	<?php $x++;?>
	<?php };?>
	<!-- condicional un poco mas complejo -->
	<?php if(isset($nombre) && $nombre!=''){?>
	<p><?php echo $nombre;?></p>
	<?php };?>
</body>
</html>
