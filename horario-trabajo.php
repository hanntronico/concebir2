<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

(isset($_GET['id'])) ? $getid=$_GET['id'] :$getid='';

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
	*
    ",
	"
	horario_trabajo	
	",
	"id_medico = '$getid'");
	
foreach($arrresultado as $i=>$valor){

	$id = utf8_encode($valor["id"]);

	$descripcion = utf8_encode($valor["descripcion"]);
	$activo = utf8_encode($valor["activo"]);

	if ($activo=="0"){
        $activostr = "No";
		$activo = "<i title='Deshabilitar' class='fa fa-minus btn-deshabilitar'></i>";
	}else{
        $activostr = "Si";
		$activo = "<i title='Habilitar' class='fa fa-check btn-habilitar'></i>";
	}

	$dias = "<a href='horario-trabajo-dias?id=$id'>Dias</a>";
	
	$modificar = "<a href='modificar-horario-trabajo?id=$id'><i title='Ver' class='fa fa-edit btn-modificar'></i></a>";
	
	$accioneliminar = 
	"<a href='uploadhorariotrabajo?id_horario=$id&t=d'><i title='Eliminar' class='fa fa-trash btn-eliminar'></i></a>";
		

	$textohtml .= "
				 <tr style='font-size: 14px'>			          									
					<td>$id</td>
					<td>$descripcion</td>												
					<td>$activostr</td>
					<td style='text-align: center'>$modificar &nbsp $accioneliminar &nbsp $activo &nbsp $dias</td>
			      </tr>
			";

}



require_once "views/horario-trabajo.php";
?>