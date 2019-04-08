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
//datos que recibimos desde la raspberry.pi
//$codigo=$_GET['codigo'];
//$peso=$_GET['peso'];
//$id_usuario=$GET['id_usuario'];

$colname_consulta_registro = "-1";
if (isset($_GET['codigo'])) {
  $colname_consulta_registro = $_GET['codigo'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_consulta_registro = sprintf("SELECT * FROM listado_productos WHERE codigo = %s", GetSQLValueString($colname_consulta_registro, "text"));
$consulta_registro = mysql_query($query_consulta_registro, $midespensa) or die(mysql_error());
$row_consulta_registro = mysql_fetch_assoc($consulta_registro);
$totalRows_consulta_registro = mysql_num_rows($consulta_registro);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
// deberiamos mandar el usuario, codigo y telefono de contacto.
	// Show if recordset empty

<?php if ($totalRows_consulta_registro > 0) { // Show if recordset not empty ?>
  <table border="1">
    <tr>
      <td>id_producto</td>
      <td>codigo</td>
      <td>nombre</td>
      <td>peso_producto</td>
      
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_consulta_registro['id_producto']; ?></td>
        <td><?php echo $row_consulta_registro['codigo']; ?></td>
        <td><?php echo $row_consulta_registro['nombre']; ?></td>
        <td><?php echo $row_consulta_registro['peso_producto']; ?></td>
      </tr>
      <?php } while ($row_consulta_registro = mysql_fetch_assoc($consulta_registro)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  
<?php 

	$to = "santiagofragio@gmail.com";
	$subject = "codigo inexistente";
	$txt = "Se ha supervisado el parte de " . $_GET['codigo'];
	$headers = "De: Apps on-line" . "\r\n" ;
	mail($to,$subject,$txt,$headers);


 ?>
  
</body>
</html>
<?php
mysql_free_result($consulta_registro);
?>
