<?php
define ("EXP",6000000);
setlocale (LC_CTYPE, 'es_ES');
ini_set ("display_errors","0");
ini_set ("memory_limit","-1");

include_once 'lib/mysqlclass.php';
include_once 'lib/funciones.php';

$conexion = new ConexionBd();

(isset($_POST['token'])) ? $token=$_POST['token'] : $token='';
(isset($_POST['cita_id'])) ? $cita_id=$_POST['cita_id'] : $cita_id='';

session_start();
$iniuser = $_SESSION["iniuser"];

$fechaactual = formatoFechaHoraBd();


$arrresultado = $conexion->doSelect("
  cita_id, usuario_idmedico, usuario_idpaciente, especialidad_id, sede_id, 
  cita_activo, cita_eliminado, usuario_idreg,

  DATE_FORMAT(cita_fecha,'%d/%m/%Y') as fecha,
  DATE_FORMAT(cita_fecha,'%H:%i') as hora, cita_precio,

  DATE_FORMAT(cita_fechareg,'%d/%m/%Y %H:%i:%s') as cita_fechareg 
    ",
  "cita       
  ",
  "cita_eliminado = '0' and cita.cita_id = '$cita_id' $wherecita ");
foreach($arrresultado as $i=>$valor){

  $cita_id = utf8_encode($valor["cita_id"]);
  $usuario_idmedico = utf8_encode($valor["usuario_idmedico"]);
  $usuario_idpaciente = utf8_encode($valor["usuario_idpaciente"]);
  $t_especialidad_id = utf8_encode($valor["especialidad_id"]);
  $t_sede_id = utf8_encode($valor["sede_id"]);
  $cita_activo = utf8_encode($valor["cita_activo"]);  

  $fecha = utf8_encode($valor["fecha"]);  
  $hora = utf8_encode($valor["hora"]);  
  $cita_fechareg = utf8_encode($valor["cita_fechareg"]);  
  $cita_precio = utf8_encode($valor["cita_precio"]);  

  $cita_precioculqi = utf8_encode($valor["cita_precio"]); 
  
  if ($cita_precio==""){$cita_precio = 0;}
  if ($cita_precioculqi==""){$cita_precioculqi = 0;}

  $cita_precioculqi = number_format($cita_precioculqi,2,",","");

  $cita_precioculqi =  str_replace(",","",$cita_precioculqi);

  $cita_preciomostrar = number_format($cita_precio,2,",","."). " PEN";  

}


if ($iniuser==""){
    $iniuser=$usuario_idpaciente;

}


if ($getpago_id==""){

  $usuario_email = "meneses.rigoberto@gmail.com";

  // The data to send to the API 
  $postData = array(
      'amount' => $cita_precioculqi, 
      'email' => $usuario_email, 
      'currency_code' => 'PEN', 
      'source_id' => $token
  ); 

  /*
  sk_test_nr3VV4wMJfbrvXUV
  sk_live_ICavJKqBr0oh8Qzd
  */

  // Setup cURL 
  $ch = curl_init('https://api.culqi.com/v2/charges'); 
  curl_setopt_array($ch, array(
      CURLOPT_POST => TRUE, 
      CURLOPT_RETURNTRANSFER => TRUE, 
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_HTTPHEADER => array(
       'Authorization: Bearer sk_test_nr3VV4wMJfbrvXUV', 
       'Content-Type: application/json' 
      ), 
      CURLOPT_POSTFIELDS => json_encode($postData) 
  )); 

  // Send the request 
  $response = curl_exec($ch); 

  // Check for errors 
  if($response === FALSE){ 
      die(curl_error($ch)); 
  } 

  // Decode the response 
  $responseData = json_decode($response, TRUE); 

  foreach($responseData as $key => $val){
    $valorrespuesta = $responseData["object"];
    $mensaje = $responseData["merchant_message"];
  }


  if ($valorrespuesta=="errorr"){
    header("Location: resultadopago.php?id=$cita_id&e=$mensaje");
    echo "<script language='JavaScript'>window.location = 'resultadopago.php?id=$cita_id&e=$mensaje'; </script>";
    exit();
  }
  

  $resultado = $conexion->doInsert("
    pago
      (pago_monto, pago_referencia, pago_activo, pago_eliminado, pago_fechareg, pago_fechapago, usuario_id,
      cita_id, formapago_id, estatus_id, pago_observacion, pago_img, pago_banco) 

    ",
    "'$cita_precio', '','1','0', '$fechaactual','$fechaactual','$iniuser',
    '$cita_id','1','1', '','',''");

  $arrresultado2 = $conexion->doSelect("max(pago_id) as pago_id","pago");
  if (count($arrresultado2)>0){
    foreach($arrresultado2 as $i=>$valor){
      $pago_id = strtoupper($valor["pago_id"]);
    }
  }


  $resultado = $conexion->doUpdate("cita", "
    estatus_id ='5'
    ",
    "cita_id='$cita_id'");

}

echo "<script language='JavaScript'>alert('Pago Registrado Correctamente');</script>";
echo "<script language='JavaScript'>window.location = 'pagoregistrado.php?id=$cita_id&pid=$pago_id&f=1'; </script>";

?>