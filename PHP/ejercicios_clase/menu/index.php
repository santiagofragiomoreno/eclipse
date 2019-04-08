<?php 

$items = array("A","B","B","C");

$tamaño = count($items);

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<meta charset="utf-8">
	<title>menu</title>
</head>
<body>
	<nav class="ancho<?php echo $tamaño;?>">
		<ul>
			<?php for($i=0;$i<count($items);$i++){?>
			<li>
				<a href="#"><?php echo $items[$i]?></a>
			</li>
			<?php }?>
		</ul>
	</nav>
</body>
</html>