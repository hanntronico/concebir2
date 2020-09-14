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

(isset($_GET['id'])) ? $getmedico=$_GET['id'] :$getmedico='';



$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg, usuario_precio
    ",
	"usuario				
	",
	"usuario_activo = '1' and perfil_id = '2' and usuario.usuario_id = '$getmedico'");
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
	$usuario_precio = utf8_encode($valor["usuario_precio"]);

	if ($usuario_precio==""){$usuario_precio=0;}

	$usuario_precio = number_format($usuario_precio,2,",","."). " PEN";

	if ($usuario_img==""){$usuario_img="1.png";}

}

$arrresultado = $conexion->doSelect("
	especialidad.especialidad_id, especialidad_nombre, usuarioespecialidad_id
    ",
	"especialidad 
		inner join usuarioespecialidad on usuarioespecialidad.especialidad_id = especialidad.especialidad_id		
		and usuarioespecialidad.usuario_id = '$usuario_id' and usuarioespecialidad_activo = '1'
	",
	"especialidad_activo = '1'");


foreach($arrresultado as $i=>$valor){

	$especialidad_id = utf8_encode($valor["especialidad_id"]);
	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$usuarioespecialidad_id = utf8_encode($valor["usuarioespecialidad_id"]);

	$divespecialidades .= "
		<button type='button' class='btn btn-success' style='font-size: 17px; cursor: default;'>$especialidad_nombre </button>
	";

}


if ($divespecialidades==""){
	$divespecialidades= "
		<div class='alert alert-warning' style='text-align: center; font-weight: normal;'>
            <a style='color: #000; font-size: 14px; text-decoration: none;'>
                No tiene especialidades cargadas
            </a><br>
        </div>

	";
}


$arrresultado = $conexion->doSelect("
	sede.sede_id, sede_nombre, usuariosede_id
    ",
	"sede 
		inner join usuariosede on usuariosede.sede_id = sede.sede_id		
		and usuariosede.usuario_id = '$usuario_id' and usuariosede_activo = '1'
	",
	"sede_activo = '1'");

foreach($arrresultado as $i=>$valor){

	$sede_id = utf8_encode($valor["sede_id"]);
	$sede_nombre = utf8_encode($valor["sede_nombre"]);
	$usuariosede_id = utf8_encode($valor["usuariosede_id"]);

	$divsedes .= "
		<button type='button' class='btn btn-success' style='font-size: 17px; cursor: default;'>$sede_nombre </button>
	";

}


if ($divsedes==""){
	$divsedes= "
		<div class='alert alert-warning' style='text-align: center; font-weight: normal;'>
            <a style='color: #000; font-size: 14px; text-decoration: none;'>
                No tiene sedes cargadas
            </a><br>
        </div>

	";
}



$arrresultado = $conexion->doSelect("
	horario.horario_id, horario.usuario_id, horario.sede_id,  
	horario_activo, horario_eliminado, horario.usuario_idreg,
	DATE_FORMAT(horario_fecha,'%d/%m/%Y') as horario_fecha,		
	DATE_FORMAT(horario_horaini,'%H:%i') as horaini, 
	DATE_FORMAT(horario_horafin,'%H:%i') as horafin, 

	DATE_FORMAT(horario_fechareg,'%d/%m/%Y %H:%i:%s') as horario_fechareg, 
	sede_nombre
    ",
	"horario
		inner join sede on sede.sede_id = horario.sede_id		
	",
	"horario_activo = '1'  and horario.usuario_id = '$getmedico'");
foreach($arrresultado as $i=>$valor){

	$horario_id = utf8_encode($valor["horario_id"]);
	$t_usuario_id = utf8_encode($valor["usuario_id"]);
	$t_sede_id = utf8_encode($valor["sede_id"]);

	$horario_activo = utf8_encode($valor["horario_activo"]);
	$horario_fecha = utf8_encode($valor["horario_fecha"]);	
	$horaini = utf8_encode($valor["horaini"]);	
	$horafin = utf8_encode($valor["horafin"]);	
	$horario_fechareg = utf8_encode($valor["horario_fechareg"]);

	$sede_nombre = utf8_encode($valor["horario_fechareg"]);		

	$divhorario .="
	<div class='row'>
      <div class='col-md-3' style='font-size: 20px'>
        <label style='font-size: 20px'>Fecha:</label>
        $horario_fecha
      </div>
      <div class='col-md-6' style='font-size: 20px'>
        <label style='font-size: 20px'>Horario:</label>
        $horaini - $horafin
      </div>                      
    </div>
	";

}






$event_count= 0;
$event_count2= 0;
$horario=array();

$arrresultado = $conexion->doSelect("
	 htd.*
    ",
	"
	`horario_trabajo` ht INNER JOIN horario_trabajo_dias htd ON ht.id = htd.id_horario_trabajo
	",
	"ht.id_medico = '$getmedico'");
	
foreach($arrresultado as $i=>$row){

    $event_count++;
    $event_count2++;

    (!isset($horario[$row['dia']])) && $horario[$row['dia']]= "";

//     $horario[$row['dia']] .= <<<XML
//     <li class="cd-schedule__event">
//         <a
//             data-start="{$row['inicio_hora']}"
//             data-end="{$row['fin_hora']}"
//             data-content="event-abs-circuit"
//             data-event="event-$event_count"
//             href="#$event_count2"
//         >
//             <em class="cd-schedule__name"
//                 > Disponible</em
//             >
//         </a>
//     </li>
// XML;



//     $horario[$row['dia']] .= <<<XML
// 		{$row['inicio_hora']} - {$row['fin_hora']} 
// XML;

    $horario[$row['dia']] .= date_format(date_create($row['inicio_hora']), 'H:i')." - ". date_format(date_create($row['fin_hora']), 'H:i');

    // {$row['dia']} : {$row['inicio_hora']} {$row['fin_hora']}

    ($event_count==4)&&$event_count=0;
}

$dias = [
    'Lunes',
    'Martes',
    'Miercoles',
    'Jueves',
    'Viernes',
    'Sabado',
    'Domingo'
];
$semana="";
foreach ($dias as $i => $dia) {

    
    (!isset($horario[$i+1])) && $horario[$i+1]= "";

//     $semana .= <<<XML
//     <li class="cd-schedule__group">
//         <div class="cd-schedule__top-info">
//             <span>$dia</span>
//         </div>

//         <ul>
//             {$horario[$i+1]}
//         </ul>
//     </li>
// XML;

if ($horario[$i+1]!="") {
	# code...



		// $date = date_create($horario[$i+1]);
		// $horariodia = date_format($date, 'H:i:s');

    $semana .= <<<XML
    <li>
            <span>$dia : {$horario[$i+1]}</span>
    </li>
XML;

}

    // $semana .= 	$dia."-".$i.$horario[$i+1];


    ($event_count==4)&&$event_count=0;
}


require_once "views/medico.php";

?>