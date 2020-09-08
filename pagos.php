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

if ($perfil=="2"){
    $wherepago = " and cita.usuario_idmedico = '$iniuser' ";
}else if ($perfil=="3"){
    $wherepago = " and cita.usuario_idpaciente = '$iniuser' ";    
}

$xajax->registerFunction('cambiarestatuspago');
$xajax->registerFunction('eliminarpago');

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
	"pago_eliminado = '0' $wherepago ", null, "pago.pago_id desc");
	$textohtml.= '<head> <link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
	/></head>';
	$animation_delay = 100;
foreach($arrresultado as $i=>$valor){

	$pago_id = utf8_encode($valor["pago_id"]);
	$pago_monto = utf8_encode($valor["pago_monto"]);
	$pago_referencia = utf8_encode($valor["pago_referencia"]);
	$pago_activo = utf8_encode($valor["pago_activo"]);
	$cita_id = utf8_encode($valor["cita_id"]);
	$formapago_id = utf8_encode($valor["formapago_id"]);
	$estatus_id = utf8_encode($valor["estatus_id"]);
	$pago_observacion = utf8_encode($valor["pago_observacion"]);
	$pago_img = utf8_encode($valor["pago_img"]);
	$pago_banco = utf8_encode($valor["pago_banco"]);
	$pago_fechareg = utf8_encode($valor["pago_fechareg"]);	

	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);	
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);	
	$formapago_nombre = utf8_encode($valor["formapago_nombre"]);	
	$estatus_nombre = utf8_encode($valor["estatus_nombre"]);	

  	$pago_monto = number_format($pago_monto,2,",","."). " PEN";  	

	$usuario = $usuario_nombre." ".$usuario_apellido;

	if ($pago_activo=="0"){
		$activo = "<i onclick='cambiarestatuspago(\"".$pago_id."\",1)' title='Deshabilitar' class='fa fa-minus btn-deshabilitar'></i>";
	}else{
		$activo = "<i onclick='cambiarestatuspago(\"".$pago_id."\",0)' title='Habilitar' class='fa fa-check btn-habilitar'></i>";
	}

	
	$accioneliminar = "<i onclick='eliminarpago(\"".$pago_id."\",0)' title='Eliminar?' class='fa fa-trash btn-eliminar'></i>";

	$modificar = "<a href='verpago?id=$pago_id'>Ver Pago</a>";

	if ($perfil!="1"){
		$activo = "";
		$accioneliminar = "";
	}
	
		

	$textohtml .= "
				 <tr style='font-size: 14px; animation-delay: ".$animation_delay."ms;'class='animate__animated animate__flipInX'>			          									
					<td>$pago_id</td>
					<td>$pago_monto</td>												
					<td>#$cita_id</td>
					<td>$usuario</td>												
					<td>$formapago_nombre</td>												
					<td>$estatus_nombre</td>												
					<td>$pago_fechareg</td>																		
					<td style='text-align: center'>$modificar &nbsp $activo &nbsp $accioneliminar</td>						
			      </tr>
			";
	$animation_delay = $animation_delay + 20;

}



require_once "views/pagos.php";
?>