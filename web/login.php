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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "area_clientes/sesion.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_midespensa, $midespensa);
  
  $LoginRS__query=sprintf("SELECT email, password FROM usuarios WHERE email=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $midespensa) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="utf-8">
  <title>Mi despensa On-Line - Acceso</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  
  <meta property="og:title" content="">
	<meta property="og:type" content="website">
	<meta property="og:url" content="">
	<meta property="og:site_name" content="">
	<meta property="og:description" content="">

  <!-- Styles -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/colors/green.css"><!--Replace Your Color-->
  <link rel="stylesheet" href="css/custom-styles.css">

  <script src="js/modernizr-2.7.1.js"></script>

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
          <a class="navbar-brand" href="#">Mi despensa ON-LINE</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
  
    
    <!--Login-->
    <section class="white-bg top">
      <div class="container">
        
        <!--Brand-->
        <div class="row margin-100">
          <div class="col-sm-12">
            <a href="#">Mi despensa ON-LINE</a>
          </div>
        </div>
      
        <div class="row margin-50">
          
          <div class="col-sm-6 col-sm-offset-3 text-center">
            <h3>ACCESO</h3><br />
            
  					<form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" role="form" id="signup">
              <div class="form-group">
                <input type="email" class="form-control" id="usuario" name="usuario" placeholder="Introduzca su email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
              </div>
              <br />
              <div>
                <input name="Enviar" type="submit" class="btn btn-secondary btn-lg" value="Iniciar sesión">
              </div>
              <a href="#"><small>Olvidó su contraseña?</small></a>
            </form>
      	  
          </div><!--End Span6-->
          
        </div>
      </div>
    </section>
    
    
           
    <!--Footer-->
    <section id="contact" class="black-bg">
      <div class="container">
        <div class="row margin-60">
          <div class="col-sm-12 text-center">
            <h2 class="white">Contáctenos</h2>
          </div>
        </div>
        
        <div class="row margin-80">
          <div class="col-sm-8">
            <h3 class="white">Formulario de contacto</h3>
            <p>Para cualquier incidencia o consulta póngase en contacto con nosotros:</p>
            <br />
            <!-- comment form -->
            <form method="post" action="send-email.php" id="contact-form" class="form-horizontal" role="form">
              <div class="form-group">
                <label for="name" class="col-12  col-lg-2  control-label">Nombre:</label>
                <div class="col-12  col-lg-10">
                  <input type="text" class="form-control" name="name" id="name">
                </div>
              </div>                  
              <div class="form-group">
                <label for="email" class="col-12  col-lg-2  control-label">Email:</label>
                <div class="col-12  col-lg-10">
                  <input type="email" class="form-control" name="email" id="email">
                </div>
              </div>
              <div class="form-group">
                <label for="message" class="col-12  col-lg-2  control-label">Mensaje:</label>
                <div class="col-12  col-lg-10">
                  <textarea class="form-control" rows="7" name="message" id="message"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-12  col-lg-2">&nbsp;</div>
                <div class="col-12  col-lg-10">
                  <button type="submit" class="btn btn-secondary btn-lg btn-full">Enviar</button>
                </div>
              </div>
            </form><!-- /comment form -->
          </div><!--End Col 8-->
          
          <div class="col-sm-4">
            <h3 class="white">Horario de atención al cliente</h3>
            <p><strong>Lunes a viernes:</strong> 9am a 6pm </p>
            
            <br />
            <h3 class="white">Información adicional</h3>
            <p>Todas las consultas e incidencias serán atendidas lo antes posible, estimando su respuesta dentro de las 24h siguientes a su recepción.</p>
            
            <br />
          </div><!--End Col 4-->
        </div><!--End Row-->
        
      </div>
    </section>
    
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
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>
    
    
       
    </body>
</html>