<?php require_once('../Connections/midespensa.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_productos = "-1";
if (isset($_GET['codigo'])) {
  $colname_productos = $_GET['codigo'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_productos = sprintf("SELECT * FROM productos WHERE codigo_producto = %s", GetSQLValueString($colname_productos, "text"));
$productos = mysql_query($query_productos, $midespensa) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);

$servername = "rdbms.strato.de";
$username = "U3104127";
$password = "santiago87";
$dbname = "DB3104127";

$codigo=$_GET['codigo'];
$peso=$_GET['consumo'];
$idusuario=$_GET['usuario'];
$producto=$row_productos['id_producto'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO consumo_productos (id_producto, id_usuario, consumo_producto)
VALUES ('$producto' , '$idusuario' , '$peso')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

mysql_free_result($productos);
?>