<?php

//creamos la conexion
$conexion = new mysqli('localhost','root','','estudiantes');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}

$tipo = 0; //0 es crear y 1 es actualizar
///////////////////// CONSULTA A LA BASE DE DATOS /////////////////////
$consulta = "SELECT * FROM aulas";
$resultado = $conexion->query($consulta); //disparamos la query(consulta)
$aulas = array ();
$contador_aulas = 0;
if($resultado->num_rows>0){ //le preguntamos al objeto resultado si trae algo mayor a 0
    while ($fila = $resultado->fetch_assoc()){
        $aulas[$contador_aulas]['id'] = $fila['id'];
        $aulas[$contador_aulas]['aula'] = $fila['aula'];
        $contador_aulas++;
    }
}
//// omprobacion para cuando le damos a insertar un nuevo alumno POST
if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['aula']) && !isset($_GET['id'])){
    if(($_POST['nombre'] != "") && ($_POST['apellido'] != "") && ($_POST['aula'] != "")){
        if(isset($_POST['action']) && $_POST['action'] != ""){
            $consulta = "UPDATE estudiantes SET nombre='".$_POST['nombre']."',apellido='".$_POST['apellido']."',aula=".$_POST['aula']." WHERE id=".$_POST['action'];
        }
        else{
            $consulta = "INSERT INTO estudiantes (nombre,apellido,aula) VALUES ('".$_POST['nombre']."','".$_POST['apellido']."',".$_POST['aula'].")";
        }
        if($conexion->query($consulta) === true){
            $mensaje = "Se ha añadido con existo el estudiante.";
        }
        else{
            $mensaje = "Error al insertar al estudiante.";
        }
       
    }
}
///////// CUANDO VENIMOS POR GET CON UN id=8 de UN ESTUDIANTE
if(isset($_GET['id'])){
    $tipo = 1; 
}
// aprovechamos el operador ternario para que con el $tipo...o bien hacemos una consulta o bien hacemos otra
$consulta = ($tipo<1)?"SELECT * FROM estudiantes":"SELECT * FROM estudiantes WHERE id='".$_GET['id']."'";
$resultado = $conexion->query($consulta);
$estudiantes = array ();
$contador_estudiantes = 0;
if($resultado->num_rows>0){
    while ($fila = $resultado->fetch_assoc()){
        $estudiantes[$contador_estudiantes]['id']=$fila['id'];
        $estudiantes[$contador_estudiantes]['nombre']=$fila['nombre'];
        $estudiantes[$contador_estudiantes]['apellido']=$fila['apellido'];
        $estudiantes[$contador_estudiantes]['aula']=$fila['aula'];
        
        $contador_estudiantes++;
    }
}
$conexion->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<a href="index.html">Volver al index</a>
<h1>Estudiantes</h1>
	<?php if($tipo<1){?>
		<?php if(count($estudiantes)>0){?>
			<ul>
				<?php for($i=0;$i<count($estudiantes);$i++){?>
				<li><a href='estudiantes.php?id=<?php echo $estudiantes[$i]['id'];?>'><?php echo $estudiantes[$i]['nombre'];?> <?php echo $estudiantes[$i]['apellido'];?></a></li>
				<?php }?>
			</ul>
		<?php }?>
	<?php }?>
<form action="estudiantes.php" method="POST">
	<input name='nombre' type='text' value="<?php echo ($tipo>0)?$estudiantes[0]['nombre']:""?>">
	<input name='apellido' type='text' value="<?php echo ($tipo>0)?$estudiantes[0]['apellido']:""?>">
	<select name='aula'>
	<?php for($i=0;$i<count($aulas);$i++){?>
		<?php //revisar atributo selected del option?>
		<option value='<?php echo $aulas[$i]['id'];?>' <?php echo ($aulas[$i]['id'] == $estudiantes[0]['aula'] && $tipo>0)?"selected":"";?>><?php echo $aulas[$i]['aula'];?></option>
	<?php }?>
	</select>
	<?php if($tipo == 1){?>
	<input type='hidden' value='<?php echo $estudiantes[0]['id']?>' name='action'>
	<?php }?>
	<input type='submit' value='<?php echo($tipo==0)?"crear":"actualizar"?>'>
</form>
</body>
</html>