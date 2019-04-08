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

$colname_usuario = "-1";
if (isset($_GET['usuario'])) {
  $colname_usuario = $_GET['usuario'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_usuario = sprintf("SELECT * FROM productos WHERE usuario = %s", GetSQLValueString($colname_usuario, "int"));
$usuario = mysql_query($query_usuario, $midespensa) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

  
    $codigo_tabla_listado_productos = $_GET['codigo'];
    $nombre_tabla_listado_productos = $_GET['nombre'];
    $peso_producto_listado_productos = $_GET['peso_producto'];
	$pesorasp=$_GET['peso_leido'];
    $usuario= $_GET['usuario'];
	
	
mysql_free_result($usuario);
?>
<?php
//si no esta en la tabla quiere decir que es el primer producto que introduce
   if($totalRows_usuario == 0){
               $servername = "rdbms.strato.de";
             $username = "U2999181";
             $password = "santiago87";
             $dbname = "DB2999181";

             
             // Create connection
             $conn = new mysqli($servername, $username, $password, $dbname);
             // Check connection
             if ($conn->connect_error) {
                       die("Connection failed: " . $conn->connect_error);
                          }
             
             $sql = "INSERT INTO productos (codigo,nombre,peso_actual,peso_producto,usuario)
            VALUES('$codigo_tabla_listado_productos','$nombre_tabla_listado_productos','$pesorasp','$peso_producto_listado_productos','$usuario')";

             if ($conn->query($sql) === TRUE) {
			          
                  echo $l=1;
                    } else {
                           echo "Error: " . $sql . "<br>" . $conn->error;
                           }

              $conn->close();
   }
   else{
        $codigo_tabla_productos = $row_usuario['codigo'];
    $nombre_tabla_productos = $row_usuario['nombre'];
    $peso_actual_producto_tabla_productos = $row_usuario['peso_actual'];
	$peso_producto_tabla_productos = $row_usuario['peso_producto'];
    $usuario_tabla_productos = $row_usuario['usuario'];
  
  echo '<script language="javascript">window.location="producto_introducido3.php?codigo_tabla_productos&nombre_tabla_productos&peso_actual_producto_tabla_productos&peso_producto_tabla_productos&usuario_tabla_productos&pesorasp"</script>'; 
   }
?>
<?php
   
    

?>   