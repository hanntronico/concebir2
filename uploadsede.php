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



(isset($_POST['sede_id'])) ? $sede_id=$_POST['sede_id'] : $sede_id='';
(isset($_POST['sede_nombre'])) ? $sede_nombre=$_POST['sede_nombre'] : $sede_nombre='';
(isset($_POST['sede_nombrecorto'])) ? $sede_nombrecorto=$_POST['sede_nombrecorto'] : $sede_nombrecorto='';

$sede_nombre = utf8_decode($sede_nombre);
$sede_nombrecorto = utf8_decode($sede_nombrecorto);

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
if ($sede_id==""){

	$resultado = $conexion->doInsert("
	sede
		(sede_nombre, sede_nombrecorto, sede_img, sede_activo, sede_eliminado, sede_fechareg)
	",
	"'$sede_nombre', '$sede_nombrecorto', '1', '0', '$fechaactual'");

}else{

	$resultado = $conexion->doUpdate("sede", "		
		sede_nombre ='$sede_nombre',
		sede_nombrecorto ='$sede_nombrecorto'
		",
		"sede_id='$sede_id'");

}

echo "<script language='JavaScript'>alert('Sede Guardado Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'sedes'; </script>";

?>