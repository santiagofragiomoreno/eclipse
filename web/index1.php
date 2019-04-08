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

$colname_codigocomprueba = "-1";
if (isset($_GET['codigo'])) {
  $colname_codigocomprueba = $_GET['codigo'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_codigocomprueba = sprintf("SELECT * FROM listado_productos WHERE codigo = %s", GetSQLValueString($colname_codigocomprueba, "text"));
$codigocomprueba = mysql_query($query_codigocomprueba, $midespensa) or die(mysql_error());
$row_codigocomprueba = mysql_fetch_assoc($codigocomprueba);
$totalRows_codigocomprueba = mysql_num_rows($codigocomprueba);
?>
<?php if ($totalRows_codigocomprueba == 0) { 

   $id_usuario = $_GET['id_usuario'];
   $peso = $_GET['peso'];
   $header = 'From: ' . $id_usuario . " \r\n";
   $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
   $header .= "Mime-Version: 1.0 \r\n";
   $header .= "Content-Type: text/plain";
   $mensaje = "Este mensaje fue enviado por usuario con identificativo:" . $id_usuario . " \r\n";
   $mensaje .= "este producto no esta en la despensa:holaaaaaaaa " . $_GET['codigo']." \r\n";
   $mensaje .= "Mensaje: error al introducir el producto.holaholaa" . $_POST['mensaje'] . " \r\n";
   $mensaje .= "Enviado el " . date('d/m/Y', time());
   $para = 'contacto.midespensaonline@gmail.com';
   $asunto = 'error de producto';
   mail($para, $asunto, $mensaje, $header);
   echo '&estatus=ok&';
   
   echo '<script language="javascript">window.location="mail2.php?ok=3"</script>';
    
   } 
   ?>
<?php   mysql_free_result($codigocomprueba);
?>