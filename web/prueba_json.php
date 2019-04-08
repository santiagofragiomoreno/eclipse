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

<?php
$c = $_GET['codigo'];
$d = $_GET['peso'];
$e = $_GET['id_usuario'];
$l = 0;
if($totalRows_comparacionproducto == 0){
	
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
	 echo $l;
	 }
	else{
	         
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
             
             $sql = "INSERT INTO productos (codigo,nombre,peso_actual)
             VALUES ('$codigo','$nombre','$peso')";

             if ($conn->query($sql) === TRUE) {
			          
                  echo $l=1;
                    } else {
                           echo "Error: " . $sql . "<br>" . $conn->error;
                           }

              $conn->close();
           }

?>

<?php
mysql_free_result($comparacionproducto);
?>
