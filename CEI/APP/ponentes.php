<?php
//cuando venimos con la url: http://localhost/CEI/API/ponentes
if($pagina == '4'){
    $argumentos = array( "url" => $ruta_api."ponentes/".token(),
        "metodo" => "GET");
    $ponentes = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a ponencias
    //lo recogemos en un objeto
    $ponentes = json_decode($ponentes,false);
    //print_r ($ponentes);
}
//cuando venimos con la url: http://localhost/CEI/API/ponentes/13...14..(id del ponentes)
else{
    $argumentos = array( "url" => $ruta_api."ponentes/".$ruta[1]."/".token(),
        "metodo" => "GET");
    $ponente = conexion($argumentos);
    // decodificamos el json que nos develve la llamada a ponencias
    //lo recogemos en un objeto
    $ponente = json_decode($ponente,false);
    //print_r ($ponentes);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Ponencias</title>
</head>
<body>
<?php if($pagina == '4'){?>
<h1>LISTADO DE PONENTES</h1>
<ul>
	<?php for($i=0;$i<count($ponentes);$i++){?>
			<li>
				<b><a href="<?php echo $directorio_base;?>ponentes/<?php echo $ponentes[$i]->id?>"><?php echo $ponentes[$i]->nombre;?></a></b>
			</li>
	<?php }?>
</ul>
<?php }else{?>
	<h1>PONENTE</h1>
	<h2><?php echo $ponente[0]->nombre;?></h2>
	<img src="<?php echo $ponente[0]->foto; ?>"></img>
	<p><?php echo $ponente[0]->posicion;?></p>
	<p><?php echo $ponente[0]->bio;?></p>
	<form action="<?php echo $directorio_base.'pregunta'; ?>" method="POST">
    	<input type="hidden" name="receptor" value="<?php echo $ponente[0]->id; ?>">
    	<input type="submit" value="preguntar">
	</form>
	<?php }?>
	<?php $argumentos = array("url" => $ruta_api."preguntas/".token(),"metodo" => "GET",);
          $preguntas = conexion($argumentos);
          $preguntas = json_decode($preguntas);
          $preguntas_ponentes = array();
          for($i=0;$i<count($preguntas);$i++){
             if($preguntas[$i]->receptor == $ruta[1]){
                array_push($preguntas_ponentes, $preguntas[$i]);
             }
           }?> 
          <ul>
          <?php $_SESSION['preguntas_temporales'] = $preguntas_ponentes;?>
          <?php for($i=0;$i<count($preguntas_ponentes);$i++){?>
          <?php $votantes_temporal = explode(",", $preguntas_ponentes[$i]->votantes)?>
				<li>
					<?php echo ($preguntas_ponentes[$i]->pregunta);?>
					| votos: <span class="votos"><?php echo ($preguntas_ponentes[$i]->votos);?></span> | <a href="#" class="votar" data-voto="<?php echo $i;?>"><?php echo (in_array($_SESSION['usuario'], $votantes_temporal))?"votada":"votar"?></a>
				</li>
			<?php }?>
     	  </ul>
</body>
</html>