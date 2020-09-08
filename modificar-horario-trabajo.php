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
(isset($_GET['id_medico'])) ? $get_id_medico=$_GET['id_medico'] :$get_id_medico='';
(isset($_GET['id'])) ? $get_id=$_GET['id'] :$get_id='';


if($get_id != ''){
    $usuario_img = "1.png";
    
    $conexion = new ConexionBd();
    
    $arrresultado = $conexion->doSelect("
    	`id`, `id_medico`, `descripcion`, `activo`
        ",
    	"horario_trabajo				
    	",
    	"id = '$get_id'");
    	
    foreach($arrresultado as $i=>$valor){
    
    	$id_medico = utf8_encode($valor["id_medico"]);
    	$activo = utf8_encode($valor["activo"]);
    	$descripcion = utf8_encode($valor["descripcion"]);
    	
    	if($activo == '1'){
    	    $html_si_checked ="checked";
            $html_no_checked ="";
    	}else{
    	    $html_no_checked ="checked";
            $html_si_checked ="";
    	    
    	}
    	
    	$html_value_select_medicos = "value='$id_medico'";
    	$html_value_descripcion = "value='$descripcion'";
    
    }
    
    
    

}else{
    $id_medico = $get_id_medico;
    $html_si_checked ="";
    $html_no_checked ="checked";
}

require_once "views/modificar-horario-trabajo.php";

?>