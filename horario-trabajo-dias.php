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
(isset($_GET['edit'])) ? $get_edit=$_GET['edit'] :$get_edit='';

$usuario_img = "1.png";


if ($perfil=="2"){
	$wherehorario = " and horario.usuario_id = '$iniuser' ";
}else if ($perfil=="3"){
	echo "<script language='JavaScript'>window.location = 'panel'; </script>";
	exit();
}

$days = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");

$conexion = new ConexionBd();


$arrresultado = $conexion->doSelect("id, dia, inicio_hora, fin_hora","horario_trabajo_dias","id_horario_trabajo = '$get_id'");

foreach($arrresultado as $i => $valor){
	$id = utf8_encode($valor["id"]);	
	$dia = utf8_encode($valor["dia"]);	
	$inicio_hora = utf8_encode($valor["inicio_hora"]);	
	$fin_hora = utf8_encode($valor["fin_hora"]);	
	
	$accioneliminar = 
	"<a href='upload-dias-horario-trabajo?dia_id=$id&type=d'><i title='Eliminar' class='fa fa-trash btn-eliminar'></i></a>";
	
	$modificar = "<a href='horario-trabajo-dias?id=$get_id&edit=$id'><i title='Ver' class='fa fa-edit btn-modificar'></i></a>";
	$diastr=$days[$dia-1];
    
	$textohtml .= "
				 <tr style='font-size: 14px'>			          									
					<td>$id</td>
					<td title='$dia'>$diastr</td>												
					<td>$inicio_hora</td>
					<td>$fin_hora</td>												
					<td style='text-align: center'>$modificar &nbsp $accioneliminar</td>						
			      </tr>
			";
	
	
}

$option_days = "";
$contdays=0;
foreach($days as $i=>$valor){
    $contdays++;
    if($i == 0){
        
	    $option_days .= "<option selected='selected' value='$contdays'>$valor</option>";
	    
    }else{
	    $option_days .= "<option value='$contdays'>$valor</option>";
    }
}



$btn_save = 'Agregar';

if($get_edit != '' ){
    $btn_save= 'Guardar Cambios';
    
    $arrresultado = $conexion->doSelect("id, dia, inicio_hora, fin_hora","horario_trabajo_dias","id_horario_trabajo = '$get_id' and id= '$get_edit'");
    
    foreach($arrresultado as $i => $valor){
        $dia_edit = utf8_encode($valor["dia"]);	
    	$inicio_hora_edit = utf8_encode($valor["inicio_hora"]);	
    	$fin_hora_edit = utf8_encode($valor["fin_hora"]);	
    	
    	$option_days = "";
        $contdays=0;
        foreach($days as $i=>$valor){
            $contdays++;
            if($contdays == $dia_edit){
                
        	    $option_days .= "<option selected='selected' value='$contdays'>$valor</option>";
        	    
            }else{
        	    $option_days .= "<option value='$contdays'>$valor</option>";
            }
        }
        
        
    }

    
}

require_once "views/horario-trabajo-dias.php";

?>