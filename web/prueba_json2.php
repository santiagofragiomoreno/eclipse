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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "inserta")) {
  $insertSQL = sprintf("INSERT INTO productos (codigo, nombre, peso_actual) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['codigo'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['peso_actual'], "double"));

  mysql_select_db($database_midespensa, $midespensa);
  $Result1 = mysql_query($insertSQL, $midespensa) or die(mysql_error());

  $insertGoTo = "index.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_comparacionproducto = "-1";
if (isset($_GET['codigo'])) {
  $colname_comparacionproducto = $_GET['codigo'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_comparacionproducto = sprintf("SELECT * FROM listado_productos WHERE codigo = %s", GetSQLValueString($colname_comparacionproducto, "text"));
$comparacionproducto = mysql_query($query_comparacionproducto, $midespensa) or die(mysql_error());
$row_comparacionproducto = mysql_fetch_assoc($comparacionproducto);
$totalRows_comparacionproducto = mysql_num_rows($comparacionproducto);
?>
<?php
   $codigo=$_GET['codigo'];
   $peso=$_GET['peso'];
   $nombre = $row_comparacionproducto['nombre'];
?>


<form action="<?php echo $editFormAction; ?>" method="POST" name="inserta" id="inserta">

<input name="codigo" type="hidden" value="$codigo">
<input name="peso_actual" type="hidden" value="$peso">
<input name="nombre" type="hidden" value="<?php echo $row_comparacionproducto['nombre']; ?>">

<input name="insertar" type="button" value="insertar">
<input type="hidden" name="MM_insert" value="inserta">


</form>
<?php
mysql_free_result($comparacionproducto);
?>
