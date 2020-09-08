<?php
include_once 'lib/config.php';
session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

(isset($_GET['id'])) ? $getcita=$_GET['id'] :$getcita='';
(isset($_GET['f'])) ? $getformapago=$_GET['f'] :$getformapago='';


if ($iniuser==""){
  echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
  echo "<script language='JavaScript'>window.location = '../'; </script>";
  exit();
}

if ($perfil=="2"){
	$wherecita = " and cita.usuario_idmedico = '$iniuser' ";
}else if ($perfil=="3"){
	$wherecita = " and cita.usuario_idpaciente = '$iniuser' ";
}

$displayinfopago = " style= 'display: none; margin-top: 15px'";

$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	cita_id, usuario_idmedico, usuario_idpaciente, especialidad_id, sede_id, 
	cita_activo, cita_eliminado, usuario_idreg,

	DATE_FORMAT(cita_fecha,'%d/%m/%Y') as fecha,
	DATE_FORMAT(cita_fecha,'%H:%i') as hora, cita_precio,

	DATE_FORMAT(cita_fechareg,'%d/%m/%Y %H:%i:%s') as cita_fechareg	
    ",
	"cita				
	",
	"cita_eliminado = '0' and cita.cita_id = '$getcita' $wherecita ");
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
	$cita_precio = utf8_encode($valor["cita_precio"]);	

	$cita_precioculqi = utf8_encode($valor["cita_precio"]);	
	
	if ($cita_precio==""){$cita_precio = 0;}
	if ($cita_precioculqi==""){$cita_precioculqi = 0;}

	$cita_precioculqi = number_format($cita_precioculqi,2,",","");

	$cita_precioculqi =  str_replace(",","",$cita_precioculqi);

	$cita_preciomostrar = number_format($cita_precio,2,",","."). " PEN";	

}

if ($getformapago=="1"){
	$displayinfopago = " style= 'margin-top: 15px'";
	$formapagoimg = "dist/img/culqi.png";

	$infopago = "<br>
		Para simular pagos de prueba en CULQI.
		<br><br>
		Nro Tarjeta: 4111111111111111
		<br>
		Fecha Venc: 09/25	
		<br>
		CVV: 123
	";
} elseif ($getformapago=="2") {
	$displayinfopago = " style= 'margin-top: 15px'";
	$formapagoimg = "dist/img/visanet.png";

	$infopago = "<br>
		Para simular pagos de prueba en VISANET.
		<br>
		Porfavor ingrese los datos se le solicita a continuación
	";
}



require_once "views/confirmarpago.php";

?>