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

mysql_select_db($database_midespensa, $midespensa);
$query_lista_usuarios = "SELECT * FROM usuarios ORDER BY nombre ASC";
$lista_usuarios = mysql_query($query_lista_usuarios, $midespensa) or die(mysql_error());
$row_lista_usuarios = mysql_fetch_assoc($lista_usuarios);
$totalRows_lista_usuarios = mysql_num_rows($lista_usuarios);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

LISTA DE USUARIOS<br /><br />
<table border="1" cellspacing="2">
  <tr>
    <td>id</td>
    <td>nombre</td>
    <td>contrasena</td>
    <td>telefono</td>
    <td>email</td>
    <td>fecha_alta</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_lista_usuarios['id']; ?></td>
      <td><?php echo $row_lista_usuarios['nombre']; ?></td>
      <td><?php echo $row_lista_usuarios['contrasena']; ?></td>
      <td><?php echo $row_lista_usuarios['telefono']; ?></td>
      <td><?php echo $row_lista_usuarios['email']; ?></td>
      <td><?php echo $row_lista_usuarios['fecha_alta']; ?></td>
    </tr>
    <?php } while ($row_lista_usuarios = mysql_fetch_assoc($lista_usuarios)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($lista_usuarios);
?>
