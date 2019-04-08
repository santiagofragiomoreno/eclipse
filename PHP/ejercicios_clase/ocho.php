<?php

$a = $_GET['a'];

switch ($a){
    case 5: 
        echo 'Se ha introducido un 5';
        break;
    case 10: 
        echo 'Se ha introducido un 10';
        break;
    default: echo 'Numero no identificado';
    break;
        
};

?>
