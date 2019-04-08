<?php
$conexion = new mysqli('localhost','root','','datos_api');
if(isset($id_consulta)){
    $consulta = "SELECT * FROM ponencias WHERE id =".$id_consulta;
}
else{
    $consulta = "SELECT * FROM ponencias";
}

$respuesta = array();
$contador = 0;
$ids_ponentes = array();
$ponentes = array();
$contador_ponentes = 0;
$resultado = $conexion->query($consulta);
if($resultado->num_rows>0){
    while ($fila = $resultado->fetch_assoc()){
        $respuesta[$contador] = $fila;
        //una vez que estamos en el campo de los id´s de los ponentes de la tabla ponencias....nos traemos cada uno de los ponentes
        if($respuesta[$contador]['ponentes'] != ''){
            $ids_ponentes = explode(",", $respuesta[$contador]['ponentes']);
            //hacemos la consult por cada uno de los ids de los ponenetes que tenemos en el array
            for($i=0;$i<count($ids_ponentes);$i++){
                $consulta2 = "SELECT id,nombre,foto FROM ponentes WHERE id=".$ids_ponentes[$i];
                $resultado_ponentes = $conexion->query($consulta2);
                if($resultado_ponentes->num_rows > 0){
                    while($fila = $resultado_ponentes->fetch_assoc()){
                        $ponentes[$i]['id'] = $fila['id'];
                        $ponentes[$i]['nombre'] = $fila['nombre'];
                        $ponentes[$i]['foto'] = $fila['foto'];
                    }
                }
                //array_push($respuesta[$contador]['ponentes'][$i], $ponentes);
            }
            //limpiamos el campo ponentes
            //metemos en el campo ponentes de pnecias cada uno de los ponentes con toda su info.
            $respuesta[$contador]['ponentes'] = $ponentes;           
        }
        $contador++;
    }
}

echo json_encode($respuesta);


?>