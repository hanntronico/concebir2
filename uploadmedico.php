<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];


if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.parent.window.location = 'index'; </script>";
	exit();
}

if ($perfil!="1"){
	echo "<script language='JavaScript'>alert('Error: No posee acceso para hacer esta accion, por favor inicie sesion de nuevo');</script>";
	echo "<script language='JavaScript'>window.parent.window.location = 'index'; </script>";
	exit();
}



function getExtension($str) {

	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

(isset($_POST['usuario_id'])) ? $usuario_id=$_POST['usuario_id'] : $usuario_id='';
(isset($_POST['usuario_nombre'])) ? $usuario_nombre=$_POST['usuario_nombre'] : $usuario_nombre='';
(isset($_POST['usuario_apellido'])) ? $usuario_apellido=$_POST['usuario_apellido'] : $usuario_apellido='';
(isset($_POST['usuario_email'])) ? $usuario_email=$_POST['usuario_email'] : $usuario_email='';
(isset($_POST['usuario_clave'])) ? $usuario_clave=$_POST['usuario_clave'] : $usuario_clave='';
(isset($_POST['usuario_dni'])) ? $usuario_dni=$_POST['usuario_dni'] : $usuario_dni='';
(isset($_POST['usuario_celular'])) ? $usuario_celular=$_POST['usuario_celular'] : $usuario_celular='';
(isset($_POST['usuario_precio'])) ? $usuario_precio=$_POST['usuario_precio'] : $usuario_precio='';


(isset($_POST['especialidades'])) ? $especialidades=$_POST['especialidades'] : $especialidades='';
(isset($_POST['sedes'])) ? $sedes=$_POST['sedes'] : $sedes='';

$usuario_nombre = utf8_decode($usuario_nombre);
$usuario_apellido = utf8_decode($usuario_apellido);
$usuario_email = utf8_decode($usuario_email);
$usuario_clave = utf8_decode($usuario_clave);
$usuario_dni = utf8_decode($usuario_dni);
$usuario_celular = utf8_decode($usuario_celular);

$fechaactual = formatoFechaHoraBd();

$conexion = new ConexionBd();

$temp = explode(".", $_FILES["file1"]["name"]);
$extension = end($temp);


for ($n=1; $n<=1; $n++){
	
	$temp = explode(".", $_FILES["file$n"]["name"]);
	$extension = end($temp);
	//
	//$temp = explode(".", $_FILES["file"]["name"]);
	

	if ($extension!="") {
		
		if ($_SESSION[iniuser]  =="" || $_SESSION[iniuser]  =="0")
		{
			echo "<script language='JavaScript'>alert('Error: Debe estar conectado');</script>";
			return false;
		}
			
			
		if (($_FILES["file$n"]["error"] > 0))
		{
			echo "<script language='JavaScript'>alert('Error 113 cargando el archivo, intente nuevamente. Codigo 113');</script>";
		}
		else
		{		

			$verificartipodeextension = verificarExtensionArchivoImagen($extension); 

			if ($verificartipodeextension!="1"){
				echo "<script language='JavaScript'>alert('Error: El tipo de archivo debe ser una imagen por favor verifique. Verifique que el formato sea jpg o png');</script>";
				return false;
			}	
	
			define ("MAX_SIZE","50000");
	
			$tamano = $_FILES["file$n"]["size"] / 1024;
			$nombrearchivo = utf8_decode($_FILES["file$n"]["name"]);				

				
			if ($tamano >= "0" ){

				$nombrearchivo = preg_replace("/\.[^.]+$/", "", $nombrearchivo);
				
				$nombrereal = $nombrearchivo.".".$extension;
				$nombrecolocar = uniqid();	
				$nombrecolocar = $nombrecolocar.".".$extension;
				
				$urlarchivo = "arch/".$nombrecolocar;				
				unlink($urlarchivo);						

				$resultado = move_uploaded_file($_FILES["file$n"]["tmp_name"],$urlarchivo);

			}
		}		
	}
	
}

if ($usuario_id==""){

	$resultado = $conexion->doInsert("
	usuario
		(usuario_nombre, usuario_apellido, usuario_email, usuario_clave, usuario_dni, usuario_celular, usuario_precio,
		usuario_img, perfil_id, usuario_activo, usuario_eliminado, usuario_fechareg, usuario_idreg)
	",
	"'$usuario_nombre', '$usuario_apellido', '$usuario_email', '$usuario_clave', '$usuario_dni', '$usuario_celular','$usuario_precio',
	'$nombrecolocar', '2', '1', '0', '$fechaactual', '$iniuser'");

  	$arrresultado2 = $conexion->doSelect("max(usuario_id) as usuario_id","usuario");
	  if (count($arrresultado2)>0){
		  foreach($arrresultado2 as $i=>$valor){
			  $usuario_id = strtoupper($valor["usuario_id"]);
		  }
	  }
  
  
  		foreach ($especialidades as $especialidad_id){
	    	$resultado = $conexion->doInsert("
		   	usuarioespecialidad
		   	(usuario_id, especialidad_id, usuarioespecialidad_activo, usuarioespecialidad_eliminado, usuarioespecialidad_fechareg)
		    ",
			"'$usuario_id', '$especialidad_id', '1','0', '$fechaactual'");		    
  		}


  		foreach ($sedes as $sede_id){
	    	$resultado = $conexion->doInsert("
		   	usuariosede
		   	(usuario_id, sede_id, usuariosede_activo, usuariosede_eliminado, usuariosede_fechareg)
		    ",
			"'$usuario_id', '$sede_id', '1','0', '$fechaactual'");		    
  		}
  		
  	$sala_location = "salas/";
  	
    $template = file_get_contents($sala_location."header.php");
    
    $myfile = fopen($sala_location."sala_".$usuario_id.".php", "w");
    
    fwrite($myfile, $template);
    
    fclose($myfile);
}else{

	if ($nombrecolocar!=""){
		$nombrecolocar = "usuario_img ='$nombrecolocar',";
	}


	$resultado = $conexion->doUpdate("usuarioespecialidad", "
	    usuarioespecialidad_activo ='0',        
    	usuarioespecialidad_eliminado ='1'      
	 ",
	  "usuario_id='$usuario_id' ");

	foreach ($especialidades as $especialidad_id){
    	$resultado = $conexion->doInsert("
	   	usuarioespecialidad
	   	(usuario_id, especialidad_id, usuarioespecialidad_activo, usuarioespecialidad_eliminado, usuarioespecialidad_fechareg)
	    ",
		"'$usuario_id', '$especialidad_id', '1','0','$fechaactual'");		    
		}


	$resultado = $conexion->doUpdate("usuariosede", "
	    usuariosede_activo ='0',        
    	usuariosede_eliminado ='1'      
	 ",
	  "usuario_id='$usuario_id' ");

	foreach ($sedes as $sede_id){
    	$resultado = $conexion->doInsert("
	   	usuariosede
	   	(usuario_id, sede_id, usuariosede_activo, usuariosede_eliminado, usuariosede_fechareg)
	    ",
		"'$usuario_id', '$sede_id', '1','0','$fechaactual'");		    
		}


	$resultado = $conexion->doUpdate("usuario", "
		$nombrecolocar
		usuario_nombre ='$usuario_nombre',
		usuario_apellido ='$usuario_apellido',	
		usuario_email ='$usuario_email',
		usuario_clave ='$usuario_clave',
		usuario_precio = '$usuario_precio',
		usuario_dni ='$usuario_dni',			
		usuario_celular = '$usuario_celular'
		",
		"usuario_id='$usuario_id'");

}

echo "<script language='JavaScript'>alert('Medico Guardado Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'medicos'; </script>";

?>