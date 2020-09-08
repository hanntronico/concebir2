<?php
include_once 'lib/mysqlclass.php';

function verificarExtensionArchivoImagen($extension=null){

  $extension = strtolower($extension);

  if ($extension=="jpg" || $extension=="jpeg" || $extension=="png" || $extension=="bmp" || $extension=="gif"){
    return 1;
  }

  return 0;

}

function generateRandomNumber() {
	$length = 4;
	$characters = '0123456789';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function generateRandomString() {
	$length = 2;
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function generarId() {
	$codigo = generateRandomString().generateRandomNumber();
	return $codigo;
}

function formatoFechaHoraBd($sinhora=null, $diasatras=null, $mesesrecorrer =null) {
	//ini_set('date.timezone','UTC');
  date_default_timezone_set('America/Argentina/Buenos_Aires');

  $fecha_actual = date("Y-m-d");

	$tiempoMod = time();
	if($sinhora=="1"){
    if($mesesrecorrer!=""){          
      return date("Y-m-d",strtotime($fecha_actual." $mesesrecorrer months"));
    }else{
      return date("Y-m-d",$tiempoMod);  
    }
	}else if($diasatras!=""){
    if ($diasatras=="1"){
      $diasatras = 30;
    }
    return date("Y-m-d",strtotime($fecha_actual." - $diasatras days")); ;
  }else if($mesesrecorrer!=""){    
    return date("Y-m-d",strtotime($fecha_actual." $mesesrecorrer months"));
  }else{
		return date("Y-m-d H:i:s",$tiempoMod);
	}
}


?>