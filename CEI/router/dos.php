<?php
//creamos la conexion
$conexion = new mysqli('localhost','root','','estudiantes');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}
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
?>

<h1>AULAS</h1>
	<ul>
	<?php for($i=0;$i<count($aulas);$i++){?>
		<li><?php echo $aulas[$i]['id'];?> <?php echo $aulas[$i]['aula'];?></li>
	<?php }?>
	</ul>
	<a href="/CEI/router">volver a atras</a>