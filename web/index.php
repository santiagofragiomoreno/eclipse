<?php //include ('Connections/openConexionRB.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Inicio de Sesion</title>
  </head>
  <body class="body-index">
  <div class="container cabecera-index">
  	<div class="row container cabecera-index">
  		<div class="col-12">
  			<p class="p-header">MyHomeStock.com</p>
  		</div>
  	</div>
  </div>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <div class="container" style="margin-top:20px">
  	<div class="row container">
  		<div class="col-sm-12 col-md-6" style="margin-top:2px; border:1px solid black">
  			 <form action="user.php" method="POST">
  			    <div class="col-sm-12 col-md-4" style="margin-top:10px;">
				<input name='email' type='text' value="email">
				</div>
				<div class="col-sm-12 col-md-4" style="margin-top:10px;">
				<input name='password' type='text' value="password">
				</div>
				<div class="col-sm-12 col-md-4" style="margin-top:10px; margin-bottom:10px">
				<input type='submit' value='login' style="border:1px solid yellow">
				</div>
			 </form>
  		</div>
  	</div>
  		<div class="row container">
  		<div class="col-sm-12 col-md-6" style="margin-top:2px; border:1px solid black">
  			 <form action="signup.php" method="POST">
  			    <div class="col-sm-12 col-md-4" style="margin-top:10px; ">
  			    <p style="margin-bottom:5px;">Nombre</p>
				<input name='nombre' type='text' value="">
				</div>
				<div class="col-sm-12 col-md-4" style="margin-top:10px;">
				<p style="margin-bottom:5px;">Apellidos</p>
				<input name='apellidos' type='text' value="">
				</div>
  			    <div class="col-sm-12 col-md-4" style="margin-top:10px;">
  			    <p style="margin-bottom:5px;">Email</p>
				<input name='email' type='text' value="">
				</div>
				<div class="col-sm-12 col-md-4" style="margin-top:10px;">
				<p style="margin-bottom:5px;">Password</p>
				<input name='password' type='text' value="">
				</div>
				<div class="col-sm-12 col-md-4" style="margin-top:10px; margin-bottom:10px">
				<input type='submit' value='signup' style="border:1px solid yellow">
				</div>
			 </form>
  		</div>
  	</div>
  </div>
   
  </body>
</html>