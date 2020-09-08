<?php
include_once 'lib/config.php';
session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];

(isset($_GET['id'])) ? $getcita=$_GET['id'] :$getcita='';

if ($_SESSION[iniuser]==""){
  echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
  echo "<script language='JavaScript'>window.location = '../'; </script>";
  exit();
}




require_once "views/seleccionarformapago.php";

?>