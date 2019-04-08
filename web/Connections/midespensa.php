<?php
/*
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_midespensa = "localhost";
$database_midespensa = "db2999181";
$username_midespensa = "root";
$password_midespensa = "";
$midespensa = mysql_pconnect($hostname_midespensa, $username_midespensa, $password_midespensa) or trigger_error(mysql_error(),E_USER_ERROR);*/ 
?>
<?php
//creamos la conexion
$conexion = new mysqli('localhost','root','','db2999181');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
}

$conexion->close();
?>