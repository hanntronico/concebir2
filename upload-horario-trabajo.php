<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];


if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.parent.window.location = 'index'; </script>";
	exit();
}

if ($perfil!="1"){
	echo "<script language='JavaScript'>alert('Error: No posee acceso para hacer esta accion, por favor inicie sesion de nuevo');</script>";
	echo "<script language='JavaScript'>window.parent.window.location = 'index'; </script>";
	exit();
}

// echo "post ";
// var_dump($_POST);
$conexion = new ConexionBd();

if($id == ''){
    echo "add";
}
else{
    echo "edit";
}



echo "<script language='JavaScript'>alert('Medico Guardado Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'medicos'; </script>";

?>