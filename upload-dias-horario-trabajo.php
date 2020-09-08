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

// echo "post ";
// var_dump($_POST);
$conexion = new ConexionBd();

(isset($_POST['dia_id'])) ? $dia_id=$_POST['dia_id'] : $dia_id='';

(isset($_POST['horaini'])) ? $horaini=$_POST['horaini'] : $horaini='';
(isset($_POST['horafin'])) ? $horafin=$_POST['horafin'] : $horafin='';
(isset($_POST['dia'])) ? $dia=$_POST['dia'] : $dia='';
(isset($_POST['id_horario'])) ? $id_horario=$_POST['id_horario'] : $id_horario='';

(isset($_GET['type'])) ? $type=$_GET['type'] : $type='';

if($type==''){
    
    if($dia_id == ''){
        // echo "add";
       $resultado = $conexion->doInsert("
        	 `horario_trabajo_dias`(`dia`, `inicio_hora`, `fin_hora`, `id_horario_trabajo`)
        	",
        	"$dia, '$horaini', '$horafin', '$id_horario'");
    
    }
    else{
        // echo "edit";
        $resultado = $conexion->doUpdate("horario_trabajo_dias", "
        		dia ='$dia',
        		inicio_hora ='$horaini',
        		fin_hora ='$horafin',
        		id_horario_trabajo='$id_horario'
        		",
        		"id='$dia_id'");
    }

}else{
    
    (isset($_GET['dia_id'])) ? $dia_id=$_GET['dia_id'] : $dia_id='';
    $host_name = N;
    $database = E; // Change your database name
    $username = M;          // Your database user id 
    $password = R;          // Your password
    
    //////// Do not Edit below /////////
    $dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
    
    $count=$dbo->prepare("DELETE FROM horario_trabajo_dias WHERE id=:id");
    $count->bindParam(":id",$dia_id,PDO::PARAM_INT);
    $count->execute();
    echo "<script language='JavaScript'>alert('Se elimino Correctamente');</script>";
    echo "<script language='JavaScript'>window.parent.window.location = 'horario-trabajo-dias?id=$id_horario'; </script>";

}




echo "<script language='JavaScript'>alert('Dia Guardado Correctamente');</script>";
echo "<script language='JavaScript'>window.parent.window.location = 'horario-trabajo-dias?id=$id_horario'; </script>";

?>