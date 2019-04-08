<?php
   // establecemos la conexion con  la BBDD del servidor 
function conexionBD($dev){
    
    //estamos en local (desarrollo
    if($dev ==1){
        $servername = "localhost";
        $username = "root";
        $database = "db2999181";
        $password = "";
    }
    //estamos en el .com
    else{
        $servername = "localhost";
        $username = "u823703154_root";
        $database = "u823703154_estu";
        $password = "santiago87";
    }
    //  Create a new connection to the MySQL database using PDO
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return false;
    }
    else{
        return $conn;
    }
}
   
?>