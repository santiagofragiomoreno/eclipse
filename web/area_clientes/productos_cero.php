<?php require_once('../Connections/midespensa.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$usuario_productoscero = "-1";
if (isset($_GET['idusuario'])) {
  $usuario_productoscero = $_GET['idusuario'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_productoscero = sprintf("SELECT consumo_productos.id_consumo, consumo_productos.id_producto, consumo_productos.id_usuario, SUM(consumo_productos.consumo_producto), productos.id_producto, productos.nombre_producto, productos.minimo_producto, productos.codigo_producto FROM consumo_productos INNER JOIN productos ON consumo_productos.id_producto=productos.id_producto WHERE consumo_productos.id_usuario=%s GROUP BY consumo_productos.id_producto ORDER BY productos.nombre_producto", GetSQLValueString($usuario_productoscero, "int"));
$productoscero = mysql_query($query_productoscero, $midespensa) or die(mysql_error());
$row_productoscero = mysql_fetch_assoc($productoscero);
$totalRows_productoscero = mysql_num_rows($productoscero);

$colname_productos = "-1";
if (isset($_GET['idusuario'])) {
  $colname_productos = $_GET['idusuario'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_productos = sprintf("SELECT * FROM productos WHERE id_usuario = %s", GetSQLValueString($colname_productos, "int"));
$productos = mysql_query($query_productos, $midespensa) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);

mysql_select_db($database_midespensa, $midespensa);
$query_usuarios = "SELECT * FROM usuarios";
$usuarios = mysql_query($query_usuarios, $midespensa) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mi despensa ON-LINE - Sesión iniciada</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
  <meta property="og:title" content="">
	<meta property="og:type" content="website">
	<meta property="og:url" content="">
	<meta property="og:site_name" content="">
	<meta property="og:description" content="">

  <!-- Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  <link rel="stylesheet" href="../css/animate.css">
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
  
  <div class="wrapper">
    
    
    <div class="navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">myhomestock.com</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="sesion.php">Inicio</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['MM_Username']; ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="cambio_password.php">Cambio de contraseña</a></li>
                <li><a href="<?php echo $logoutAction ?>">Cerrar sesión</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
  
    
    <!--Project Image Carousel-->
    
    <section class="white-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-12 margin-30">
          <h4 align="center" class="black">Productos bajo mínimos</h4>
          <br>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
    <tr>
      <th>Código</th>
      <th>Producto</th>
      <th>Mínimo establecido</th>
      <th>Peso actual</th>
    </tr>
        </thead>
    <?php do { ?>
<?php if ($row_productoscero['SUM(consumo_productos.consumo_producto)'] <  $row_productoscero['minimo_producto'])                                                     { // Show if recordset empty ?>
      <tr>
        <td><?php echo $row_productoscero['codigo_producto']; ?></td>
        <td><?php echo $row_productoscero['nombre_producto']; ?></td>
        <td><?php echo $row_productoscero['minimo_producto']; ?></td>
        <td><?php echo $row_productoscero['SUM(consumo_productos.consumo_producto)']; ?></td>
      </tr>
  <?php } // Show if recordset empty ?>
      <?php } while ($row_productoscero = mysql_fetch_assoc($productoscero)); ?>
            </tbody>
          </table>
        </div>
</div>
</section>
    <!--Footer-->
    
    
    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
          <img src="img/boxia-icon.png" alt="Boxia Icon">
          <p><small>Copyright @ myhomestock.com - 2017 Todos los derechos reservados - <a href="privacidad.html">Política de privacidad</a></small></p>

          </div>
        </div>
      </div>
    </section>
  
</div><!--End Wrapper-->
  
    <a href="#" class="scrollToTop"><i class="fa fa-chevron-up"></i></a>
    
    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/wow.min.js"></script>
<script src="../js/jquery.isotope.min.js"></script>
<script src="../js/jquery.va</a>lidate.min.js"></script>
<script src="../js/main.js"></script>
    
    
       
</body>
</html>
<?php
mysql_free_result($productoscero);

mysql_free_result($productos);

mysql_free_result($usuarios);
?>
