<?php 
 // establecemos la conexion con la base e datos
require_once('Connections/openConexion.php'); ?>

<?php 

if(isset($_GET('params'))){
    // establecemos la conexion con  la BBDD del servidor
    $servername = "localhost";
    $username = "u823703154_root";
    $database = "u823703154_estu";
    $password = "santiago87";
    //  Create a new connection to the MySQL database using PDO
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
        $consulta = "INSERT INTO usuarios (nombre) VALUES ('conexion raspberry')";
        if($conn->query($consulta) === true){
            echo "insert realizado con exito";
        }
        else{
            echo "error al insertar";
        }
    }
   
    
    $conn->close();
    
 }

?>   
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<form action="conexion_raspberry.php" method="POST">
	<input name='usuario' type='text' value="">
	<input name='apellido' type='text' value="">
	<input type='submit' value='crear'>
</form>
</body>
</html>