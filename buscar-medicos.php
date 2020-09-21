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

(isset($_GET['e'])) ? $getespecialidad=$_GET['e'] :$getespecialidad='';
(isset($_GET['s'])) ? $getsede=$_GET['s'] :$getsede='';


$conexion = new ConexionBd();

if ($getespecialidad!=""){
	$whereespecialidad = " and usuarioespecialidad.usuario_id = '$getespecialidad' ";

	$arrresultado = $conexion->doSelect("
		especialidad.especialidad_id, especialidad.especialidad_nombre, especialidad.especialidad_codigoexterno, 
		especialidad.especialidad_img, especialidad.especialidad_activo, 
		especialidad.especialidad_eliminado, 
		DATE_FORMAT(especialidad.especialidad_fechareg,'%d/%m/%Y %H:%i:%s') as especialidad_fechareg	
	    ",
		"especialidad				
		",
		"especialidad_activo = '1' and especialidad.especialidad_id = '$getespecialidad'");
	foreach($arrresultado as $i=>$valor){

		$especialidad_id = utf8_encode($valor["especialidad_id"]);
		$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
		$especialidad_codigoexterno = utf8_encode($valor["especialidad_codigoexterno"]);
		$especialidad_img = utf8_encode($valor["especialidad_img"]);
		$especialidad_activo = utf8_encode($valor["especialidad_activo"]);
		$especialidad_fechareg = utf8_encode($valor["especialidad_fechareg"]);	

		$titulo = "<br><span style='font-weight: 600'>Especialidad:</span> <span style='font-weight:400'>$especialidad_nombre</span>";

	}

	$arrresultado = $conexion->doSelect("
	usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg,
	usuario_precio	
    ",
	"usuario	
		inner join usuarioespecialidad on usuarioespecialidad.usuario_id = usuario.usuario_id		
	",
	"usuario_activo = '1' and perfil_id = '2' and usuarioespecialidad_activo = '1' and usuarioespecialidad.especialidad_id = '$getespecialidad' ");

}
elseif ($getsede!=""){

	$wheresede= " and usuariosede.usuario_id = '$getsede' ";

	// $consulta1 = "
	// 	sede.sede_id, sede.sede_nombre, sede.sede_nombrecorto, 
	// 	sede.sede_img, sede.sede_activo, 
	// 	sede.sede_eliminado
	//     ";
	// $consulta2 = " sede ";
	// $consulta3 = " sede_activo = '1' and sede_id = '$getsede' ";


	$consulta1 = " ubi._pk_ubicacion, 
			  ubi.nombre, 
			  ubi.sigla ";
	$consulta2 = " ubicaciones ubi ";
	$consulta3 = " ubi._pk_ubicacion = '$getsede'";

	// echo "Select ".$consulta1." from ".$consulta2." where ".$consulta3;
	// exit();

	$arrresultado = $conexion->doSelect($consulta1,$consulta2,$consulta3);

	foreach($arrresultado as $i=>$valor){

		$sede_id = utf8_encode($valor["_pk_ubicacion"]);
		$sede_nombre = utf8_encode($valor["nombre"]);
		// $sede_img = utf8_encode($valor["sede_img"]);
		// $sede_activo = utf8_encode($valor["sede_activo"]);

		$titulo = "<br><span style='font-weight: 600'>Sede:</span> <span style='font-weight:400'>$sede_nombre</span>";

	}




	$arrresultado = $conexion->doSelect("
	usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg
    ",
	"usuario	
		inner join usuariosede on usuariosede.usuario_id = usuario.usuario_id		
	",
	"usuario_activo = '1' and perfil_id = '2' and usuariosede_activo = '1' and usuariosede.sede_id = '$getsede' ");


}

else{


	$arrresultado = $conexion->doSelect("
	usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg, 
	usuario_precio
    ",
	"usuario			
	",
	"usuario_activo = '1' and perfil_id = '2'");

}




