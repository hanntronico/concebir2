<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = './'; </script>";
	exit();
}


$conexion = new ConexionBd();

// Select ubi._pk_ubicacion as ID, 
// 			 ubi.nombre as nom, 
// 			 ubi.sigla 
// from ubicaciones ubi 
// order by ubi.nombre asc;

$consul1="
	ubi._pk_ubicacion, ubi.nombre, ubi.sigla, 'no-image' as img
    ";
$consul2=" ubicaciones ubi";
$consul3=" ubi.nombre asc ";

// echo "SELECT ".$consul1." FROM ".$consul2." ORDER BY ".$consul3;
// exit();

// $strSelect,$strFrom,$strWhere=null,$strGroupBy=null,$strOrderBy=null
$arrresultado = $conexion->doSelect($consul1,$consul2,null, null, $consul3);

	$divsedes .= '
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
		<style>
			.img-sede {
				position: relative;
				border-radius: 4px;
				box-shadow: 10px 10px 15px #08190a2e;
			}
			
			.btn-animation{
				border-radius: 20px;
				background: white; 
				padding: 0 20px;
				height: 30px;
				margin: 10px;
				box-shadow: 1px 1px 10px #fff;
				color: green;
				transition: all ease-in-out .3s;
				border: 1px solid #8080804a;

				display: flex;
				justify-content: space-around;
				align-items: center;
				transition: all ease-in-out .2s;
				position: absolute;
				bottom: 0;
				left: 0;
			  }
			  .btn-animation i, .btn-animation h5{
				transition: all ease-in-out .1s;
			  }
			  .btn-animation:hover{
				background: #3f51b5;
			  }
			  .btn-animation:hover h5 {
				transform: scale(0);
				
			  }
			  
			  .btn-animation:hover i{
				right: 43%;
				position: absolute;
				color: white !important;
			  }
		</style>
	</head>
	
	';

// echo json_encode($arrresultado);
// exit();

$animation_delay = 2;
foreach($arrresultado as $i=>$valor){
// _pk_ubicacion, nombre, sigla
	$ubi_id = utf8_encode($valor["_pk_ubicacion"]);
	$ubi_nombre = utf8_encode($valor["nombre"]);
	$ubi_siglas = utf8_encode($valor["sigla"]);
	$ubi_img = utf8_encode($valor["img"]);
	// exit();

	if ($ubi_img=="no-image"){$ubi_img="0.jpg";}

	$divsedes .= "
		<div class='col-md-4 col-sm-6' style='margin-top: 30px; display: flex; justify-content: center;'>
			<a href='buscar-medicos?s=$ubi_id' class='animate__animated animate__fadeInTopRight' style='animation-delay: .".$animation_delay."s;'>
				<img src='arch/".$ubi_img."' class='img-sede' style='width: auto; max-height: 180px;' alt='$ubi_nombre' title='$ubi_nombre'>
				<div class='btn-animation'>
					<h5 class='sede-nombre'>$ubi_nombre &nbsp;</h5>
					<i class='fa fa-angle-double-right' style='color: green;'></i>
				</div>
				
			</a>
		</div>
	";
	$animation_delay++;

}


require_once "views/filtrosedes.php";

?>