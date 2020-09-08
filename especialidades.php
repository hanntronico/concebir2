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

$xajax->registerFunction('cambiarestatusespecialidad');
$xajax->registerFunction('eliminarespecialidad');

if(isset($_GET["id"])){
	
	$id_usuario_consultar = ($_GET["id"]);;
	
	//var_dump($id_usuario_consultar);
	
	//echo "consultar $id_usuario_consultar";
}


$conexion = new ConexionBd();

$result = $conexion->doSelect("
    especialidad_id,
    especialidad_nombre,
    especialidad_codigoexterno,
    especialidad_img,
    especialidad_activo
	"
	,
	"
	especialidad
	", "especialidad_eliminado = '0'");
	$animation_delay = 100;
	$html .= '<head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" /></head>';
foreach($result as $i=>$valor){

	$id = utf8_encode($valor["especialidad_id"]);
	$nombre = utf8_encode($valor["especialidad_nombre"]);
	$codigoexterno = utf8_encode($valor["especialidad_codigoexterno"]);
	$img = utf8_encode($valor["especialidad_img"]);
	$activo = utf8_encode($valor["especialidad_activo"]);
	
	
	$acciones = "<a href='modificarespecialidad?id=$id'><i title='Ver/Editar' class='fa fa-edit btn-modificar'></i></a>";
	
	$acciones .= "<i  onclick='eliminarespecialidad(\"".$id."\",0)' title='Eliminar?' class='fa fa-trash btn-eliminar'></i>";

	if ($img==""){$img="0.jpg";}

	$imagen = "<img src='arch/$img' style='height: 50px;' />";
	
	$acciones .= ($activo == "1")? 
	("<i onclick='cambiarestatusespecialidad(\"".$id."\",0)' title='Deshabilitar' class='fa fa-check btn-habilitar'></i>") : 
	("<i onclick='cambiarestatusespecialidad(\"".$id."\",1)' title='Habilitar' class='fa fa-minus btn-deshabilitar'></i>");
	
	$activo = ($activo == "1")? ("Activo") : ("Inactivo");
	
	$html .= "
                <tr style='font-size: 14px; animation-delay: ".$animation_delay."ms' class='animate__animated animate__flipInX'>			          									
                    <td>$id</td>
                    <td>$nombre</td>                    
                    <td>$imagen</td>                    
                    <td>$acciones</td>
                </tr>
			";
			$animation_delay = $animation_delay + 20;

}


require_once "views/especialidades.php";
?>