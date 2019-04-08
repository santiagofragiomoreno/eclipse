<?php

//nombres 
$nombres = array("santi","alvaro","pepe","julien","manolo","antonito");
$apellidos = array("fragio","martin","sanchez","moreno","sarnito","alvarez");

$lista=array();
//abrimos un fichero para su escritura. si no existe el archi lo cre y si
//existe lo sobreescribe
$fichero = fopen("estudiantes.json", "w");
for($i=0;$i<20;$i++){
    
    $lista[$i]['id']=$i+1;
    $nom_aleatorio = mt_rand(0,5);
    $lista[$i]['nombre'] = $nombres[$nom_aleatorio];
    $ape_aleatorio = mt_rand(0,5);
    $lista[$i]['apellido'] = $apellidos[$ape_aleatorio];
}
//codificamos la lista en JSON para generar el archivo JSON
$lista = json_encode($lista);
//echo $lista;
//echo json_last_error_msg();
fwrite($fichero, $lista);
fclose($fichero);
//comprobamos si nos llega el id del formulario
if(isset($_POST['id']) && $_POST['id']!=''){
    $busca_id = $_POST['id'];
    //abrimos el fichero JSON
    $fichero = file_get_contents("estudiantes.json");
    $fichero = json_decode($fichero);
    $encontrado = 0;
    //recorremos la lista leida del fichero
    for($i=0;$i<count($fichero);$i++){
        if(!$encontrado){
            if($busca_id == $fichero[$i]->id){
                $alumno = $fichero[$i];
                $encontrado = 1;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>busqueda de estudiantes</title>
</head>
<body>
	<h1>Buscador de Estudiantes</h1>
	<form action="generadorJSON.php" method="POST">
		<input type='text' name='id'>
		<input type='submit' value='buscar'>
	</form>
	<?php if($encontrado){?>
		<ul>
			<li>
				<p><span style="color: red;">Id: </span><?php echo $alumno->id;?></p>
			</li>
			<li>
				<p><span style="color: red;">Nombre: </span><?php echo $alumno->nombre;?></p>
			</li>
			<li>
				<p><span style="color: red;">Apellido: </span><?php echo $alumno->apellido;?></p>
			</li>
		</ul>
	<?php }else{?>
		<h1>NO EXISTE NINGUN ALUMNO CON ESE ID</h1>
	<?php }?>
</body>
</html>

