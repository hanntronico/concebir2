<?php
include_once 'lib/config.php';
session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

(isset($_GET['i'])) ? $getinfo=$_GET['i'] :$getinfo='';

if ($_SESSION[iniuser]==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = '../'; </script>";
	exit();
}

$xajax->registerFunction('cambiarestatuscita');
$xajax->registerFunction('eliminarcita');

if ($perfil=="2"){
    $wherecita = " and c.usuario_idmedico = '$iniuser' ";
}else if ($perfil=="3"){
    $wherecita = " and c.usuario_idpaciente = '$iniuser' ";
    $displaynoneagregar = "; display: none ";
}

$conexion = new ConexionBd();

$result = $conexion->doSelect("
    c.cita_id,    
    c.usuario_idmedico,    
    c.usuario_idpaciente,    
    DATE_FORMAT(c.cita_fecha,'%d/%m/%Y %H:%i:%s') as cita_fecha,
    CONCAT(um.usuario_nombre,' ', um.usuario_apellido) AS medico,
    CONCAT(up.usuario_nombre,' ', up.usuario_apellido) AS paciente,
    e.especialidad_nombre,
    s.sede_nombre,
    DATE_FORMAT(c.cita_fechareg,'%d/%m/%Y %H:%i:%s') as cita_fechareg,    
    c.cita_activo,
    IF(c.cita_activo = 1, 'Activo', 'Inactivo') AS estado,
    cita_precio,
    estatus_nombre,
    estatus.estatus_id

    "
    ,
    "
    cita c
    LEFT JOIN sede s
       ON c.sede_id = s.sede_id
       
    INNER JOIN especialidad e
       ON c.especialidad_id = e.especialidad_id
       
    INNER JOIN usuario um
       ON c.usuario_idmedico = um.usuario_id
       
    INNER JOIN usuario up
       ON c.usuario_idpaciente = up.usuario_id

    INNER JOIN estatus on estatus.estatus_id = c.estatus_id
    "
    ,
    "c.cita_eliminado = '0' $wherecita");
// var_dump($result);
// print_r($result);
foreach($result as $i=>$valor){

	$cita_id = utf8_encode($valor["cita_id"]);
	$cita_fecha = utf8_encode($valor["cita_fecha"]);
	$medico = utf8_encode($valor["medico"]);
	$usuario_idmedico = utf8_encode($valor["usuario_idmedico"]);
	$usuario_idpaciente = utf8_encode($valor["usuario_idpaciente"]);
	$paciente = utf8_encode($valor["paciente"]);
    $especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	
    // $especialidad_nombre = $valor["especialidad_nombre"];
	
    $sede_nombre = utf8_encode($valor["sede_nombre"]);
	$cita_fechareg = utf8_encode($valor["cita_fechareg"]);
    $estado = utf8_encode($valor["estado"]);
    $cita_activo = utf8_encode($valor["cita_activo"]);
    $cita_precio = utf8_encode($valor["cita_precio"]);
    $estatus_nombre = utf8_encode($valor["estatus_nombre"]);
    $estatus_id = utf8_encode($valor["estatus_id"]);

    if ($cita_precio==""){$cita_precio=0;}

    $cita_precio = number_format($cita_precio,2,",","."). " PEN";

    $acciones = "<a href='vercita?id=$cita_id'>Ver</a> &nbsp";
    
    $pagos = "";

    if ($perfil=="1"){

        $acciones .= "<a href='modificarcita?id=$cita_id'><i title='Ver/Editar' class='fa fa-edit btn-modificar'></i></a>";
    
        $acciones .= "<i onclick='eliminarcita(\"".$cita_id."\",0)' title='Eliminar?' class='fa fa-trash btn-eliminar'></i>";
        
        $acciones .= ($cita_activo == "1")? 
        ("<i onclick='cambiarestatuscita(\"".$cita_id."\",0)'  title='Deshabilitar' class='fa fa-check btn-habilitar'></i>") : 
        ("<i onclick='cambiarestatuscita(\"".$cita_id."\",1)' title='Habilitar' class='fa fa-minus btn-deshabilitar'></i>");

    } else if($perfil == "2") {
        
        $acciones .= "<a href='salas/sala_26.php?idU=$usuario_idpaciente&idM=$usuario_idmedico'>Ir a mi sala</a> &nbsp";
        
    } else if($perfil == "3") {
        date_default_timezone_set('America/Lima');
        $citadt = explode(" ", $cita_fecha);
        $fc = explode("/", $citadt[0]);

        $fechacita = $fc[2]."-".$fc[1]."-".$fc[0];
        $horacita = $citadt[1];

        $datetime1 = date_create($fechacita);
        $datetime2 = date_create(date("Y-m-d"));
        $interval = date_diff($datetime1, $datetime2);

        // $pagos .= "<button type='button' class='btn btn-success'></button>";
        // $pagos .= "<i onclick='javascript: document.location.href=\""."seleccionarformapago?id=".$cita_id."\";' title='Pagar' class='fa fa-dollar btn btn-habilitar'></i>";

        if ($estatus_id==6) {
            $enlpago = "confirmarpago($cita_id)";
            $color_enlace_pago="";
        }else{
            $enlpago = "#";
            $color_enlace_pago="style='color:#C6C6C6'";
        }    

        $pagos .= "<i onclick='".$enlpago."' title='Pagar' class='fa fa-dollar btn btn-habilitar' ".$color_enlace_pago."></i>";



        if ($interval->format("%Y")==0 && $interval->format("%m")==0 && $interval->format("%d")==0) {

            $horaactual = date_create(date("H:i:s"));
            $horacit= date_create($citadt[1]);
            $interval2 = date_diff($horaactual, $horacit);
            $v = $interval2->format("%R%i");

            if($v>=-15&&$v<=10){
                $enlace="salas/sala_26.php?idU=$usuario_idpaciente&idM=$usuario_idmedico";
                $color_enlace="";
                $verbtn=1;
            }else{
                $enlace="#";
                $color_enlace="style='color:#808080'";                 
                $verbtn=0;
            }
        
        }else{
            $enlace="#";
            $color_enlace="style='color:#808080'";      
        }        


        $acciones .= "<a href='".$enlace."' ".$color_enlace." >Ir a mi cita</a> &nbsp"; 

        
    }
    
	
    
	
	
	$html .= "
                <tr style='font-size: 14px'>			          									
                    <td>$cita_id</td>
                    <td>$cita_fecha</td>
                    <td>$medico</td>
                    <td>$paciente</td>
                    <td>$especialidad_nombre</td>
                    <td>$sede_nombre</td>
                    <td>$cita_precio</td>
                    <td>$cita_fechareg</td>
                    <td>$estatus_nombre</td>
                    <td>$pagos</td>
                    <td>$acciones</td>
                </tr>
			";

}


require_once "views/citas.php";
?>