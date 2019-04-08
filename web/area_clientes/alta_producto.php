<?php require_once('../Connections/midespensa.php'); ?><?php
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
$MM_authorizedUsers = "administrador,cliente";
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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="producto_existe.php";
  $loginUsername = $_POST['codigo'];
  $LoginRS__query = sprintf("SELECT codigo_producto FROM productos WHERE codigo_producto=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_midespensa, $midespensa);
  $LoginRS=mysql_query($LoginRS__query, $midespensa) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
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

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_usuario = sprintf("SELECT * FROM usuarios WHERE email = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $midespensa) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
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
  
  <div class="wrapper">
    
    
    <div class="navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Mi despensa ON-LINE</a>
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
    

    
    <!--Services-->
    <section class="white-bg">
<div class="container">
        
  <div class="row">
          
<div class="col-sm-6 col-sm-offset-3 text-center">
            <h3>Alta de producto</h3><br />
            
  					<form method="POST" action="<?php echo $editFormAction; ?>" name="insertar" role="form" id="insertar">
              <div class="form-group">
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Introduzca el código">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="descripcion"  name="nombreproducto" placeholder="Descripción">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="minimo"  name="minimo" placeholder="Defina el mínimo">
              </div>
              <br />
              <div>
              <input name="idusuario" type="hidden" value="<?php echo $row_usuario['id_usuario']; ?>">
                <input name="Enviar" type="submit" class="btn btn-secondary btn-lg" value="Grabar">&nbsp;
                <a href="listado_productos.php?idusuario=<?php echo $row_usuario['id_usuario']; ?>" class="btn btn-secondary btn-lg">Volver</a>              </div>
              <input type="hidden" name="MM_insert" value="insertar">
	</form>
      	  
    </div>    </section>
    
    
           
    <!--Footer-->
    
    
    <section id="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
          <img src="img/boxia-icon.png" alt="Boxia Icon">
          <p><small>Copyright @ midespensaonline.com - 2017 Todos los derechos reservados - <a href="privacidad.html">Política de privacidad</a></small></p>

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
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/main.js"></script>
    
    
       
</body>
</html>
<?php
mysql_free_result($usuario);
?>
