<?php 
date_default_timezone_set('America/Lima');

$fecha_ven="2020-08-31 11:36";
$fecha_actual=date("Y-m-d H:i");

$fecha_vencimiento = new DateTime($fecha_ven);
$fecha_de_hoy = new DateTime($fecha_actual);

// $interval = $fecha_vencimiento->diff($fecha_de_hoy);

$interval = $fecha_de_hoy->diff($fecha_vencimiento);

$minutos = $interval->format('%R%i');

// echo $minutos-10;

if ($minutos>=-15&&$minutos<=10) {
	echo $minutos;
}




// $datetime1 = date_create("2020-08-31");
// $datetime2 = date_create(date("Y-m-d"));
// $interval = date_diff($datetime1, $datetime2);
   
// $difanio = $interval->format("%Y");
// $difmes = $interval->format("%m");
// $difdia = $interval->format("%d");

// if ($difanio==0 && $difmes==0 && $difdia==0) {
// 	echo "es hoy";
// }





// $date1 = new DateTime("2020-08-31 15:29:00");
// // $date2 = new DateTime("now");
// $date2 = new DateTime();

// $diff = $date1->diff($date2);
// // 38 minutes to go [number is variable]
// echo ( ($diff->days * 24 ) * 60 ) + ( $diff->i ) . ' minutes';
// // passed means if its negative and to go means if its positive
// echo ($diff->invert == 1 ) ? ' passed ' : ' to go ';



?>