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

mysql_select_db($database_midespensa, $midespensa);
$query_listadoproductos = "SELECT * FROM productos3 ORDER BY nombre ASC";
$listadoproductos = mysql_query($query_listadoproductos, $midespensa) or die(mysql_error());
$row_listadoproductos = mysql_fetch_assoc($listadoproductos);
$totalRows_listadoproductos = mysql_num_rows($listadoproductos);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id</td>
    <td>codigo</td>
    <td>nombre</td>
    <td>peso_actual</td>
    <td>cantidad</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_listadoproductos['id']; ?></td>
      <td><?php echo $row_listadoproductos['codigo']; ?></td>
      <td><?php echo $row_listadoproductos['nombre']; ?></td>
      <td><?php echo $row_listadoproductos['peso_actual']; ?></td>
      <td><?php echo $row_listadoproductos['cantidad']; ?></td>
    </tr>
    <?php } while ($row_listadoproductos = mysql_fetch_assoc($listadoproductos)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($listadoproductos);
?>
