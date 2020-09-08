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


(isset($_GET['id'])) ? $get_id=$_GET['id'] :$get_id='';

$usuario_img = "1.png";

$xajax->registerFunction('cargarespecialidadessedes');

if ($perfil=="2"){
	$wherecita = " and cita.usuario_idmedico = '$iniuser' ";
}else if ($perfil=="3"){
	$wherecita = " and cita.usuario_idpaciente = '$iniuser' ";
}

$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	cita_id, usuario_idmedico, usuario_idpaciente, especialidad_id, sede_id, 
	cita_activo, cita_eliminado, usuario_idreg,

	DATE_FORMAT(cita_fecha,'%d/%m/%Y') as fecha,
	DATE_FORMAT(cita_fecha,'%H:%i') as hora, 

	DATE_FORMAT(cita_fechareg,'%d/%m/%Y %H:%i:%s') as cita_fechareg	
    ",
	"cita				
	",
	"cita_eliminado = '0' and cita.cita_id = '$get_id' $wherecita");
foreach($arrresultado as $i=>$valor){

	$cita_id = utf8_encode($valor["cita_id"]);
	$usuario_idmedico = utf8_encode($valor["usuario_idmedico"]);
	$usuario_idpaciente = utf8_encode($valor["usuario_idpaciente"]);
	$t_especialidad_id = utf8_encode($valor["especialidad_id"]);
	$t_sede_id = utf8_encode($valor["sede_id"]);
	$cita_activo = utf8_encode($valor["cita_activo"]);	

	$fecha = utf8_encode($valor["fecha"]);	
	$hora = utf8_encode($valor["hora"]);	
	$cita_fechareg = utf8_encode($valor["cita_fechareg"]);	

}

if ($perfil=="2"){
	$wheremedico = " and usuario.usuario_id = '$iniuser' ";
}else if ($perfil=="3"){
	$wherepaciente = " and usuario.usuario_id = '$iniuser' ";
}



$arrresultado = $conexion->doSelect("usuario_id, usuario_nombre, usuario_apellido","usuario","usuario_eliminado = '0' and perfil_id = '2' $wheremedico");

$optionmedico .= "<option value=''>-- Seleccione --</option>";
foreach($arrresultado as $i=>$valor){
	$usuario_id = utf8_encode($valor["usuario_id"]);

	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
	
	if ($usuario_idmedico==$usuario_id){
		$optionmedico .= "<option selected='selected' value='$usuario_id'>$usuario_nombre $usuario_apellido</option>";
	}else{
		$optionmedico .= "<option value='$usuario_id'>$usuario_nombre $usuario_apellido </option>";
	}
}


$arrresultado = $conexion->doSelect("usuario_id, usuario_nombre, usuario_apellido","usuario","usuario_eliminado = '0' and perfil_id in ('1','3') $wherepaciente");

$optionpaciente .= "<option value=''>-- Seleccione --</option>";
foreach($arrresultado as $i=>$valor){
	$usuario_id = utf8_encode($valor["usuario_id"]);

	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
	
	if ($usuario_idpaciente==$usuario_id){
		$optionpaciente .= "<option selected='selected' value='$usuario_id'>$usuario_nombre $usuario_apellido</option>";
	}else{
		$optionpaciente .= "<option value='$usuario_id'>$usuario_nombre $usuario_apellido </option>";
	}
}



$arrresultado = $conexion->doSelect("especialidad_id, especialidad_nombre","especialidad","especialidad_eliminado = '0'");

$optionespecialidad .= "<option value=''>-- Seleccione --</option>";
foreach($arrresultado as $i=>$valor){
	$especialidad_id = utf8_encode($valor["especialidad_id"]);

	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);	
	
	if ($t_especialidad_id==$especialidad_id){
		$optionespecialidad .= "<option selected='selected' value='$especialidad_id'>$especialidad_nombre</option>";
	}else{
		$optionespecialidad .= "<option value='$especialidad_id'>$especialidad_nombre </option>";
	}
}



$arrresultado = $conexion->doSelect("sede_id, sede_nombre","sede","sede_eliminado = '0'");

$optionsede .= "<option value=''>-- Seleccione --</option>";
foreach($arrresultado as $i=>$valor){
	$sede_id = utf8_encode($valor["sede_id"]);

	$sede_nombre = utf8_encode($valor["sede_nombre"]);	
	
	if ($t_sede_id==$sede_id){
		$optionsede .= "<option selected='selected' value='$sede_id'>$sede_nombre</option>";
	}else{
		$optionsede .= "<option value='$sede_id'>$sede_nombre </option>";
	}
}


require_once "views/modificarcita.php";

?>