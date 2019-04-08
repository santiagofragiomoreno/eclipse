<?php
if(isset($id_consulta)){
    $consulta = "SELECT * FROM preguntas WHERE id =".$id_consulta;
}
else{
    $consulta = "SELECT * FROM preguntas";
}

$respuesta = array();
$contador = 0;
$resultado = $conexion->query($consulta);
if($resultado->num_rows>0){
    while ($fila = $resultado->fetch_assoc()){
        $respuesta[$contador] = $fila;
        $contador++;
    }
}
echo json_encode($respuesta);
?>