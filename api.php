<?php

    date_default_timezone_set("America/Lima");

    include_once 'lib/config.php';
    
    session_start();
    if(isset($_SESSION)){
        
        $iniuser = $_SESSION["iniuser"];
        
        $conexion = new ConexionBd();

    $arrresultado = $conexion->doSelect("
	cita_fecha,
    usuario_idmedico,
    usuario_idpaciente,
    especialidad_id,
    sede_id,
     cita_fechareg,
     cita_activo,
     cita_eliminado,
     usuario_idreg 
    ",
	"
	cita 
	",
	"
	usuario_idpaciente = '$iniuser'
    AND cita_activo = '1' 
    AND cita_eliminado = '0'
	");
	$hoy = date("Y-m-d");
	$result= array();
    foreach($arrresultado as $i=>$valor){
        
        $date = explode(" ", utf8_encode($valor["cita_fecha"]));
        //echo " ".$date[0]." == ".$hoy;
        
        if($date[0] == $hoy){
            $result[] = $valor;
        }
    
    }
    
    
    
    
    

        $response_STRING["code"] = 200;
        $response_STRING["data"] = $result;
        
    }else{
        $response_STRING["code"] = 100;
        $response_STRING["data"] = [];
    }
    echo json_encode($response_STRING);
    //var_dump($_SESSION);
    
    
    /*
    //testing
    $string_JSON = file_get_contents('cita.json');
    $test_obj = json_decode($string_JSON);

    $response_STRING = array();
    $response_STRING["code"] = 200;
    $response_STRING["data"] = $test_obj;

    echo json_encode($response_STRING);
    */
    
    
    
