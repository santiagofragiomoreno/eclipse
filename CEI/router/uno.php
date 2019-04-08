<?php


//creamos la conexion
$conexion = new mysqli('localhost','root','','estudiantes');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}
///////////////////// CONSULTA A LA BASE DE DATOS /////////////////////
$consulta = "SELECT * FROM estudiantes";
$resultado = $conexion->query($consulta); //disparamos la query(consulta)
$estudiantes = array ();
$contador_estudiantes = 0;
if($resultado->num_rows>0){ //le preguntamos al objeto resultado si trae algo mayor a 0
    while ($fila = $resultado->fetch_assoc()){
        $estudiantes[$contador_estudiantes]['nombre'] = $fila['nombre'];
        $estudiantes[$contador_estudiantes]['apellido'] = $fila['apellido'];
        $contador_estudiantes++;
    }
}
?>

	<h1>ESTUDIANTES</h1>
	<ul>
	<?php for($i=0;$i<count($estudiantes);$i++){?>
		<li><?php echo $estudiantes[$i]['nombre'];?> <?php echo $estudiantes[$i]['apellido'];?></li>
	<?php }?>
	</ul>
	<a href="/CEI/router">volver a atras</a>


