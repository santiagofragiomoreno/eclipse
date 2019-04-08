<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>

<h2>Bienvenidos a midespensaonline</h2>

Código de producto: <?php echo $_GET['codigo']; ?>
Peso del producto: <?php echo $_GET['peso']; ?>
<a href="mail.php?codigo=$_GET['codigo']">Enviar</a>
</body>
</html>
