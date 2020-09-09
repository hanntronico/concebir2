<?php
include_once 'lib/config.php';

session_start();
session_destroy();

(isset($_GET['s'])) ? $getsalir_id=$_GET['s'] :$getsalir_id='';

if ($getsalir_id==1){
	$info  = "
		<div class='alert alert-success' style='text-align: center; font-weight: normal;'>
            <a style='color: #fff !important; font-size: 14px; text-decoration: none;'>
                Cerrada la sesión correctamente
            </a><br>
        </div>
	";
}

// http://104.200.144.70:8085/api/datosreniec/08714804

$xajax->registerFunction('ingresarusuario');
$xajax->registerFunction('registrarusuario2');

$conexion = new ConexionBd();

$datosreniec = json_decode(file_get_contents('http://104.200.144.70:8085/api/datosreniec/08714804'), true);

echo $datosreniec['objModel']['nombres']."<br>";
echo $datosreniec['objModel']['apellidoPaterno']."<br>";
echo $datosreniec['objModel']['apellidoMaterno']."<br>";

exit();

session_start();
(isset($_GET['email'])) ? $email=$_GET['email'] :$email='';

if ($email!=""){

  $info  = "
        <div class='alert alert-danger' style='text-align: center; font-weight: normal;'>
            <a style='color: #fff !important; font-size: 14px; text-decoration: none;'>
                Correo $email no existe en el sistema, por favor verifique
            </a><br>
        </div>
  ";
	

	$arrresultado = $conexion->doSelect("
		usuario_id, usuario_nombre, usuario_apellido, usuario_clave, usuario_email
	","usuario
	", " usuario_email = '$email' and usuario_activo = '1'");

	if (count($arrresultado)>0){
		foreach($arrresultado as $m=>$valor){

			$usuario_id = utf8_encode($valor["usuario_id"]);
			$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
			$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
			$usuario_clave = utf8_encode($valor["usuario_clave"]);
			$usuario_email = utf8_encode($valor["usuario_email"]);
			$usuario_telf = utf8_encode($valor["usuario_telf"]);

			$libemail = new LibEmail();

			$texto = "
			Recibimos su mensaje para recuperar su clave para ingresar a Clinica 
			<br><br>				
      		<br>Email: ".$usuario_email."
			<br>Clave: ".$usuario_clave."
			<br><br>
			";
			$asunto = "Recuperación de Clave - Clinica";

			$resultado = $libemail->enviarcorreo($email, $asunto, $texto, $titulo, $logo);
			//$resultado = $libemail->enviarcorreo("meneses.rigoberto@gmail.com", $asunto, $texto, $titulo, $logo);


			$info = "
		        <div class='alert alert-success' style='text-align: center; font-weight: normal;'>
		            <a style='color: #fff !important; font-size: 14px; text-decoration: none;'>
		                Mensaje enviado correctamente a su email con las instrucciones para recuperar la clave
		            </a><br>
		        </div>
		      ";

		}
	}	
}

require_once "views/index.php";

?>