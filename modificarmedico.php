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

$usuario_img = "1.png";

$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg, 
	usuario_paypal, usuario_precio

    ",
	"usuario				
	",
	"usuario_eliminado = '0' and usuario.usuario_id = '$get_id' and perfil_id = '2'");
foreach($arrresultado as $i=>$valor){

	$usuario_id = utf8_encode($valor["usuario_id"]);

	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
	$usuario_email = utf8_encode($valor["usuario_email"]);
	$usuario_clave = utf8_encode($valor["usuario_clave"]);
	$usuario_dni = utf8_encode($valor["usuario_dni"]);
	$usuario_celular = utf8_encode($valor["usuario_celular"]);
	$usuario_img = utf8_encode($valor["usuario_img"]);
	$perfil_id = utf8_encode($valor["perfil_id"]);
	$usuario_activo = utf8_encode($valor["usuario_activo"]);
	$usuario_fechareg = utf8_encode($valor["usuario_fechareg"]);	
	$usuario_paypal = utf8_encode($valor["usuario_paypal"]);	
	$usuario_precio = utf8_encode($valor["usuario_precio"]);	

	if ($usuario_img==""){$usuario_img="1.png";}

	$usuario = $usuario_nombre." ".$usuario_apellido;

}


$arrresultado = $conexion->doSelect("
	especialidad.especialidad_id, especialidad_nombre, usuarioespecialidad_id
    ",
	"especialidad 
		left join usuarioespecialidad on usuarioespecialidad.especialidad_id = especialidad.especialidad_id		
		and usuarioespecialidad.usuario_id = '$usuario_id' and usuarioespecialidad_activo = '1'
	",
	"especialidad_eliminado = '0'");

foreach($arrresultado as $i=>$valor){

	$especialidad_id = utf8_encode($valor["especialidad_id"]);

	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$usuarioespecialidad_id = utf8_encode($valor["usuarioespecialidad_id"]);
	
	if ($usuarioespecialidad_id!=""){
		$optionespecialidad .= "<option selected='selected' value='$especialidad_id'>$especialidad_nombre</option>";
	}else{
		$optionespecialidad .= "<option value='$especialidad_id'>$especialidad_nombre</option>";
	}
}




$arrresultado = $conexion->doSelect("
	sede.sede_id, sede_nombre, usuariosede_id
    ",
	"sede 
		left join usuariosede on usuariosede.sede_id = sede.sede_id		
		and usuariosede.usuario_id = '$usuario_id' and usuariosede_activo = '1'
	",
	"sede_eliminado = '0'");

foreach($arrresultado as $i=>$valor){

	$sede_id = utf8_encode($valor["sede_id"]);

	$sede_nombre = utf8_encode($valor["sede_nombre"]);
	$usuariosede_id = utf8_encode($valor["usuariosede_id"]);
	
	if ($usuariosede_id!=""){
		$optionsede .= "<option selected='selected' value='$sede_id'>$sede_nombre</option>";
	}else{
		$optionsede .= "<option value='$sede_id'>$sede_nombre</option>";
	}
}


require_once "views/modificarmedico.php";

?>