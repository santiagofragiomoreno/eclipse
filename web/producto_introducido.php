<?php require_once('Connections/midespensa.php'); ?>
<?php
  
     $codigo=$_GET['codigo'];
     $pesorasp=$_GET['peso_leido'];
     $usuario= $_GET['usuario'];
	 
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

$colname_productousuario = "-1";
if (isset($_GET['usuario'])) {
  $colname_productousuario = $_GET['usuario'];
}
$codigosolicitado_productousuario = "-1";
if (isset($_GET['codigo'])) {
  $codigosolicitado_productousuario = $_GET['codigo'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_productousuario = sprintf("SELECT * FROM productos WHERE id_usuario = %s AND productos.codigo=%s", GetSQLValueString($colname_productousuario, "int"),GetSQLValueString($codigosolicitado_productousuario, "text"));
$productousuario = mysql_query($query_productousuario, $midespensa) or die(mysql_error());
$row_productousuario = mysql_fetch_assoc($productousuario);
$totalRows_productousuario = mysql_num_rows($productousuario);
echo "HOLA";
?>
<?php	 
mysql_free_result($productousuario);
?>

	