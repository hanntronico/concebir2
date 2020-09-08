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

(isset($_POST['id_horario'])) ? $id_horario=$_POST['id_horario'] : $id_horario='';
(isset($_POST['id_medico'])) ? $id_medico=$_POST['id_medico'] : $id_medico='';
(isset($_POST['descripcion'])) ? $descripcion=$_POST['descripcion'] : $descripcion='';
(isset($_POST['activo'])) ? $activo=$_POST['activo'] : $activo='';

(isset($_GET['t'])) ? $type=$_GET['t'] : $type='';

if($id_horario==""){
    (isset($_GET['id_horario'])) ? $id_horario=$_GET['id_horario'] : $id_horario='';
}

// echo "post ";
// var_dump($_POST);
if($type=='d'){
    echo "eliminar";
}


$conexion = new ConexionBd();

if($type==''){
    if($id_horario == ""){
            if($activo=='1'){
        	    $resultado = $conexion->doUpdate("horario_trabajo", "
        		activo ='0'
        		",
        		"id_medico='$id_medico'");
        	}
        	
            $resultado = $conexion->doInsert("
        	`horario_trabajo`(`id_medico`, `descripcion`, `activo`)
        	",
        	"$id_medico,'$descripcion',$activo");
        	
        
        
    	
    }
    else{
            if($activo=='1'){
        	    $resultado = $conexion->doUpdate("horario_trabajo", "
        		activo ='0'
        		",
        		"id_medico='$id_medico'");
        	}
        	$resultado = $conexion->doUpdate("horario_trabajo", "
        		id_medico ='$id_medico',
        		descripcion ='$descripcion',
        		activo ='$activo'
        		
        		",
        		"id='$id_horario'");
        
    }
    
}
else{
    
    $host_name = N;
    $database = E; // Change your database name
    $username = M;          // Your database user id 
    $password = R;          // Your password
    
    //////// Do not Edit below /////////
    $dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
    
    $count=$dbo->prepare("DELETE FROM horario_trabajo WHERE id=:id");
    $count->bindParam(":id",$id_horario,PDO::PARAM_INT);
    $count->execute();
    echo "<script language='JavaScript'>window.parent.window.location = 'medicos'; </script>";
}





echo "<script language='JavaScript'>alert('Horario Guardado Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'medicos'; </script>";

?>