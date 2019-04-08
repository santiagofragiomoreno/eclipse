<?php
require 'carta.php';
session_start();
$imagenes = array('img/01.png','img/02.png','img/03.png','img/04.jpg','img/05.jpg','img/06.jpg');
$cartas = array();
for($i=1;$i<=6;$i++){
    $cartas[$i-1]=new Carta($i, $imagenes[$i-1]);
}
$_SESSION['cartas_juego'] = array();
for($i=0;$i<6;$i++){
    $indice = mt_rand(0,count($cartas)-1);
    $_SESSION['cartas_juego'][$i] = $cartas[$indice];
    $_SESSION['cartas_juego'][$i+6] = $cartas[$indice];
}
shuffle($_SESSION['cartas_juego']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link  rel="stylesheet" type="text/css" href="css/estilos.css">
<title>Insert title here</title>
</head>
<body>
	<div class="tablero">
		<?php for($i=0;$i<count($_SESSION['cartas_juego']);$i++){?>
		<div class="carta volteada">
			<img src="<?php echo $_SESSION['cartas_juego'][$i]->imagen;  ?>">
		</div>
		<?php }?>
	</div>
	<script type="text/javascript" src="js/funciones.js"></script>
</body>
</html>