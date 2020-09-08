<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

(isset($_GET['id'])) ? $getpago_id=$_GET['id'] :$getpago_id='';

if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = './'; </script>";
	exit();
}

if ($perfil=="2"){
    $wherepago = " and cita.usuario_idmedico = '$iniuser' ";
    $displayestatus = " style = 'display: none' ";
}else if ($perfil=="3"){
    $wherepago = " and cita.usuario_idpaciente = '$iniuser' ";    
    $displayestatus = " style = 'display: none' ";
}

$xajax->registerFunction('guardarestatuspago');

$conexion = new ConexionBd();


$arrresultado = $conexion->doSelect("
	pago.pago_id, pago_monto, pago_referencia, pago_activo, pago_eliminado,
	pago_fechapago, pago.usuario_id, 
	pago.cita_id, pago.formapago_id, pago.estatus_id, pago_observacion, 
	pago_img, pago_banco,
	DATE_FORMAT(pago_fechareg,'%d/%m/%Y %H:%i:%s') as pago_fechareg, 
	usuario_nombre, usuario_apellido, formapago_nombre, estatus_nombre
    ",
	"pago	
		inner join usuario on usuario.usuario_id = pago.usuario_id			
		inner join cita on cita.cita_id = pago.cita_id			
		inner join formapago on formapago.formapago_id = pago.formapago_id			
		inner join estatus on estatus.estatus_id = pago.estatus_id			
	",
	"pago_eliminado = '0' and pago.pago_id = '$getpago_id' $wherepago ", null, "pago.pago_id desc");
foreach($arrresultado as $i=>$valor){

	$pago_id = utf8_encode($valor["pago_id"]);
	$pago_monto = utf8_encode($valor["pago_monto"]);
	$pago_referencia = utf8_encode($valor["pago_referencia"]);
	$pago_activo = utf8_encode($valor["pago_activo"]);
	$cita_id = utf8_encode($valor["cita_id"]);
	$formapago_id = utf8_encode($valor["formapago_id"]);
	$t_estatus_id = utf8_encode($valor["estatus_id"]);
	$pago_observacion = utf8_encode($valor["pago_observacion"]);
	$pago_img = utf8_encode($valor["pago_img"]);
	$pago_banco = utf8_encode($valor["pago_banco"]);
	$pago_fechareg = utf8_encode($valor["pago_fechareg"]);	

	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);	
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);	
	$formapago_nombre = utf8_encode($valor["formapago_nombre"]);	
	$estatus_nombre = utf8_encode($valor["estatus_nombre"]);	

	$usuario = $usuario_nombre." ".$usuario_apellido;

	if ($pago_monto==""){$pago_monto=0;}

  	$pago_monto = number_format($pago_monto,2,",","."). " PEN";  	

 }


$arrresultado = $conexion->doSelect("estatus_id, estatus_nombre",
	"estatus",
	"estatus_eliminado = '0' and tipoestatus_id = '1'");

$optionestatus .= "<option value=''>-- Seleccione --</option>";
foreach($arrresultado as $i=>$valor){
	$l_estatus_id = utf8_encode($valor["estatus_id"]);
	$l_estatus_nombre = utf8_encode($valor["estatus_nombre"]);	
	
	if ($t_estatus_id==$l_estatus_id){
		$optionestatus .= "<option selected='selected' value='$l_estatus_id'>$l_estatus_nombre</option>";
	}else{
		$optionestatus .= "<option value='$l_estatus_id'>$l_estatus_nombre </option>";
	}
}


require_once "views/verpago.php";

?>