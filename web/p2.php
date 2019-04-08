<?php require_once('Connections/midespensa.php'); ?>
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

$colname_productos_usuario = "-1";
if (isset($_GET['usuario'])) {
  $colname_productos_usuario = $_GET['usuario'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_productos_usuario = sprintf("SELECT codigo, nombre, peso_actual, peso_producto FROM productos WHERE usuario = %s ORDER BY codigo ASC", GetSQLValueString($colname_productos_usuario, "int"));
$productos_usuario = mysql_query($query_productos_usuario, $midespensa) or die(mysql_error());
$row_productos_usuario = mysql_fetch_assoc($productos_usuario);
$totalRows_productos_usuario = mysql_num_rows($productos_usuario);


     $codigo=$_GET['codigo'];
     $pesorasp=$_GET['peso_leido'];
     $usuario= $_GET['usuario'];
	 

mysql_free_result($productos_usuario);

 echo $row_productos_usuario['nombre'] ;
?>