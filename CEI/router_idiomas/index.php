<?php  
    //echo $_SERVER['REQUEST_URI'];
    $json = json_decode(file_get_contents("datos.json"));
    $ruta = explode("/",$_SERVER['REQUEST_URI']);
    $profundidad_directorios = 3;
    $directorio_base = "http://127.0.0.1/Ejercicios/Router_Idiomas/";
    for($i=0;$i<$profundidad_directorios;$i++){
        array_shift($ruta);
    }
    print_r($ruta);
    $idioma = 0;
    $pagina = 0;
    if(count($ruta)<2){
        switch ($ruta[0]) {
            case "es":
                $idioma = 0;
                break;

            case "en":
                $idioma = 1;
                break;

            default:
                header("Location: http://127.0.0.1/Ejercicios/Router_Idiomas/es");
                exit;
                break;

        }
    }else{
        $idioma = ($ruta[0]=="en") ? 1 : 0;
        switch ($ruta[1]) {
            case "home":
                $pagina = 0;
                break;
            
            case "uno":
                $pagina = 1;
                break;

            case "dos":
                $pagina = 2;
                break;

            case "tres":
                $pagina = 3;
                break;

            default:
                header("Location: http://127.0.0.1/Ejercicios/Router_Idiomas/es");
                exit;
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    include "header.php"; 
    switch ($pagina) {
        case 0:
            include "home.php";
            break;
        case 1:
            include "uno.php";
            break;
        case 2:
            include "dos.php";
            break;
        case 3:
            include "tres.php";
            break;
    }
    ?>
    <?php echo $idioma; ?>
</body>
</html>