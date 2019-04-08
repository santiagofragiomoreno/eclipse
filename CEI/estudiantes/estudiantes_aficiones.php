<?php
//////////////////////lectura de fucherios
//1 abrimos fichero
$fichero = fopen("estudiantes.json", "r");
// leemos el fichero ----- 1º el fichero, y 2º de donde tiene que contar los bytes
$datos = fread($fichero, filesize("estudiantes.json"));
// cerramos el fichero
fclose($fichero);
//imprimimos el fichero
//echo $datos;

//convertimos el contenido del JSON en un objeto de php
$objeto_estudiantes = json_decode($datos);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<ul>
		<?php for($i=0;$i<count($objeto_estudiantes);$i++){?>
		<li>
			<P><?php print_r($objeto_estudiantes[$i]->nombre);?> <?php print_r($objeto_estudiantes[$i]->apellido);?></P>
			<ul>
				<?php for($j=0;$j<count($objeto_estudiantes[$i]->aficiones);$j++){?>
					<li>
						<?php $aficiones = explode(',',$objeto_estudiantes[$i]->aficiones);?>
						<?php for($k=0;$k<count($aficiones);$k++){?>
					     	 <p><?php print_r($aficiones[$k]);?></p>
						<?php }?>
				     </li>
			     <?php }?>
			</ul>
		</li>
		<?php }?>
	</ul>
</body>
</html>