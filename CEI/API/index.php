<?php
//--------codigo de conexion a la base de datos
$conexion = new mysqli('localhost','root','','datos_api');
$conexion->set_charset('utf8');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
    echo "Error en la conexion con la Base de Datos";
}
//----------------------------------------------
//obtenemos la url y la separamos en un array
$ruta = explode("/",$_SERVER['REQUEST_URI']);
$profundidad_directorios = 3;
for($i=0;$i<$profundidad_directorios;$i++){
    array_shift($ruta);
}
//preguntamos si el TOKEN es valido
//$ruta[count($ruta)-1]---siempre recogerá el ultimo valor del array $ruta (que en este caso sera el token
//le añadimos un ---> is_numeric(), para asegurarnos que el token no lleva letras añadidas
$token = (is_numeric($ruta[count($ruta)-1]))?intval($ruta[count($ruta)-1]):0;//funcion que genera el valor entero de lo que le metamos
$msg = array("error" => "Acceso Denegado");
//comprobacion del token para tener acceso a la API
if(($token-6)%7 == 0){
    //si en la ruta tenemos--- accion/token, comprobamos si la accion es valida
    if(count($ruta) == 2){ 
        switch ($ruta[0]){
            case 'ponentes':
                include "ponentes.php";
            break;
            case 'ponencias':
                include "ponencias.php";
                break;
            case 'asistentes':
                include "asistentes.php";
                break;
            case 'asistente':
                include "asistente.php";
                break;
            case 'preguntas':
                include "preguntas.php";
                break;
            case 'pregunta':
                include "pregunta.php";
                break;
            case 'update_asistente':
                include "update_asistente.php";
                break;
            case 'votar':
                include "votar.php";
                break;
            default:
                echo json_encode($msg);
            break;
        }
    }
    //si en la ruta tenemos--- accion/id/token, comprobamos si el id es valido
    else if(count($ruta) == 3){ 
        //comprobamos si el id que nos viene en la url es realmente un id numerico------> accion/id/token
        if(is_numeric($ruta[1])){
            $id_consulta = $ruta[1];
            switch ($ruta[0]){
                case 'ponentes':
                    include "ponentes.php";
                break;
                case 'ponencias':
                    include "ponencias.php";
                break;
                case 'asistentes':
                    include "asistentes.php";
                    break;
                case 'preguntas':
                    include "preguntas.php";
                    break;
                default:
                    echo json_encode($msg);
                    break;
            }
        }
        else{
            echo json_encode($msg);
        }
    }else {
        echo json_encode($msg);
    }
}
else{
    echo json_encode($msg);
}
//--------------- cerramos conexion -------------
$conexion->close();

?>


