<?php
$palabra = $_GET['palabra'];

$palabra = str_split($palabra);
for($i=0;$i<count($palabra);$i++){
    switch ($palabra[$i]){
        case 'e': $palabra[$i] = 3;
        break;
        case 'a': $palabra[$i] = 4;
        break;
        case 's': $palabra[$i] = 5;
        break; 
    };
}
$palabra = implode($palabra);
print_r ($palabra);
?>