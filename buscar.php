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


$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	especialidad.especialidad_id, especialidad.especialidad_nombre, especialidad.especialidad_codigoexterno, 
	especialidad.especialidad_img, especialidad.especialidad_activo, 
	especialidad.especialidad_eliminado, 
	DATE_FORMAT(especialidad.especialidad_fechareg,'%d/%m/%Y %H:%i:%s') as especialidad_fechareg	
    ",
	"especialidad				
	",
	"especialidad_activo = '1' ", null, "especialidad_nombre asc");
foreach($arrresultado as $i=>$valor){

	$especialidad_id = utf8_encode($valor["especialidad_id"]);
	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$especialidad_codigoexterno = utf8_encode($valor["especialidad_codigoexterno"]);
	$especialidad_img = utf8_encode($valor["especialidad_img"]);
	$especialidad_activo = utf8_encode($valor["especialidad_activo"]);
	$especialidad_fechareg = utf8_encode($valor["especialidad_fechareg"]);	

	if ($especialidad_img==""){$especialidad_img="0.jpg";}

	$divespecialides .= "
		<div class='col-md-4 col-sm-6' style='margin-top: 20px'>
			<a href='buscar-medicos?e=$especialidad_id'>
				<img src='arch/$especialidad_img' style='width: 100%; max-height: 180px' alt='$especialidad_nombre' title='$especialidad_nombre'>
			</a>
		</div>
	";

}


require_once "views/buscar.php";

?>