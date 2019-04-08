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

$productoseleccionado_Recordset1 = "-1";
if (isset($_GET['idproducto'])) {
  $productoseleccionado_Recordset1 = $_GET['idproducto'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_Recordset1 = sprintf("SELECT consumo_productos.id_consumo, consumo_productos.id_producto, consumo_productos.id_usuario, consumo_productos.fecha_consumo, consumo_productos.consumo_producto FROM consumo_productos WHERE consumo_productos.id_producto=%s ", GetSQLValueString($productoseleccionado_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $midespensa) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id_consumo</td>
    <td>id_producto</td>
    <td>id_usuario</td>
    <td>fecha_consumo</td>
    <td>CONSUMO</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id_consumo']; ?></td>
      <td><?php echo $row_Recordset1['id_producto']; ?></td>
      <td><?php echo $row_Recordset1['id_usuario']; ?></td>
      <td><?php echo $row_Recordset1['fecha_consumo']; ?></td>
      <td><?php echo $row_Recordset1['consumo_producto']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
