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


if ($perfil=="2"){
	$wherehorario = " and horario.usuario_id = '$iniuser' ";
}else if ($perfil=="3"){
	echo "<script language='JavaScript'>window.location = 'panel'; </script>";
	exit();
}

$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	horario.horario_id, horario.usuario_id, horario.sede_id,  
	horario_activo, horario_eliminado, horario.usuario_idreg,
	DATE_FORMAT(horario_fecha,'%d/%m/%Y') as horario_fecha,		
	DATE_FORMAT(horario_horaini,'%H:%i') as horaini, 
	DATE_FORMAT(horario_horafin,'%H:%i') as horafin,  horario_intervalo,

	DATE_FORMAT(horario_fechareg,'%d/%m/%Y %H:%i:%s') as horario_fechareg	
    ",
	"horario				
	",
	"horario_eliminado = '0' and horario.horario_id = '$get_id' $wherehorario");
foreach($arrresultado as $i=>$valor){

	$horario_id = utf8_encode($valor["horario_id"]);
	$t_usuario_id = utf8_encode($valor["usuario_id"]);
	$t_sede_id = utf8_encode($valor["sede_id"]);

	$horario_activo = utf8_encode($valor["horario_activo"]);
	$horario_fecha = utf8_encode($valor["horario_fecha"]);	
	$horaini = utf8_encode($valor["horaini"]);	
	$horafin = utf8_encode($valor["horafin"]);	
	$horario_fechareg = utf8_encode($valor["horario_fechareg"]);	
	$horario_intervalo = utf8_encode($valor["horario_intervalo"]);	
		

}




$arrresultado = $conexion->doSelect("usuario_id, usuario_nombre, usuario_apellido","usuario","usuario_eliminado = '0' and perfil_id = '2'");

$optionmedico .= "<option value=''>-- Seleccione --</option>";
foreach($arrresultado as $i=>$valor){
	$usuario_id = utf8_encode($valor["usuario_id"]);

	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
	
	if ($t_usuario_id==$usuario_id){
		$optionmedico .= "<option selected='selected' value='$usuario_id'>$usuario_nombre $usuario_apellido</option>";
	}else{
		$optionmedico .= "<option value='$usuario_id'>$usuario_nombre $usuario_apellido </option>";
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

$days = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");

$option_days = "";

foreach($days as $i=>$valor){
    if($i == 0){
        
	    $option_days .= "<option selected='selected' value='$valor'>$valor</option>";
	    
    }else{
	    $option_days .= "<option svalue='$valor'>$valor</option>";
    }
}


require_once "views/modificarhorario.php";

?>