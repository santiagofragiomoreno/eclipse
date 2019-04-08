<?php
include "Connections/openConexionRB.php";
include "utils/validaciones.php";
$dev = 1;
$pro = 0;
if(isset($_POST)){
    if($conn = conexionBD($dev)){
        //aqui deberiamos haver la validacion de los campos del formulario
        //1 que el campo del nombre no este vacio
        $campo_valido = 0;
        if(!$_POST['nombre'] && $_POST['nombre'] == ''){
            echo "El campo Nombre debe de estar relleno";
            $campo_valido = 1;
        }
        //1 que el campo appellido no este vacio
        if(!$_POST['apellidos'] && $_POST['apellido'] == ''){
            echo "El campo Apellido debe de estar relleno";
            $campo_valido = 1;
        }
        //1 que el campo email no este vacio y sea valido
        if($_POST['email'] && $_POST['email'] != ''){
            if(!comprobar_email($_POST['email'])){
               echo "email erroneo"; 
               $campo_valido = 1;
            }
        }
        if(!$campo_valido){
            $consulta = "INSERT INTO usuarios (nombre,apellidos,email) VALUES ('".$_POST['nombre']."','".$_POST['apellidos']."','".$_POST['email']."')";
            if($conn->query($consulta) === true){
                echo "insert realizado con exito";
            }
            else{
                echo "error al insertar";
            }
        }
        
        $conn->close();
    }
}
?>