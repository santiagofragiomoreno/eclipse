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

$colname_codigo_consultado = "-1";
if (isset($_GET['codigo'])) {
  $colname_codigo_consultado = $_GET['codigo'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_codigo_consultado = sprintf("SELECT codigo, nombre, peso_producto FROM listado_productos WHERE codigo = %s", GetSQLValueString($colname_codigo_consultado, "text"));
$codigo_consultado = mysql_query($query_codigo_consultado, $midespensa) or die(mysql_error());
$row_codigo_consultado = mysql_fetch_assoc($codigo_consultado);
$totalRows_codigo_consultado = mysql_num_rows($codigo_consultado);

$colname_usuario_consultado = "-1";
if (isset($_GET['usuario'])) {
  $colname_usuario_consultado = $_GET['usuario'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_usuario_consultado = sprintf("SELECT codigo, nombre, peso_actual, peso_producto, usuario, fecha FROM productos WHERE usuario = %s", GetSQLValueString($colname_usuario_consultado, "int"));
$usuario_consultado = mysql_query($query_usuario_consultado, $midespensa) or die(mysql_error());
$row_usuario_consultado = mysql_fetch_assoc($usuario_consultado);
$totalRows_usuario_consultado = mysql_num_rows($usuario_consultado);


     $codigo=$_GET['codigo'];
     $pesorasp=$_GET['peso_leido'];
     $usuario= $_GET['usuario'];
	  
$codigo_consulta = $row_codigo_consultado['codigo'];
$nombre_consulta = $row_codigo_consultado['nombre'];
$peso_prdoucto_consulta = $row_codigo_consultado['peso_producto'];

mysql_free_result($codigo_consultado);

mysql_free_result($usuario_consultado);
?>
<?php
   if($totalRows_usuario_consultado > 0){
    
	echo $row_usuario_consultado['usuario'];
	echo $row_usuario_consultado['codigo'];
	echo $row_usuario_consultado['nombre'];
	echo $row_usuario_consultado['peso_producto'];
	echo $row_usuario_consultado['peso_actual'];
   }
   else{
   
           
			  echo "usuario y producto introducido";
	}

?>