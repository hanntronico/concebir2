<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

(isset($_GET['id'])) ? $getcita_id=$_GET['id'] :$getcita_id='';

if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = './'; </script>";
	exit();
}

if ($perfil=="2"){
    $wherepago = " and cita.usuario_idmedico = '$iniuser' ";    
}else if ($perfil=="3"){
    $wherepago = " and cita.usuario_idpaciente = '$iniuser' ";    
    $displayestatus = " style = 'display: none' ";
}

$xajax->registerFunction('guardarestatuscita');

$conexion = new ConexionBd();


$result = $conexion->doSelect("
    c.cita_id, c.estatus_id,
    DATE_FORMAT(c.cita_fecha,'%d/%m/%Y %H:%i:%s') as cita_fecha,
    CONCAT(um.usuario_nombre,' ', um.usuario_apellido) AS medico,
    CONCAT(up.usuario_nombre,' ', up.usuario_apellido) AS paciente,
    e.especialidad_nombre,
    s.sede_nombre,
    DATE_FORMAT(c.cita_fechareg,'%d/%m/%Y %H:%i:%s') as cita_fechareg,    
    c.cita_activo,
    IF(c.cita_activo = 1, 'Activo', 'Inactivo') AS estado,
    cita_precio,
    estatus_nombre

    "
    ,
    "
    cita c
    LEFT JOIN sede s
       ON c.sede_id = s.sede_id
       
    INNER JOIN especialidad e
       ON c.especialidad_id = e.especialidad_id
       
    INNER JOIN usuario um
       ON c.usuario_idmedico = um.usuario_id
       
    INNER JOIN usuario up
       ON c.usuario_idpaciente = up.usuario_id

    INNER JOIN estatus on estatus.estatus_id = c.estatus_id
    "
    ,
    "c.cita_eliminado = '0' AND c.cita_id = '$getcita_id' $wherecita");

foreach($result as $i=>$valor){

	$cita_id = utf8_encode($valor["cita_id"]);
	$cita_fecha = utf8_encode($valor["cita_fecha"]);
	$medico = utf8_encode($valor["medico"]);
	$paciente = utf8_encode($valor["paciente"]);
	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$sede_nombre = utf8_encode($valor["sede_nombre"]);
	$cita_fechareg = utf8_encode($valor["cita_fechareg"]);
    $estado = utf8_encode($valor["estado"]);
    $cita_activo = utf8_encode($valor["cita_activo"]);
    $cita_precio = utf8_encode($valor["cita_precio"]);
    $estatus_nombre = utf8_encode($valor["estatus_nombre"]);
    $t_estatus_id = utf8_encode($valor["estatus_id"]);

    if ($cita_precio==""){$cita_precio=0;}

    $cita_precio = number_format($cita_precio,2,",","."). " PEN";

}

$arrresultado = $conexion->doSelect("estatus_id, estatus_nombre",
	"estatus",
	"estatus_eliminado = '0' and tipoestatus_id = '2'");

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


require_once "views/vercita.php";

?>