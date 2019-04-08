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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_lista_productos_usuario = 5;
$pageNum_lista_productos_usuario = 0;
if (isset($_GET['pageNum_lista_productos_usuario'])) {
  $pageNum_lista_productos_usuario = $_GET['pageNum_lista_productos_usuario'];
}
$startRow_lista_productos_usuario = $pageNum_lista_productos_usuario * $maxRows_lista_productos_usuario;

$colname_lista_productos_usuario = "-1";
if (isset($_GET['idusuario'])) {
  $colname_lista_productos_usuario = $_GET['idusuario'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_lista_productos_usuario = sprintf("SELECT * FROM productos WHERE id_usuario = %s ORDER BY nombre_producto ASC", GetSQLValueString($colname_lista_productos_usuario, "int"));
$query_limit_lista_productos_usuario = sprintf("%s LIMIT %d, %d", $query_lista_productos_usuario, $startRow_lista_productos_usuario, $maxRows_lista_productos_usuario);
$lista_productos_usuario = mysql_query($query_limit_lista_productos_usuario, $midespensa) or die(mysql_error());
$row_lista_productos_usuario = mysql_fetch_assoc($lista_productos_usuario);

if (isset($_GET['totalRows_lista_productos_usuario'])) {
  $totalRows_lista_productos_usuario = $_GET['totalRows_lista_productos_usuario'];
} else {
  $all_lista_productos_usuario = mysql_query($query_lista_productos_usuario);
  $totalRows_lista_productos_usuario = mysql_num_rows($all_lista_productos_usuario);
}
$totalPages_lista_productos_usuario = ceil($totalRows_lista_productos_usuario/$maxRows_lista_productos_usuario)-1;

$maxRows_consumo = 10;
$pageNum_consumo = 0;
if (isset($_GET['pageNum_consumo'])) {
  $pageNum_consumo = $_GET['pageNum_consumo'];
}
$startRow_consumo = $pageNum_consumo * $maxRows_consumo;

$productoseleccionado_consumo = "-1";
if (isset($_GET['idproducto'])) {
  $productoseleccionado_consumo = $_GET['idproducto'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_consumo = sprintf("SELECT consumo_productos.id_consumo, consumo_productos.id_producto, consumo_productos.id_usuario, consumo_productos.fecha_consumo, consumo_productos.consumo_producto FROM consumo_productos WHERE consumo_productos.id_producto=%s ORDER BY consumo_productos.fecha_consumo DESC", GetSQLValueString($productoseleccionado_consumo, "int"));
$query_limit_consumo = sprintf("%s LIMIT %d, %d", $query_consumo, $startRow_consumo, $maxRows_consumo);
$consumo = mysql_query($query_limit_consumo, $midespensa) or die(mysql_error());
$row_consumo = mysql_fetch_assoc($consumo);

if (isset($_GET['totalRows_consumo'])) {
  $totalRows_consumo = $_GET['totalRows_consumo'];
} else {
  $all_consumo = mysql_query($query_consumo);
  $totalRows_consumo = mysql_num_rows($all_consumo);
}
$totalPages_consumo = ceil($totalRows_consumo/$maxRows_consumo)-1;

$productoseleccionado_pesoactual = "-1";
if (isset($_GET['idproducto'])) {
  $productoseleccionado_pesoactual = $_GET['idproducto'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_pesoactual = sprintf("SELECT SUM(consumo_productos.consumo_producto) as PESOACTUAL, consumo_productos.id_producto FROM consumo_productos WHERE consumo_productos.id_producto=%s", GetSQLValueString($productoseleccionado_pesoactual, "int"));
$pesoactual = mysql_query($query_pesoactual, $midespensa) or die(mysql_error());
$row_pesoactual = mysql_fetch_assoc($pesoactual);
$totalRows_pesoactual = mysql_num_rows($pesoactual);

$colname_usuarios = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuarios = $_SESSION['MM_Username'];
}
mysql_select_db($database_midespensa, $midespensa);
$query_usuarios = sprintf("SELECT * FROM usuarios WHERE email = %s", GetSQLValueString($colname_usuarios, "text"));
$usuarios = mysql_query($query_usuarios, $midespensa) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);

$queryString_lista_productos_usuario = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_lista_productos_usuario") == false && 
        stristr($param, "totalRows_lista_productos_usuario") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_lista_productos_usuario = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_lista_productos_usuario = sprintf("&totalRows_lista_productos_usuario=%d%s", $totalRows_lista_productos_usuario, $queryString_lista_productos_usuario);

$queryString_consumo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_consumo") == false && 
        stristr($param, "totalRows_consumo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_consumo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_consumo = sprintf("&totalRows_consumo=%d%s", $totalRows_consumo, $queryString_consumo);
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
    

    
    <!--Services-->
    <section class="white-bg">
    <div class="container">
      <?php if ($totalRows_consumo == 0) { // Show if recordset empty ?>
      <div class="row">
        <div class="col-md-12 margin-30">
          <h4 align="center" class="black">Listado de mis productos</h4>
          <br>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Mínimo establecido</th>
                <th>Fecha alta</th>
                <th>Consumo</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_lista_productos_usuario['codigo_producto']; ?></td>
                  <td><?php echo $row_lista_productos_usuario['nombre_producto']; ?></td>
                  <td><?php echo $row_lista_productos_usuario['minimo_producto']; ?></td>
                  <td><?php echo $row_lista_productos_usuario['fecha_alta']; ?></td>
                  <td><a href="listado_productos.php?idproducto=<?php echo $row_lista_productos_usuario['id_producto']; ?>&idusuario=<?php echo $_GET['idusuario']; ?>" class="btn btn-default btn-sm"><i class="fa fa-line-chart fa-lg"></i></a></td>
                  <td></td>
                </tr>
                <?php } while ($row_lista_productos_usuario = mysql_fetch_assoc($lista_productos_usuario)); ?>
            </tbody>
          </table>
        </div>
        
        
        <table border="0" align="center">
          <tr>
            <td><?php if ($pageNum_lista_productos_usuario > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_lista_productos_usuario=%d%s", $currentPage, 0, $queryString_lista_productos_usuario); ?>" class="btn btn-default"><i class="fa fa-angle-double-left"></i></a>
                  <?php } // Show if not first page ?>
            </td>
            <td><?php if ($pageNum_lista_productos_usuario > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_lista_productos_usuario=%d%s", $currentPage, max(0, $pageNum_lista_productos_usuario - 1), $queryString_lista_productos_usuario); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i></a>
                  <?php } // Show if not first page ?>
            </td>
            <td><?php if ($pageNum_lista_productos_usuario < $totalPages_lista_productos_usuario) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_lista_productos_usuario=%d%s", $currentPage, min($totalPages_lista_productos_usuario, $pageNum_lista_productos_usuario + 1), $queryString_lista_productos_usuario); ?>" class="btn btn-default"><i class="fa fa-arrow-right"></i></a>
                  <?php } // Show if not last page ?>
            </td>
            <td><?php if ($pageNum_lista_productos_usuario < $totalPages_lista_productos_usuario) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_lista_productos_usuario=%d%s", $currentPage, $totalPages_lista_productos_usuario, $queryString_lista_productos_usuario); ?>" class="btn btn-default"><i class="fa fa-angle-double-right"></i></a>
                  <?php } // Show if not last page ?>
            </td>
          </tr>
        </table>
        <a href="alta_producto.php" class="btn btn-secondary btn-lg"><i class="fa fa-cart-arrow-down fa-2x"></i>&nbsp;&nbsp;&nbsp;Anadir producto</a>
      </div>
        <?php } // Show if recordset empty ?>
    
    <?php if ($totalRows_consumo > 0) { // Show if recordset not empty ?>
      <div class="row">
        <div class="col-md-12 margin-30">
          <h4 align="center" class="black">Peso actual del producto: <?php echo $row_pesoactual['PESOACTUAL']; ?> </h4>
          <br>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Fecha consumo</th>
                <th>Consumo</th>
              </tr>
            </thead>
            <tbody>
              <?php do { ?>
                <tr>
                  <td><?php echo $row_consumo['fecha_consumo']; ?></td>
                  <td><?php echo $row_consumo['consumo_producto']; ?></td>
                </tr>
                <?php } while ($row_consumo = mysql_fetch_assoc($consumo)); ?>
            </tbody>
          </table>
        </div>
                
        <table border="0">
          <tr>
            <td><?php if ($pageNum_consumo > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_consumo=%d%s", $currentPage, 0, $queryString_consumo); ?>"><i class="fa fa-angle-double-left"></i></a>
                  <?php } // Show if not first page ?>
            </td>
            <td><?php if ($pageNum_consumo > 0) { // Show if not first page ?>
                  <a href="<?php printf("%s?pageNum_consumo=%d%s", $currentPage, max(0, $pageNum_consumo - 1), $queryString_consumo); ?>"><i class="fa fa-arrow-left"></i></a>
                  <?php } // Show if not first page ?>
            </td>
            <td><?php if ($pageNum_consumo < $totalPages_consumo) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_consumo=%d%s", $currentPage, min($totalPages_consumo, $pageNum_consumo + 1), $queryString_consumo); ?>"><i class="fa fa-arrow-right"></i></a>
                  <?php } // Show if not last page ?>
            </td>
            <td><?php if ($pageNum_consumo < $totalPages_consumo) { // Show if not last page ?>
                  <a href="<?php printf("%s?pageNum_consumo=%d%s", $currentPage, $totalPages_consumo, $queryString_consumo); ?>"><i class="fa fa-angle-double-right"></i></a>
                  <?php } // Show if not last page ?>
            </td>
          </tr>
        </table>
        <a href="listado_productos.php?idusuario=<?php echo $row_usuarios['id_usuario']; ?>" class="btn btn-secondary btn-lg">Volver</a>              
      </div>
      <?php } // Show if recordset not empty ?>
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
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/main.js"></script>
    
    
       
</body>
</html>
<?php
mysql_free_result($lista_productos_usuario);

mysql_free_result($consumo);

mysql_free_result($pesoactual);

mysql_free_result($usuarios);
?>
