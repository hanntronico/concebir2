<?php
include_once 'lib/config.php';

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

$xajax->registerFunction('confirmarreserva');

if ($iniuser==""){
	echo "<script language='JavaScript'>alert('Error: No se encuentra conectado al sistema, por favor inicie sesion nuevamente');</script>";
	echo "<script language='JavaScript'>window.location = './'; </script>";
	exit();
}

(isset($_GET['id'])) ? $getmedico=$_GET['id'] :$getmedico='';
(isset($_GET['e'])) ? $getespecialidad=$_GET['e'] :$getespecialidad='';
(isset($_GET['s'])) ? $getsede=$_GET['s'] :$getsede='';
(isset($_GET['h'])) ? $gethorario=$_GET['h'] :$gethorario ='';
(isset($_GET['i'])) ? $getintervalo=$_GET['i'] :$getintervalo ='';




$conexion = new ConexionBd();

$arrresultado = $conexion->doSelect("
	usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg, usuario_precio
    ",
	"usuario				
	",
	"usuario_activo = '1' and perfil_id = '2' and usuario.usuario_id = '$getmedico'");
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
	$usuario_fechareg = utf8_encode($valor["usuario_fechareg"]);
	$usuario_precio = utf8_encode($valor["usuario_precio"]);

	if ($usuario_precio==""){$usuario_precio=0;}

	$usuario_precio = number_format($usuario_precio,2,",","."). " PEN";

	if ($usuario_img==""){$usuario_img="1.png";}

}

if ($getespecialidad!=""){
	$wherespecialidad = " and usuarioespecialidad.especialidad_id = '$getespecialidad' ";
}

$arrresultado = $conexion->doSelect("
	especialidad.especialidad_id, especialidad_nombre, usuarioespecialidad_id, especialidad_consede
    ",
	"especialidad 
		inner join usuarioespecialidad on usuarioespecialidad.especialidad_id = especialidad.especialidad_id		
		and usuarioespecialidad.usuario_id = '$usuario_id' and usuarioespecialidad_activo = '1'
	",
	"especialidad_activo = '1' $wherespecialidad");

foreach($arrresultado as $i=>$valor){

	$especialidad_id = utf8_encode($valor["especialidad_id"]);
	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$usuarioespecialidad_id = utf8_encode($valor["usuarioespecialidad_id"]);	
	$especialidad_consede = utf8_encode($valor["especialidad_consede"]);		

	$divespecialidades .= "
		<a href='reservar?id=$usuario_id&e=$especialidad_id'>
			<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border: none; border-radius: 20px; padding: 5px 27px; box-shadow: 5px 5px 10px #0000001f; outline: none;'>$especialidad_nombre </button>
		</a>
	";

}

if ($especialidad_id==$getespecialidad){
	$divespecialidades = "
		<a href='reservar?id=$usuario_id'>
			<button type='button' class='btn btn-warning' style='font-size: 17px; cursor: pointer; border: none; border-radius: 20px; padding: 5px 27px; box-shadow: 5px 5px 10px #0000001f; outline: none;'><i class='fa fa-times'></i> $especialidad_nombre </button>
		</a>
	";	

	$existeespecialidad = 1;
}

if ($divespecialidades==""){
	$divespecialidades= "
		<div class='alert alert-warning' style='text-align: center; font-weight: normal;'>
            <a style='color: #000; font-size: 14px; text-decoration: none;'>
                No tiene especialidades cargadas
            </a><br>
        </div>

	";
}

$displaysedes = " style = 'display: none' ";
$displayfechas = " style = 'display: none' ";
$displayhorarios = " style = 'display: none' ";
$displayconfirmar = " style = 'display: none' ";
	    $fechass="1";

if ($existeespecialidad=="1"){

	if ($especialidad_consede=="1"){

		$displaysedes = "";

		if ($getsede!=""){
			$wheresede = " and usuariosede.sede_id = '$getsede' ";
		}

		$arrresultado = $conexion->doSelect("
			sede.sede_id, sede_nombre, usuariosede_id
		    ",
			"sede 
				inner join usuariosede on usuariosede.sede_id = sede.sede_id		
				and usuariosede.usuario_id = '$usuario_id' and usuariosede_activo = '1'
			",
			"sede_activo = '1' $wheresede");

		foreach($arrresultado as $i=>$valor){

			$sede_id = utf8_encode($valor["sede_id"]);
			$sede_nombre = utf8_encode($valor["sede_nombre"]);
			$usuariosede_id = utf8_encode($valor["usuariosede_id"]);

			$divsedes .= "
				<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id'>
					<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; padding: 5px 27px; margin-top: 20px; border-radius: 20px; outline: none;  background: #76ce81 !important; box-shadow: 0px 11px 10px #0000001f; border: none; color: white !important; '>$sede_nombre </button>
				</a>			
			";

		}


		if ($sede_id==$getsede){
			$divsedes = "
				<a href='reservar?id=$usuario_id&e=$especialidad_id'>
					<button type='button' class='btn btn-warning' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 0px 11px 10px #0000001f; padding: 5px 27px;'><i class='fa fa-times'></i> $sede_nombre </button>
				</a>
			";	

			$existesede = 1;
		}

		if ($divsedes==""){
			$divsedes= "
				<div class='alert alert-warning' style='text-align: center; font-weight: normal;'>
		            <a style='color: #000; font-size: 14px; text-decoration: none;'>
		                No tiene sedes cargadas
		            </a><br>
		        </div>

			";
		}

	}else{
		$existesede = 1; //
	}

}



