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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "insertar")) {
  $insertSQL = sprintf("INSERT INTO productos (codigo_producto, nombre_producto, minimo_producto, id_usuario) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['codigo'], "text"),
                       GetSQLValueString($_POST['nombreproducto'], "text"),
                       GetSQLValueString($_POST['minimo'], "double"),
                       GetSQLValueString($_POST['idusuario'], "int"));

  mysql_select_db($database_midespensa, $midespensa);
  $Result1 = mysql_query($insertSQL, $midespensa) or die(mysql_error());

  $insertGoTo = "sesion.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="utf-8">
  <title>Mi despensa ON-LINE - Sesión</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
  <meta property="og:title" content="">
	<meta property="og:type" content="website">
	<meta property="og:url" content="">
	<meta property="og:site_name" content="">
	<meta property="og:description" content="">

  <!-- Styles -->
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/colors/green.css"><!--Replace Your Color-->
  <link rel="stylesheet" href="../css/custom-styles.css">

  <script src="../js/modernizr-2.7.1.js"></script>

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="/favicon.ico">
</head>

<body id="top">
  
    
    
    
  
    
<!--Project Image Carousel-->
    

    
    <!--Services-->
    <section class="white-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 text-center">
          <h3>Alta de producto</h3>
          <br />
          <form method="POST" action="<?php echo $editFormAction; ?>" name="insertar" role="form" id="insertar">
            <div class="form-group">
              <input name="codigo" type="hidden" value="<?php echo $_GET['codigo']; ?>" >
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="descripcion"  name="nombreproducto" placeholder="Descripción">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="minimo"  name="minimo" placeholder="Defina el mínimo">
            </div>
            <br />
            <input name="idusuario" type="hidden" value="<?php echo $_GET['idusuario']; ?>">
            <input name="Enviar" type="submit" class="btn btn-secondary btn-lg" value="Grabar">
            <input type="hidden" name="MM_insert" value="insertar">
          </form>
        </div>
      </div>
      </section>
      
      
      
      <!--Footer-->
      
      
      
      
    </div>
    <!--End Wrapper-->
  
    
    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery.isotope.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/main.js"></script>
    
    
       
</body>
</html>