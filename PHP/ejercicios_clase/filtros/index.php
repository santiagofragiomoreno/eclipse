<?php 
$items = array(
    
    array("item" => "caballo",
          "tipo" => "animal"
          ),
    array("item" => "mercedes",
        "tipo" => "coche"
    ),
    array("item" => "españa",
        "tipo" => "pais"
    ),
    array("item" => "perro",
        "tipo" => "animal"
    ),
    array("item" => "francia",
        "tipo" => "pais"
    ),
    array("item" => "fiat",
        "tipo" => "coche"
    ),
    array("item" => "gato",
        "tipo" => "animal"
    ),
    array("item" => "alemania",
        "tipo" => "pais"
    ),
    array("item" => "libro",
        "tipo" => "objeto"
    )
    
);

$filtros = array();

for($i=0;$i<count($items);$i++){
    if(array_search($items[$i]["tipo"],$filtros) === false){
        array_push($filtros,$items[$i]["tipo"]);
    }
};
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<div class="contenedor">
		<div class="items">
			<ul>
			    <?php for($i=0;$i<count($items);$i++){?>
				<li class="item <?php echo $items[$i]["tipo"];?> visible"><?php echo $items[$i]["item"];?></li>
				<?php }?>
			</ul>
		</div>
		<div class="filtros">
			<?php for($i=0;$i<count($filtros);$i++){?>
				<a href="#" class="filtro" data-tipo="<?php echo $filtros[$i];?>"><?php echo $filtros[$i];?></a>
			<?php }?>
		</div>
	</div>

<script type="text/javascript" src="js/function.js"></script>
</body>
</html>