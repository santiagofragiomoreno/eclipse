<?php
//sesiones en php
session_start();
$_SESSION["nombre"]="santi";
$_SESSION["apellido"]="fragio";

echo $_SESSION["apellido"];

session_destroy();
?>