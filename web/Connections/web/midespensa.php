<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_midespensa = "server189.hostinger.es ";
$database_midespensa = "u823703154_estu";
$username_midespensa = "u823703154_root";
$password_midespensa = "santiago87";
$midespensa = mysql_pconnect($hostname_midespensa, $username_midespensa, $password_midespensa) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
