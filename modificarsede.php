<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = './'; </script>";
	exit();
}

if ($perfil!="1"){
	echo "<script language='JavaScript'>window.location = 'panel'; </script>";
	exit();
}

(isset($_GET['id'])) ? $get_id=$_GET['id'] :$get_id='';

$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	sede_id, sede_nombre, sede_img, sede_nombrecorto, sede_activo, sede_eliminado,
	DATE_FORMAT(sede_fechareg,'%d/%m/%Y %H:%i:%s') as sede_fechareg	
    ",
	"sede				
	",
	"sede_eliminado = '0' and sede.sede_id = '$get_id'");
foreach($arrresultado as $i=>$valor){

	$sede_id = utf8_encode($valor["sede_id"]);
	$sede_nombre = utf8_encode($valor["sede_nombre"]);
	$sede_img = utf8_encode($valor["sede_img"]);
	$sede_nombrecorto = utf8_encode($valor["sede_nombrecorto"]);
	$sede_activo = utf8_encode($valor["sede_activo"]);
	$sede_fechareg = utf8_encode($valor["sede_fechareg"]);

}

require_once "views/modificarsede.php";

?>