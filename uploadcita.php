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



(isset($_POST['cita_id'])) ? $cita_id=$_POST['cita_id'] : $cita_id='';
(isset($_POST['medico'])) ? $medico=$_POST['medico'] : $medico='';
(isset($_POST['paciente'])) ? $paciente=$_POST['paciente'] : $paciente='';
(isset($_POST['fecha'])) ? $fecha=$_POST['fecha'] : $fecha='';
(isset($_POST['hora'])) ? $hora=$_POST['hora'] : $hora='';
(isset($_POST['especialidad'])) ? $especialidad=$_POST['especialidad'] : $especialidad='';
(isset($_POST['sede'])) ? $sede=$_POST['sede'] : $sede='';

if ($sede==""){$sede=0;}


if ($hora==""){$hora = "00:00";}

$dia = substr($fecha,0,2);
$mes = substr($fecha,3,2);
$ano = substr($fecha,6,4);
$fecha = $ano."-".$mes."-".$dia." ".$hora;

$fechainsertar = $fecha;

$fechaactual = formatoFechaHoraBd();

$conexion = new ConexionBd();

if ($perfil=="2"){
	$wherecita = " and cita.usuario_idmedico = '$iniuser' ";
}else if ($perfil=="3"){
	$wherecita = " and cita.usuario_idpaciente = '$iniuser' ";
}



if ($cita_id==""){

	$resultado = $conexion->doInsert("
	cita
		(cita_fecha, usuario_idmedico, usuario_idpaciente, especialidad_id, sede_id, 
		cita_fechareg, cita_activo, cita_eliminado, usuario_idreg) 
	",
	"'$fechainsertar', '$medico', '$paciente', '$especialidad', '$sede', 
	'$fechaactual', '1', '0', '$iniuser'");

}else{

	$resultado = $conexion->doUpdate("cita", "		
		cita_fecha ='$fechainsertar',
		usuario_idmedico ='$medico',	
		usuario_idpaciente ='$paciente',
		especialidad_id ='$especialidad',
		sede_id ='$sede',			
		cita_fechareg = '$fechaactual'
		",
		"cita_id='$cita_id' $wherecita ");

}

echo "<script language='JavaScript'>alert('Cita Guardada Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'citas'; </script>";

?>