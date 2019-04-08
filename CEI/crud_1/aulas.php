<?php

////creamos la conexion a la base de dato ///////
$conexion = new mysqli("localhost",'root','','estudiantes');
//verificamos si hay algun error de conexion
if($conexion->connect_error){
    die($conexion->connect_error);
}
$tipo = 0; //0 = aulas y 1 = estudiantes
    $mensaje="";
    //si existe la variable POST y no existe la variable GET
    if(isset($_POST['aula']) && !isset($_GET['id'])){
        if($_POST['aula'] != ""){ //¿traemos algo por POST que no sea "" ??
            $consulta_bbdd = "INSERT INTO aulas (aula) VALUES ('".$_POST['aula']."')";
            if($conexion->query($consulta_bbdd) === true){
                $mensaje = "El aula se ha registrado con exito.";
            }
            else{
                $mensaje = "No se ha podido registrar el aula.";
            }
        }else{
            $mensaje = "El campo aula no puede estar vacío.";
        }
    }
    //si venimos por GET con el 'id' del aula
    if(isset($_GET['id'])){
        //si venimos en la URL con el id del aula...el tipo de pagina es la de estudiantes
        $tipo = 1;
    }
    if($tipo>0){
        $consulta_bbdd = "SELECT * FROM estudiantes WHERE aula = ".$_GET['id'];
    }
    else{
        $consulta_bbdd = "SELECT * FROM aulas";
    }
    $lista = array();
    $contador = 0;
    $resultado_consulta = $conexion->query($consulta_bbdd); //consulta a la base de datos
    if($resultado_consulta->num_rows>0){
        while ($fila = $resultado_consulta->fetch_assoc()){
            if($tipo>0){
                //tabla con campos fijos de las tablas creadas paa el ejemplo
                //normalmente esto suele ser dinamico
                $lista[$contador]['id'] = $fila['id'];
                $lista[$contador]['nombre'] = $fila['nombre'];
                $lista[$contador]['apellido'] = $fila['apellido'];
            }
            else{
                //diferenciamos entre las dos tablas que tenemos ESTUDIANTES/AULAS
                $lista[$contador]['id'] = $fila['id'];
                $lista[$contador]['aula'] = $fila['aula'];
            }
            $contador++;
        };
    }

$conexion->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Aulas</title>
</head>
<body>
<a href="index.html">Volver al index</a>
	<h1><?php echo ($tipo>0)?"Estudiantes":"Aulas";?></h1>
	<?php if(count($lista)>0){?>
	<ul>
		<?php for($i=0;$i<count($lista);$i++){?>
			<li>
				<a href="<?php echo ($tipo>0)?'estudiantes':'aulas'?>.php?id=<?php echo ($lista[$i]['id'])?>"><?php echo ($tipo>0)? $lista[$i]['nombre'].' '.$lista[$i]['apellido']:$lista[$i]['aula'];?></a>
			</li>
		<?php };?>
	</ul>
	<?php }?>
	<?php if($tipo<1){?>
	<form action="aulas.php" method="POST">
		<input type="text" name="aula">
		<input type="submit" value="nueva">
	</form>
	<?php }?>
</body>
</html>