<?php

    $conexion = new mysqli('localhost','root','','tres_colores');
    if($conexion->connect_error){
        die($conexion->connect_error);
    }



    $ruta = explode("/",$_SERVER['REQUEST_URI']);
    $profundidad_directorios = 3;
    for($i=0;$i<$profundidad_directorios;$i++){
        array_shift($ruta);
    }
    $json = json_decode(file_get_contents("datos.json"));
    $idioma = 0;
    $idioma_bbdd = 1;
    $pagina = 0;
    $directorio_base = "http://localhost/CEI/tres_colores_BBDD/";
    // si llegamos con la parte dde la ruta: /es   /fr   /en
    if(count($ruta)<2){
    	switch($ruta[0]){
    		case "es":
    			$idioma = 0;
    			break;
    		case "fr":
    			$idioma = 1;
    			break;
    		case "en":
    			$idioma = 2;
    			break;
    		default:
    			header("Location: http://localhost/CEI/tres_colores_BBDD/es");
    			break;
    	}
    }
    // si no...la ruta viene completa con /es/azul     /es/blanco    /es/rojo
    elseif(count($ruta)==2){
    	$idioma = ($ruta[0]=="es") ? 0 : (($ruta[0]=="fr") ? 1 : 2);
    	switch ($ruta[1]) {
    		case "azul":
    			$pagina = 1;
    			break;
    		case "blanco":
    			$pagina = 2;
    			break;
    		case "rojo":
    			$pagina = 3;
    			break;
    		case "bio":
    			$pagina = 4;
    			break;
    		default:
    			header("Location: http://localhost/CEI/tres_colores_BBDD/es");
    			break;
    	}
    }else{
    	header("Location: http://localhost/CEI/tres_colores_BBDD/es");
    }
    
    $paginas = array();
    $contador_paginas = 0;
    if($idioma < 1){
        //estamos en español
        $consulta = "SELECT nombre,url FROM paginas ORDER BY orden";
    }
    else{
        $consulta = "SELECT paginas.url, paginas.titulo, traducciones.nombre FROM paginas INNER JOIN traducciones ON paginas.id = traducciones.pagina               WHERE traducciones.idioma =".$idioma." ORDER BY paginas.orden";
    }
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows > 0){
        while($fila = $resultado->fetch_assoc()){
            $paginas[$contador_paginas] = $fila;
            $contador_paginas++;
        }
    }
?>
<?php
	$titulo = array("Tres colores","Trois couleurs","Three colors"); 
?>
<?php
	include "header.php";
	switch ($pagina) {
	 	case 0:
	 		include "home.php";
	 		//print_r ($paginas);
	 		break;
	 	default:
	 		include "pagina.php";
	 		break;
	 } 
	 
	 $conexion->close();
?>
