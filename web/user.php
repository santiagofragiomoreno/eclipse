<?php

if(isset($_POST['email']) && isset($_POST['password'])){
    if($_POST['email'] != '' && $_POST['password'] != ''){
        echo "recibido email y contraseña";
    }
    else{
        echo "alguno de los campos esta vacio";
    }
}
else{
    echo "error en POST";
}
?>