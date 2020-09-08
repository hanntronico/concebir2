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

(isset($_POST['especialidad_id'])) ? $especialidad_id=$_POST['especialidad_id'] : $especialidad_id='';
(isset($_POST['especialidad_nombre'])) ? $especialidad_nombre=$_POST['especialidad_nombre'] : $especialidad_nombre='';
(isset($_POST['especialidad_codigoexterno'])) ? $especialidad_codigoexterno=$_POST['especialidad_codigoexterno'] : $especialidad_codigoexterno='';
(isset($_POST['especialidad_consede'])) ? $especialidad_consede=$_POST['especialidad_consede'] : $especialidad_consede='';

$especialidad_nombre = utf8_decode($especialidad_nombre);
$especialidad_codigoexterno = utf8_decode($especialidad_codigoexterno);

if ($especialidad_consede=="on"){
	$especialidad_consede=1;
}else{
	$especialidad_consede=0;
}

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

if ($especialidad_id==""){

	$resultado = $conexion->doInsert("
	especialidad
		(especialidad_nombre, especialidad_codigoexterno, especialidad_img, especialidad_activo, especialidad_eliminado, especialidad_fechareg, especialidad_consede) 
	",
	"'$especialidad_nombre', '$especialidad_codigoexterno', '$nombrecolocar', '1', '0', '$fechaactual','$especialidad_consede'");

}else{

	if ($nombrecolocar!=""){
		$nombrecolocar = "especialidad_img ='$nombrecolocar',";
	}


	$resultado = $conexion->doUpdate("especialidad", "
		$nombrecolocar
		especialidad_nombre ='$especialidad_nombre',
		especialidad_codigoexterno ='$especialidad_codigoexterno',
		especialidad_consede ='$especialidad_consede'
		",
		"especialidad_id='$especialidad_id'");

}

echo "<script language='JavaScript'>alert('Especialidad Guardado Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'especialidades'; </script>";

?>