if ($existeespecialidad=="1" && $existesede=="1"){

	if ($especialidad_consede=="1"){
		$wherehorario = "and horario.sede_id = '$getsede' ";
	}


	if ($gethorario!=""){
		$wherehorario .= "and horario.horario_id = '$gethorario' ";		
	}

	$displayfechas  ="";

	$arrresultado = $conexion->doSelect("
		horario.horario_id, horario.usuario_id, horario.sede_id,  
		horario_activo, horario_eliminado, horario.usuario_idreg,
		DATE_FORMAT(horario_fecha,'%d/%m/%Y') as horario_fecha,		
		DATE_FORMAT(horario_horaini,'%H:%i') as horaini, 
		DATE_FORMAT(horario_horafin,'%H:%i') as horafin, 
		horario_intervalo,

		DATE_FORMAT(horario_fechareg,'%d/%m/%Y %H:%i:%s') as horario_fechareg, 
		sede_nombre
	    ",
		"horario
			inner join sede on sede.sede_id = horario.sede_id		
		",
		"horario_activo = '1'  and horario.usuario_id = '$getmedico' $wherehorario");
		$horario_fecha= "No tiene fechas disponibles";
	foreach($arrresultado as $i=>$valor){

		$horario_id = utf8_encode($valor["horario_id"]);
		$t_usuario_id = utf8_encode($valor["usuario_id"]);
		$t_sede_id = utf8_encode($valor["sede_id"]);

		$horario_activo = utf8_encode($valor["horario_activo"]);
		$horario_fecha = utf8_encode($valor["horario_fecha"]);	
		$horaini = utf8_encode($valor["horaini"]);	
		$horafin = utf8_encode($valor["horafin"]);	
		$horario_fechareg = utf8_encode($valor["horario_fechareg"]);
		$horario_intervalo = utf8_encode($valor["horario_intervalo"]);
		$sede_nombre = utf8_encode($valor["horario_fechareg"]);		

		$divfecha .= "
			<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id&h=$horario_id'>
				<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>$horario_fecha </button>
			</a>			
		";
		/*
		$_old_divfecha .="
		<div class='row'>
	      <div class='col-md-3' style='font-size: 20px'>
	        <label style='font-size: 20px'>Fecha:</label>
	        $horario_fecha
	      </div>
	      <div class='col-md-6' style='font-size: 20px'>
		      <a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id&h=$horario_id' style='color: green; cursor: pointer' title='Seleccionar'>
		        <label style='font-size: 20px'>Horario:</label>
		        $horaini - $horafin  
		        <i class='fa fa-check-circle'></i>
	        </a>
	      </div> 
	      <div class='col-md-3' style='font-size: 20px'>
	       
	      </div>                     
	    </div>
		";

		*/

	}

	if ($horario_id==$gethorario){
		$divfecha = "
			<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id'>
				<button type='button' class='btn btn-warning' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none; padding: 5px 27px; outline: none; box-shadow: 0px 11px 10px #0000001f;'><i class='fa fa-times'></i> $horario_fecha </button>
			</a>
		";	

		$existehorario = 1;
	}

	if ($divfecha==""){
	    $fechass="0";
		$divfecha= "
			<div class='alert alert-warning' style='text-align: center; font-weight: normal;'>
	            <a style='color: #000; font-size: 14px; text-decoration: none;'>
	                No tiene fechas cargadas
	            </a><br>
	        </div>

		";
	}

}
$divhoras= "";
	if ($horario_fecha== "No tiene fechas disponibles"){

}
else
{
if ($existeespecialidad=="1" && $existesede=="1" & $existehorario =="1"){

	$displayhorarios  ="";

	if ($horario_intervalo=="" || $horario_intervalo=="0"){$horario_intervalo=20;}


	$var1 = $horaini;
	$var2 = $horafin;	

	$fechaInicio = new DateTime($var1);
	$fechaFin = new DateTime($var2);
	$fechaFin = $fechaFin->modify( "+$horario_intervalo minutes"); 

	$rangoFechas = new DatePeriod($fechaInicio, new DateInterval('PT15M'), $fechaFin);

	foreach($rangoFechas as $fecha){
	    $hora = $fecha->format("H:i") . PHP_EOL;

	    $divhoras .= "	    	
			<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id&h=$horario_id&i=$hora' style='margin-right: 10px; margin-bottom: 10px'>
				<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; margin-top: 10px; padding: 5px 27px; border-radius: 20px; outline: none; box-shadow: 5px 5px 10px #0000001f; border: none;'>$hora </button>
			</a>

		";

	}

	if ($getintervalo!=""){
		$hora = $getintervalo;
		$divhoras = "	    	
			<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id&h=$horario_id' style='margin-right: 10px; margin-bottom: 10px'>
				<button type='button' class='btn btn-warning' style='font-size: 17px; cursor: pointer; margin-top: 10px; padding: 5px 27px; border: none; border-radius: 20px; outline: none; box-shadow: 5px 5px 10px #0000001f;'><i class='fa fa-times'></i> $hora </button>
			</a>

		";

		$displayconfirmar  ="";
	}


}
}

require_once "views/reservar.php";

?>