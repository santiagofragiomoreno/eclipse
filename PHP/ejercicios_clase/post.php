<?php 

?>

<!DOCTYPE html>
<html>
<head>
<meta  charset="UTF-8">
<title>GET PHP</title>
</head>
<body>
	<form action="post.php" method="POST">
	<input type="text" name="nombre">
	<input type="submit" value="enviar">
	</form>
	<pre><?php print_r($_GET);?></pre>
		<pre><?php print_r($_POST);?></pre>
	
</body>
</html>