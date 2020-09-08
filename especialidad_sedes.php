<?php
include_once 'lib/config.php';
session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];

(isset($_GET['i'])) ? $getinfo=$_GET['i'] :$getinfo='';

if ($_SESSION[iniuser]==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = '../'; </script>";
	exit();
}

if(isset($_GET["id"])){
	
	$id_usuario_consultar = ($_GET["id"]);;
	
	//var_dump($id_usuario_consultar);
	
	//echo "consultar $id_usuario_consultar";
}


$conexion = new ConexionBd();

$especialidad_result = $conexion->doSelect("
	e.especialidad_nombre,
	ue.usuarioespecialidad_activo
	"
	,
	"
	usuarioespecialidad ue, 
	usuario u, 
	especialidad e 
	"
	,
	"
	ue.usuario_id = u.usuario_id
	AND
	e.especialidad_id = ue.especialidad_id
	AND
	u.usuario_id = $id_usuario_consultar
	and
	ue.usuarioespecialidad_activo = '1'
	");

foreach($especialidad_result as $i=>$valor){

	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$usuarioespecialidad_activo = utf8_encode($valor["usuarioespecialidad_activo"]);
	
	$especialidad_html .= "
				 <tr style='font-size: 14px'>			          									
					<td>$especialidad_nombre</td>
					<td>$usuarioespecialidad_activo</td>
			      </tr>
			";

}


$sedes_result = $conexion->doSelect("
	s.sede_nombre,
	s.sede_activo
	"
	,
	"
	usuariosede us, 
	usuario u, 
	sede s
	"
	,
	"
	us.usuario_id = u.usuario_id
	AND
	s.sede_id = us.sede_id
	AND
	u.usuario_id = $id_usuario_consultar
	and
	us.usuariosede_activo = '1'
	");

foreach($sedes_result as $i=>$valor){

	$sede_nombre = utf8_encode($valor["sede_nombre"]);
	$sede_activo = utf8_encode($valor["sede_activo"]);
	
	$sedes_html .= "
				 <tr style='font-size: 14px'>			          									
					<td>$sede_nombre</td>
					<td>$sede_activo</td>
			      </tr>
			";

}



require_once "views/especialidad_sedes.php";
?>