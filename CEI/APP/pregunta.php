<h2>PREGUNTA</h2>
<?php if(isset($_POST['accion'])){?>
    	<?php $argumentos = array("url" => $ruta_api."pregunta/".token(), 
    	                          "metodo" => "POST", 
    	                          "argumentos" => array("pregunta" => $_POST['pregunta'],
    	                                                "autor" => $_SESSION['usuario'],
    	                                                "receptor" => $_POST['receptor']));
    	$resultado = conexion($argumentos);
    	$resultado = json_decode($resultado);
    	if($resultado->resultado == 'ok'){
    	    echo "La pregunta se efectúo orrectamente";
    	}
    	else{
    	    echo "hubo un error al crear la pregunta";
    	}
    	?>
<?php }else{?>
<form action="<?php echo $directorio_base.'pregunta'; ?>" method="POST">
	<textarea name="pregunta"></textarea>
	<input type="submit" value="preguntar">
	<input type="hidden" name="accion" value="1">
	<input type="hidden" name="receptor" value="<?php echo ($_POST['receptor'])?>">
</form>
<?php }?>