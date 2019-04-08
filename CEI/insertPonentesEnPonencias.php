<?php
//conexion con la base de datos
$conexion = new mysqli('localhost','root','','datos_api');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}
else{
    //SELECT para traernos las ponencias de la base de datos
    $consulta = "SELECT id,titulo FROM ponencias";
    $resultado_consulta = $conexion->query($consulta);//no devuelve un objeto
    $ponencias = array();
    $contador = 0;
    if($resultado_consulta->num_rows>0){
        while ($fila = $resultado_consulta->fetch_assoc()){
            $ponencias[$contador]["id"]   = $fila["id"];
            $ponencias[$contador]["titulo"] = $fila["titulo"];
            $contador++;
        }
    }
    //SELECT para traernos los ponentes de la base de datos
    $consulta2 = "SELECT id,nombre FROM ponentes";
    $resultado_consulta2 = $conexion->query($consulta2);
    $ponentes = array();
    $contador_ponentes = 0;
    if($resultado_consulta2->num_rows>0){
        while($fila = $resultado_consulta2->fetch_assoc()){
            $ponentes[$contador_ponentes]['id'] = $fila['id'];
            $ponentes[$contador_ponentes]['nombre'] = $fila['nombre'];
            $contador_ponentes++;
        }
    }
}
if(isset($_POST['ponencia'])){
    $valores_post = array();
    foreach ($_POST as $valor){
        $valor_post = $valor;
        array_push($valores_post, $valor_post);
    }
    //si es mayor a 1 significa que hemos marcado al menos 1 ponente
    if(count($valores_post)>1){
        $ids_ponentes = $valores_post;
        array_shift($ids_ponentes);
        $ids_ponentes = implode(",", $ids_ponentes);
        $update_ponentes = "UPDATE ponencias SET ponentes = '".$ids_ponentes."' WHERE id = $valores_post[0]";
        if($conexion->query($update_ponentes) === true){
            echo "ponentes actualizados correctamente.";
        }
        else{
            echo "Error al actualizar";
        }
     }
     else{
         echo "Debes seleccionar al menos un ponente.";
     }
    
}
////////////cerramos conexion //////////////////
$conexion->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registro de Ponentes</title>
</head>
<body>
	<h1>Seleccion de Ponentes para cada Ponencia</h1>
	<form action="insertPonentesEnPonencias.php" method="POST">
	<select name='ponencia'>
	<?php for($i=0;$i<count($ponencias);$i++){?>
		<option value='<?php echo $ponencias[$i]['id'];?>'><?php echo $ponencias[$i]['titulo'];?></option>
    <?php }?>
	</select>
	<p>Seleccione los ponentes:</p>
	<ul>
	<?php for($i=0;$i<count($ponentes);$i++){?>
		<li>
			<input type="checkbox" value="<?php echo $ponentes[$i]['id']?>" name="ponente_<?php echo $i + 1; ?>"><?php echo $ponentes[$i]['nombre'];?>
		</li>
	<?php }?>
	</ul>
	<input type="submit" value="enviar">
	</form>
	
	<pre><?php print_r($_POST); ?></pre>
</body>
</html>