<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

(isset($_GET['i'])) ? $getinfo=$_GET['i'] :$getinfo='';

if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = './'; </script>";
	exit();
}

if ($perfil!="1"){
	echo "<script language='JavaScript'>window.location = 'panel'; </script>";
	exit();
}

$xajax->registerFunction('cambiarestatususuario');
$xajax->registerFunction('eliminarusuario');

$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg	
    ",
	"usuario				
	",
	"usuario_eliminado = '0' and perfil_id = '2'");
	$animation_delay = 100;
	$textohtml .= '<head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" /></head>';

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

	$usuario = $usuario_nombre." ".$usuario_apellido;

	if ($usuario_activo=="0"){
		$activo = "<i onclick='cambiarestatususuario(\"".$usuario_id."\",1)' title='Deshabilitar' class='fa fa-minus btn-deshabilitar'></i>";
	}else{
		$activo = "<i onclick='cambiarestatususuario(\"".$usuario_id."\",0)' title='Habilitar' class='fa fa-check btn-habilitar'></i>";
	}

	
	$accioneliminar = "<i onclick='eliminarusuario(\"".$usuario_id."\",0)' title='Eliminar?' class='fa fa-trash btn-eliminar'></i>";
	
	$accioneditarhorario = "<a href='horario-trabajo?id=$usuario_id'><i title='Editar horario' class='fa fa-calendar btn-modificar'></i></a>";

	$modificar = "<a href='modificarmedico?id=$usuario_id'><i title='Ver' class='fa fa-edit btn-modificar'></i></a>";

	$especialidadsedes = "<a href='especialidad_sedes?id=$usuario_id'>Especialidades / Sedes</a>";
		

	$textohtml .= "
				 <tr style='font-size: 14px; animation-delay: ".$animation_delay."ms;' class='animate__animated animate__flipInX'>			          									
					<td>$usuario_id</td>
					<td>$usuario</td>												
					<td>$usuario_email</td>
					<td>$usuario_celular</td>												
					<td>$usuario_fechareg</td>																		
					<td>$especialidadsedes</td>																		
					<td style='text-align: center'>$modificar &nbsp $activo &nbsp $accioneliminar &nbsp $accioneditarhorario</td>						
			      </tr>
			";

			$animation_delay = $animation_delay + 20;
}



require_once "views/medicos.php";
?>