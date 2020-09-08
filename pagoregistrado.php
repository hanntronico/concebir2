<?php
include_once 'lib/config.php';
session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

(isset($_GET['id'])) ? $getcita=$_GET['id'] :$getcita='';
(isset($_GET['pid'])) ? $getpago=$_GET['pid'] :$getpago='';
(isset($_GET['f'])) ? $getformapago=$_GET['f'] :$getformapago='';

if ($iniuser==""){
  echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
  echo "<script language='JavaScript'>window.location = '../'; </script>";
  exit();
}


$info = "
<div class='alert alert-success' style='text-align: center; font-weight: normal;'>
    <a style='color: #000; font-size: 14px; text-decoration: none;'>
        Pago Registrado Correctamente, por favor espere mientras confirmamos el mismo.
    </a><br>
</div>
";
require_once "views/pagoregistrado.php";

?>