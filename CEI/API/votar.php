<?php
$error = array("resultado" => "ko");
$success = array("resultado" => "ok");


if(isset($_POST['id_pregunta']) && isset($_POST['id_votante'])){
    $consulta = "SELECT * FROM preguntas WHERE id =".$_POST['id_pregunta'];
    $respuesta = $conexion -> query($consulta);
    
    $respuesta_votar = array();
    $contador = 0;
    if($respuesta -> num_rows > 0){
        while ($fila = $respuesta -> fetch_assoc()){
            $respuesta_votar[$contador] = $fila;
            $contador++;
        }
    }
    
    //print_r($respuesta_votar);
    $votantes = explode(',', $respuesta_votar[0]['votantes']);//votantes EN ARRAY
    //print_r($votantes);
    $votantes_def = array();
    
    //busca en el array votantes(45,67,78) que son los que se han colocado ahí al votar por la pregunta, el id del votante que me estan pasando por post(que es el que quiere votar por esa pregunta)
    $indice_votante = array_search($_POST['id_votante'], $votantes); //te devuelve la posicion
    if($indice_votante !== false){ //SI LO HAS ENCONTRADO, ES QUE ESTÁ
        for($i=0; $i<count($votantes); $i++){ //recorre el bucle
            if($votantes[$i] !== $_POST['id_votante']){ //si lo que encuentres es diferente al POST, lo quitas
                array_push($votantes_def, $votantes[$i]); //me creas un array sin ese
            }
        }
        $votos = intval($respuesta_votar[0]['votos']) - 1; //le restamos un voto, xq se quiere desvotar
        
        $votantes_def = implode(',',$votantes_def);//hay que convertirlo en string porque lo teniamos en array para volverlo a introducir en la bbdd tabla preguntas
        $consulta = "UPDATE preguntas SET votantes = '".$votantes_def."' , votos = ".$votos." WHERE id =".$_POST['id_pregunta'];
        //$resultado = $conexion ->query($consulta);
        //$conexion -> query($consulta);
    }else{ //si no está, esque no lo ha encontrado
        array_push($votantes, $_POST['id_votante']); //lo añadimos al array votantes lo que viene por POST
        $votantes_def = implode(',',$votantes); //en el nuevo array lo convertimos a string igual para el UPDTE
        $votos = intval($respuesta_votar[0]['votos']) + 1; //sumamos uno porque quiero votar
        $consulta = "UPDATE preguntas SET votantes = '".$votantes_def."' , votos = ".$votos." WHERE id =".$_POST['id_pregunta'];
        //$conexion -> query($consulta);
        
        
    }
    
    if($conexion -> query($consulta) === TRUE){
        echo json_encode($success);
    }else{
        echo json_encode($error);
    }
    
    //print_r($votantes);
    //print_r($votantes_def);
    //echo $votantes_def;
    
    
}
?>