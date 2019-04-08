<?php
if($pagina == '2'){
    $argumentos = array( "url" => $ruta_api."ponencias/".token(),
        "metodo" => "GET");
    $ponencias = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a ponencias
    //lo recogemos en un objeto
    $ponencias = json_decode($ponencias,false);
    //print_r ($ponencias);
}else{
    $argumentos = array( "url" => $ruta_api."ponencias/".$ruta[1]."/".token(),
        "metodo" => "GET");
    $ponencias = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a ponencias
    //lo recogemos en un objeto
    $ponencias = json_decode($ponencias,false);
    //print_r ($ponencias);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Ponencias</title>
</head>
<body>
<?php if($pagina == '2'){?>
<h1>LISTADO DE PONENCIAS</h1>
<ul>
	<?php for($i=0;$i<count($ponencias);$i++){?>
			<li>
				<b><a href="<?php echo $directorio_base;?>ponencias/<?php echo $ponencias[$i]->id?>"><?php echo $ponencias[$i]->titulo;?></a></b>
			</li>
	<?php }?>
</ul>
<?php }else{?>
<h1>PONENCIA</h1>
<p><?php  echo $ponencias[0]->titulo;?></p>
<p><?php  echo $ponencias[0]->descripcion;?></p>
<ul>
	<?php for($i=0;$i<count($ponencias[0]->ponentes);$i++){?>
	<li>
			<a href="<?php echo $directorio_base;?>ponentes/<?php echo $ponencias[0]->ponentes[$i]->id?>"><?php echo $ponencias[0]->ponentes[$i]->nombre?><p><img src="<?php echo $ponencias[0]->ponentes[$i]->foto;?>"></p></a>
	</li>
	<?php }?>
</ul>

<?php }?>

</body>
</html>