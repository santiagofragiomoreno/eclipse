<?php
//----------------------------------------------
session_start();
include "functions.php";
$ruta = explode("/",$_SERVER['REQUEST_URI']);
$profundidad_directorios = 3;
$directorio_base = "http://localhost/CEI/APP/";
$ruta_api = "http://localhost/CEI/API/";
for($i=0;$i<$profundidad_directorios;$i++){
    array_shift($ruta);
}
$pagina = 0;
//si existe $ruta de cero....hacemos un switch para ver donde quiere ir la persona
if(isset($ruta[0])){
    //determinamos a donde le mandamos
    switch ($ruta[0]){
        case "login":
            //preguntamos si ya existe el usuario.....le mandamos a la home
            if(isset($_SESSION['usuario'])){
                redirect($directorio_base);
            }
            else{
                $pagina = 1;
            }
            break;
        case "ponencias":
            //preguntamos si no existe el usuario.....le mandamos al login otra vez
            if(!isset($_SESSION['usuario'])){
                redirect($directorio_base."login");
            }
            //si existe
            else{
                if(isset($ruta[1]) && is_numeric($ruta[1])){
                    $pagina = 3; // le mandamos a ponencias con id
                }
                else{
                    $pagina = 2; // le mandamos a ponencias(en abierto)
                }
            }
            break;
        case "ponentes":
            //preguntamos si no existe el usuario.....le mandamos al login otra vez
            if(!isset($_SESSION['usuario'])){
                redirect($directorio_base."login");
            }
            //si existe
            else{
                if(isset($ruta[1]) && is_numeric($ruta[1])){
                    $pagina = 5; // le mandamos a ponentes con id
                }
                else{
                    $pagina = 4; // le mandamos a ponentes(en abierto)
                }
            }
            break;
            case "perfil":
            //preguntamos si no existe el usuario.....le mandamos al login otra vez
            if(!isset($_SESSION['usuario'])){
                redirect($directorio_base."login");
            }
            //si existe
            else{
                $pagina = 6;
            }
            break;
            case "pregunta":
                //preguntamos si no existe el usuario.....le mandamos al login otra vez
                if(!isset($_SESSION['usuario'])){
                    redirect($directorio_base."login");
                }
                //si existe
                else{
                    $pagina = 7;
                }
                break;
            default:
                //preguntamos si no existe el usuario.....le mandamos al login otra vez
                if(!isset($_SESSION['usuario'])){
                    redirect($directorio_base."login");
                }
                //si existe
                else{
                    if($ruta[0] != ""){
                        redirect($directorio_base);
                    } 
                }
                break;
    }
}
include "header.php";
include "footer.php";
switch($pagina){
    case 0:
        include "home.php";
        break;
    case 1:
        include "login.php";
        break;
    case 2:
        include "ponencias.php";
        break;
    case 3:
        include "ponencias.php";
        break;
    case 4:
        include "ponentes.php";
        break;
    case 5:
        include "ponentes.php";
        break;
    case 6:
        include "perfil.php";
        break;
    case 7:
        include "pregunta.php";
        break;
}
?>
