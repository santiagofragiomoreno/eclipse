<?php
require 'carta.php';
session_start();
//echo $_SESSION['cartas_juego'][$_GET['a']]->getId().'|'. $_SESSION['cartas_juego'][$_GET['b']]->getId();
if($_SESSION['cartas_juego'][$_GET['a']]->getId() == $_SESSION['cartas_juego'][$_GET['b']]->getId()){
    echo 1;
}
else{
    echo 0;
}
?>