$divmedicos .= '	
<head>
	<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
	/>

	<style>
		.card-medical {

			background: #FFF;
			padding: 30px 20px;
			// border: 1px solid;
			width: 100%;
			max-width: 400px;
			height: 500px;
			border-radius: 5px; 
			box-shadow: 10px 10px 20px #00000012;

		}

		.btn-medical button {
			width: 100%;
			border-radius: 20px;
		}
		.btn-reserved button i {
			transition: all ease-in-out .2s;
		}

		.btn-reserved button {
			transition: all ease-in-out .2s;
			background: #76ce81 !important;
			color: white !important;
			border: none;
			box-shadow: 0px 11px 10px #0000001f;
		}

		.btn-more-information button {
			border: none;
			margin-top: 10px;
		}

		.btn-animation, .btn-animation i, .btn-animation span{
			display: flex;
			justify-content: center;
			align-items: center;
			transition: all ease-in-out .2s;
			position: relative;
		  }
		  .btn-animation:hover {
			  transform: translateY(3px);
			  box-shadow: none;
		  }
		  .btn-animation:hover span {
			transform: scale(0);
		  }
		  
		  .btn-animation:hover i{
			right: 48%;
			position: absolute;
		  }




	</style>
</head>
	
';

// echo json_encode($arrresultado);
// echo "<pre>";
// print_r($arrresultado);
// echo "</pre>";
// exit();


$animation_delay = 2;
foreach($arrresultado as $i=>$valor){

	$usuario_id = utf8_encode($valor["usuario_id"]);

	$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
	$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
	$usuario_email = utf8_encode($valor["usuario_email"]);
	$usuario_clave = utf8_encode($valor["usuario_clave"]);
	$usuario_dni = utf8_encode($valor["usuario_dni"]);
	$usuario_celular = utf8_encode($valor["usuario_celular"]);
	$usuario_img = utf8_encode($valor["usuario_img"]);
	$perfil_id = utf8_encode($valor["perfil_id"]);
	$usuario_activo = utf8_encode($valor["usuario_activo"]);
	$usuario_precio = utf8_encode($valor["usuario_precio"]);
	$usuario_fechareg = utf8_encode($valor["usuario_fechareg"]);

	if ($usuario_precio==""){$usuario_precio=0;}

	$usuario_precio = number_format($usuario_precio,2,",","."). " PEN";

	if ($usuario_img==""){$usuario_img="1.png";}

	$divmedicos .= "
		<div class='col-md-4 col-sm-6 col-xs-12' style='margin: 20px 0 40px 0; display: flex; justify-content: center;'>
		    <div class='card-medical animate__animated animate__flipInX' style='animation-delay: .".$animation_delay."s;'>              
				<div class='row'>
					
		        <div class='col-sm-12'>
		        	<div style='height: 200px; display: flex; justify-content: center;'>
			            <a href='medico?e=5&id=$usuario_id'>
			              <img src='arch/$usuario_img' style='max-width: 100%; max-height: 200px; border-radius: 50%; box-shadow: 3px 11px 16px #1f4e3626;' alt='$usuario_nombre $usuario_apellido' title='$usuario_nombre $usuario_apellido'>
			            </a>	
		            </div>
				</div>
						

		        <div class='col-sm-12'>
		          <a href='medico?e=5&id=$usuario_id'>
		            <h4 style='font-size: 22px; text-align: center; padding: 20px 0;'>$usuario_nombre $usuario_apellido</h4>
		          </a>
		          <hr>
		          <div class='row'>
		            <div class='col-sm-12' style='margin-top: 10px'>
		              <a href='reservar?e=5&id=$usuario_id' class='btn-medical btn-reserved'>
						<button type='button' class='btn btn-primary btn-animation' style='font-size: 17px'>
						 <span style='margin-right: 8px;'>Reservar</span>
						 <i class='fa fa-calendar' style='color: white !important;'></i>
						</button>
		              </a>
		            </div>
		            <div class='col-sm-12' style='margin-top: 10px'>
		              <a href='medico?e=5&id=$usuario_id' class='btn-medical btn-more-information'>
						<button type='button' class='btn btn-success btn-animation' style='font-size: 17px'>
						<span style='margin-right: 8px;'>Ver Más</span>
						<i class='fa fa-list'></i>
						</button>
		              </a>
		            </div>
		            
		          </div>
						</div>
						

		      </div>
		    </div>
		   
		  </div>
	";

	$animation_delay++;

}

// $divmedicos .= '<head>
// <link
// rel="stylesheet"
// href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
// />
// </head>';



require_once "views/buscar-medicos.php";

?>

