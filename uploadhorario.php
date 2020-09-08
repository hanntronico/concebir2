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



(isset($_POST['horario_id'])) ? $horario_id=$_POST['horario_id'] : $horario_id='';
(isset($_POST['medico'])) ? $medico=$_POST['medico'] : $medico='';
(isset($_POST['fecha'])) ? $fecha=$_POST['fecha'] : $fecha='';

(isset($_POST['dia_inicio'])) ? $dia_inicio=$_POST['dia_inicio'] : $dia_fin='';
(isset($_POST['dia_fin'])) ? $dia_fin=$_POST['dia_fin'] : $dia_fin='';

(isset($_POST['horaini'])) ? $horaini=$_POST['horaini'] : $horaini='';
(isset($_POST['horafin'])) ? $horafin=$_POST['horafin'] : $horafin='';
(isset($_POST['sede'])) ? $sede=$_POST['sede'] : $sede='';
(isset($_POST['horario_intervalo'])) ? $horario_intervalo=$_POST['horario_intervalo'] : $horario_intervalo='';

if ($sede==""){$sede=0;}

if ($dia_inicio==""){$dia_inicio=0;}
if ($dia_fin==""){$dia_fin=0;}


if ($horaini==""){$horaini = "00:00";}
if ($horafin==""){$horafin = "00:00";}

$dia = substr($fecha,0,2);
$mes = substr($fecha,3,2);
$ano = substr($fecha,6,4);
$fecha = $ano."-".$mes."-".$dia;

$fechaini = $ano."-".$mes."-".$dia." ".$horaini;
$fechafin = $ano."-".$mes."-".$dia." ".$horafin;

$fechaactual = formatoFechaHoraBd();

$conexion = new ConexionBd();

if ($perfil=="2"){
	$wherehorario = " and horario.usuario_id = '$iniuser' ";
}else if ($perfil=="3"){
	echo "<script language='JavaScript'>window.parent.window.location = 'index'; </script>";
	exit();
}



if ($horario_id==""){

	$resultado = $conexion->doInsert("
	horario
		(horario_diaini, horario_diafin, horario_fecha, horario_horaini, horario_horafin, usuario_id, sede_id, 
		horario_fechareg, horario_activo, horario_eliminado, usuario_idreg, horario_intervalo) 
	",
	"'$dia_inicio','$dia_fin', '$fecha', '$fechaini', '$fechafin', '$medico', '$sede', 
	'$fechaactual', '1', '0', '$iniuser','$horario_intervalo'");

}else{

	$resultado = $conexion->doUpdate("horario", "		
		horario_fecha ='$fecha',
		horario_diaini ='$dia_inicio',
		horario_diafin ='$dia_fin',
		horario_horaini ='$fechaini',	
		horario_horafin ='$fechafin',
		usuario_id ='$medico',
		horario_intervalo ='$horario_intervalo',
		sede_id ='$sede'
		",
		"horario_id='$horario_id' $wherehorario ");

}

echo "<script language='JavaScript'>alert('Horario Guardado Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'horarios'; </script>";

?>