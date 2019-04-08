<?php
//funcion para generar tokens
function token(){
    return (mt_rand(10,10000)*7)+6;
}
echo token();
?>