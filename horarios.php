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

$xajax->registerFunction('cambiarestatushorario');
$xajax->registerFunction('eliminarhorario');

$conexion = new ConexionBd();

$result = $conexion->doSelect("
    h.horario_id,
    h.horario_diaini,
    h.horario_diafin,
    DATE_FORMAT(h.horario_fecha,'%d/%m/%Y') as horario_fecha,    
    DATE_FORMAT(h.horario_horaini,'%H:%i') as horario_horaini,    
    DATE_FORMAT(h.horario_horafin,'%H:%i') as horario_horafin,        
    u.usuario_nombre,
    u.usuario_apellido,
    s.sede_nombre,
    h.horario_activo
    "
    ,
    "
    horario h, sede s, usuario u
    "
    ,
    "
    h.usuario_id = u.usuario_id
    AND
    h.sede_id = s.sede_id and h.horario_eliminado = '0'
");
//var_dump($result);
$html.= '<head> <link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    /></head>';
    $animation_delay = 100;
foreach($result as $i=>$valor){

	$horario_id = utf8_encode($valor["horario_id"]);
	$horario_diaini = utf8_encode($valor["horario_diaini"]);
	$horario_diafin = utf8_encode($valor["horario_diafin"]);
	$horario_fecha = utf8_encode($valor["horario_fecha"]);
	$horario_horaini = utf8_encode($valor["horario_horaini"]);
	$horario_horafin = utf8_encode($valor["horario_horafin"]);
	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
	$sede_nombre = utf8_encode($valor["sede_nombre"]);
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
	$horario_activo = utf8_encode($valor["horario_activo"]);
	
	$acciones = "<a href='modificarhorario?id=$horario_id'><i title='Ver/Editar' class='fa fa-edit btn-modificar'></i></a>";
	
	$acciones .= "<i onclick='eliminarhorario(\"".$horario_id."\",0)' title='Eliminar?' class='fa fa-trash btn-eliminar'></i>";
	
	$acciones .= ($horario_activo == "1")? 
    ("<i onclick='cambiarestatushorario(\"".$horario_id."\",0)' title='Deshabilitar' class='fa fa-check btn-habilitar'></i>") : 
    ("<i onclick='cambiarestatushorario(\"".$horario_id."\",1)' title='Habilitar' class='fa fa-minus btn-deshabilitar'></i>");
	
	$horario_activo = ($horario_activo == "1")? ("Activo") : ("Inactivo");
	$usuario = $usuario_apellido." ".$usuario_nombre;
	
	$html .= "
                <tr style='font-size: 14px; animation-delay: ".$animation_delay."ms;' class='animate__animated animate__flipInX'>			          									
                    <td>$horario_id</td>
                    <td>$horario_fecha</td>
                    
                    <td>$horario_diaini</td>
                    <td>$horario_diafin</td>
                    
                    <td>$horario_horaini</td>
                    <td>$horario_horafin</td>
                    <td>$usuario</td>
                    <td>$sede_nombre</td>                    
                    <td>$acciones</td>
                </tr>
			";
$animation_delay = $animation_delay + 20;
}


require_once "views/horarios.php";
?>