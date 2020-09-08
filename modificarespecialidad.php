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

$especialidad_img = "0.jpg";

$especialidad_consede = " checked = 'checked' ";

$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	especialidad.especialidad_id, especialidad.especialidad_nombre, especialidad.especialidad_codigoexterno, 
	especialidad.especialidad_img, especialidad.especialidad_activo, 
	especialidad.especialidad_eliminado, 
	DATE_FORMAT(especialidad.especialidad_fechareg,'%d/%m/%Y %H:%i:%s') as especialidad_fechareg,
	especialidad_consede
    ",
	"especialidad				
	",
	"especialidad_eliminado = '0' and especialidad.especialidad_id = '$get_id'");
foreach($arrresultado as $i=>$valor){

	$especialidad_id = utf8_encode($valor["especialidad_id"]);
	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$especialidad_codigoexterno = utf8_encode($valor["especialidad_codigoexterno"]);
	$especialidad_img = utf8_encode($valor["especialidad_img"]);
	$especialidad_activo = utf8_encode($valor["especialidad_activo"]);
	$especialidad_fechareg = utf8_encode($valor["especialidad_fechareg"]);	
	$especialidad_consede = utf8_encode($valor["especialidad_consede"]);	

	if ($especialidad_consede!="1"){
		$especialidad_consede = " ";
	}else{
		$especialidad_consede = " checked = 'checked' ";
	}

	if ($especialidad_img==""){$especialidad_img="0.jpg";}

}

require_once "views/modificarespecialidad.php";

?>