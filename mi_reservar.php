<?php
include_once 'lib/config.php';


session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];
$divhoras= "";



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


if ($gethorario!=""){
	$valortextmes=$gethorario;
	$existehorario = 1;
}else{
	$valortextmes="";

}



$conexion = new ConexionBd();


/*********************************************************************************************

	
El horario1Lunes admite solo campos binarios, 1 si esta disponible y 0 si no esta disponible, cada 1 y 0 toma como marco de tiempo la horamodulo, por ejemplo en un registro como el siguiente 

11000

Y con un valor de horamodulo de 10

Quiere decir que el profesional esta libre 20 minutos a partir de horadesde en el campo profesionales2

En la tabla ubicacion1Lunes cada valor corresponde al campo pk_ubicacion de la tabla ubicaciones

Es decir si lleva un registro como cc00 teniendo en cuenta que el pk_ubicacion c corresponde a la sede primavera y el pk_ubicacion 0 corresponde a san isidro y el horario1Lunes tiene los campos 111100 significa que el profesional atiende 20 mins en Primavera luego 20 mins adicionales en san isidro

Ya estamos jalando horamodulo, horariodesde, horariohasta 
1er paso:
Considerar que el horario1lunes es solo el siguiente registro

Datos para prueba bloque pedro:
$horario1Lunes= 1 ()
Y ubicacion1Lunes es 0 (san isidro)

Bloque Pedro{

Es decir mostrar el primer bloque disponible de san isidro y comprobarlo con citas2 si tiene    una cita en ese bloque, para el dr noriega seria comprobar si a las 8:00 no hay una cita en la fecha q seleccione el paciente. Sera una funcion que toamra como argumentos $horario1Lunes y $ubicacion1Lunes, considerar que cada argumento se le enviara a la funcion solo 1 caracter
Y retornara como input el echo “divhorario.”= “codigohtml”

Y mostrara el bloque en verde y blanco si esta disponible y si no lo esta simplemente no lo mostrara es decir divhorario.”= “vacio”


**********************************************************************************************/



$arrubica1lunes   = array(0,0,0,0,0,0);
$arrhorario1lunes = array(1,1,1,1,1,1,1,1,0,0);



		$qry1=" horadesde, horahasta, horamodulo ";
		$qry2=" profesionales2 ";
		// $consul3=" _pk_doctor = '$getmedico'";
		$qry3=" _pk_doctor = 'PRO000000014'";

		$arrresultado = $conexion->doSelect($qry1,$qry2,$qry3);

		foreach($arrresultado as $i=>$valor){
			$horadesde=utf8_encode($valor["horadesde"]);
	    $horahasta=utf8_encode($valor["horahasta"]);
	    $horamodulo=utf8_encode($valor["horamodulo"]);
		}

		$segundos_horaInicial=strtotime($horadesde);
    $segundos_horafinal = strtotime($horahasta);
		$minuto_modulo = date("i",strtotime($horamodulo));
		$horasiguiente = $segundos_horaInicial+(date("i",strtotime($horamodulo))*60);
		$x=0;
		while( $segundos_horaInicial <= $segundos_horafinal  ){
			$vectorhorariosprof[$x] = date("H:i", $segundos_horaInicial);
			$horasiguiente = $segundos_horaInicial+(date("i",strtotime($horamodulo))*60);
			$segundos_horaInicial = $horasiguiente;
			$mostrar_horario=date("H:i", $segundos_horaInicial);
			$x++;
		}

		// echo count($vectorhorariosprof);
		// echo count($arrubica1lunes);
		// echo count($arrhorario1lunes);
		// exit();


// cc00
// 111100

// 1111111111111111111           0000000000000
// 1111111111111111111111111111111111111111111111111111111111111111111111111111111000000000000000000000

		

		// $y=0;
		// while($y<count($arrhorario1lunes)){
		// 		if ($arrhorario1lunes[$y]==1) {
		// 			echo "disponible"."<br>";
					
		// 			$z=0;
		// 			while ($z < count($arrubica1lunes)) {
		// 				echo "ubicacion disp: ".$arrubica1lunes[$z]."|";


		// 				$z++;	
		// 			}	
		// 			echo "<br>";
		// 		}else{
		// 			echo "ocupado"."<br>";
		// 		}
		// 	$y++;
		// }

		// $blkubica; // 0 clinica isidro
		// $horario1Lunes; // 1 disponible

		// if ($blkubica=="0" && $horario1Lunes=="1") {

		// }




// print_r($vectorhorariosprof);
// exit();


// echo "<pre>";
// print_r($arrresultado);
// echo "</pre>";
// exit();

function horariocitas($horario1lunes, $ubicacion1Lunes, $vector)
{
	$conexion = new ConexionBd();
	if ($horario1lunes==1) {
  	echo "disponible"."<br>";
		echo "ubicacion disp: ".$ubicacion1Lunes;
		echo "<br>";
		// if ($ubicacion1Lunes) {

		$qrya1=" horaInicio ";
		$qrya2=" citas2 ";
		// $consul3=" _pk_doctor = '$getmedico'";
		$qrya3=" _fk_medicoTratante = 'PRO000000014' and _fk_Fecha = '2020-09-09'";

		$arrresultado = $conexion->doSelect($qrya1,$qrya2,$qrya3);

		// echo count($arrresultado);

		$xx=0;
		while ( $xx < count($vector)) {
			echo $vector[$xx]." - ".strtotime($vector[$xx])."<br>";
			$xx++;	
		}


		// echo "<pre>";
		// print_r($arrresultado);
		// echo "</pre>";

		// }
	}else{
		echo "ocupado"."<br>";
	}

}







horariocitas(1,0, $vectorhorariosprof);

exit();



/*********************************************************************************************/










$ccquery1="
	usuario.usuario_id, _pk_doctor, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
	usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
	usuario.usuario_eliminado, usuario.usuario_idreg,
	DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg, usuario_precio
    ";
$ccquery2="usuario				
	";
$ccquery3="usuario_activo = '1' and perfil_id = '2' and usuario._pk_doctor = '$getmedico'";

// echo "select".$ccquery1." from ".$ccquery2." where ".$ccquery3;
// exit();

$arrresultado = $conexion->doSelect($ccquery1,$ccquery2,$ccquery3);

foreach($arrresultado as $i=>$valor){

	$usuario_id = utf8_encode($valor["usuario_id"]);
	$pk_doctor = utf8_encode($valor["_pk_doctor"]);
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


// echo "<pre>";
// print_r($arrresultado);
// echo "</pre>";
// exit();
	$consul1=" horadesde, horahasta, horamodulo
	    ";
	$consul2=" profesionales2			
	";
	$consul3=" _pk_doctor = '$getmedico'";
 
	// echo "Select ".$consul1." from ".$consul2." Where ".$consul3;
	// exit();

	$arrresultado = $conexion->doSelect($consul1,$consul2,$consul3);

$horadesde="";
$horahasta="";
$horamodulo="";

	
	foreach($arrresultado as $i=>$valor){
	  $horadesde=utf8_encode($valor["horadesde"]);
    $horahasta=utf8_encode($valor["horahasta"]);
    $horamodulo=utf8_encode($valor["horamodulo"]);



		$x=0;
    
  //  	$segundos_horaInicial=strtotime($horadesde);
  //  	$horafinal = date("H:i",$segundos_horaInicial);
		// $horaactual= $horadesde->format('H:i');

		// $horaactual = date('s', $horadesde);
		// $horamax = date('s', $horahasta);


		// $horadif= $horamax-$horaactual;
		// //echo $horadif;
		// //exit;
		// $horabloque= date('s', $horamodulo);
		// //echo $horabloque;
		// //exit;
		// $horamodulo= 10;
		// $tiempos = 60 / $horamodulo;

		// //$tiempos = 60 / $horabloque;
		// echo $tiempos;
		// exit();
		// //echo $horaactual;
		// //exit;


// while($horaactual<= 21)
// {
//     $cc=0;
//     $cct=00;
//     while($cc <= $tiempos)
// 			{
// 		    $divhoras .= "
// 						<a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$horaactual'>
// 							<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>".$horaactual.":".$cct."</button>
// 						</a>
// 						";
// 			    $cc++;
// 				$cct+=$horabloque;
// 			}
// 	$horaactual++;
// }
	}

    

if ($getespecialidad!=""){
	$wherespecialidad = " and usuarioespecialidad.especialidad_id = '$getespecialidad' ";
}


$cquery1="
	especialidad.especialidad_id, especialidad_nombre, usuarioespecialidad_id, especialidad_consede
    ";
$cquery2=	" especialidad 
		inner join usuarioespecialidad on usuarioespecialidad.especialidad_id = especialidad.especialidad_id		
		and usuarioespecialidad.usuario_especialidad_fk = '$pk_doctor' and usuarioespecialidad_activo = '1'
	";
$cquery3=" especialidad_activo = '1' $wherespecialidad";

// echo "select ".$cquery1." from ".$cquery2." where ".$cquery3;
// exit();


$arrresultado = $conexion->doSelect($cquery1, $cquery2, $cquery3);







foreach($arrresultado as $i=>$valor){

	$especialidad_id = utf8_encode($valor["especialidad_id"]);
	$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);
	$usuarioespecialidad_id = utf8_encode($valor["usuarioespecialidad_id"]);	
	$especialidad_consede = utf8_encode($valor["especialidad_consede"]);		

	$divespecialidades .= "
		<a href='reservar?id=$pk_doctor&e=$especialidad_id'>
			<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border: none; border-radius: 20px; padding: 5px 27px; box-shadow: 5px 5px 10px #0000001f; outline: none;'>$especialidad_nombre </button>
		</a>
	";

}



if ($especialidad_id==$getespecialidad){
	$divespecialidades = "
		<a href='reservar?id=$pk_doctor'>
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

	    // $divhoras="";

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
				<a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id'>
					<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; padding: 5px 27px; margin-top: 20px; border-radius: 20px; outline: none;  background: #76ce81 !important; box-shadow: 0px 11px 10px #0000001f; border: none; color: white !important; '>$sede_nombre </button>
				</a>			
			";

		}


		if ($sede_id==$getsede){
			$divsedes = "
				<a href='reservar?id=$pk_doctor&e=$especialidad_id'>
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




 


// $x=0;
// $horaInicial="09:00";
// $minutoAnadir=10;

// while( $x <= 53 ){
// 	$segundos_horaInicial=strtotime($horaInicial);
// 	$segundos_minutoAnadir=$minutoAnadir*60;
// 	$arrHorarioList[$x] = date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
// 	$horaInicial = $arrHorarioList[$x];
// 	$x++;
// }
// $arrHorarioList= json_encode($arrHorarioList);
// $numcharactersArrHorarioList= strlen($arrHorarioList);
// $arrHorarioList= substr($arrHorarioList,1, 6);
// //$arrHorarioList= substr($arrHorarioList,0);

// $arrHorarioList=preg_replace("/[,]/", "", $arrHorarioList);
// $arrHorarioList=preg_replace('/["]/', "", $arrHorarioList);

//echo "<pre>";
//print($arrHorarioList);
//echo "</pre>";

//exit();

   // $arrHorarioList= array("9:10", "9:20", "8:30", "8:40", "8:50", "9:00", "9:10", "...");



if ($existeespecialidad=="1" && $existesede=="1"){



	$wherehorario="";
	if ($especialidad_consede=="1"){
		//$wherehorario = "and horario.sede_id = '$getsede' ";
	}


	if ($gethorario!=""){
		$wherehorario .= "and horario._pk_horario = '$gethorario' ";
	}



	$displayfechas  ="";


	$consul1="
		 horario._pk_horario, horario._fk_doctor,  
		DATE_FORMAT(fechaInicio,'%d/%m/%Y') as horario_fecha,		
		DATE_FORMAT(horaInicio,'%H:%i') as horaini, 
		DATE_FORMAT(horaTermino,'%H:%i') as horafin, 
        horario1Lunes as horarioLunes,
		DATE_FORMAT(fechaFin,'%d/%m/%Y %H:%i:%s') as horario_fechareg
	    ";
	$consul2=" horario2 as horario			
	";
	$consul3=" horario._fk_doctor = '$getmedico'      
		 $wherehorario";

	// echo "Select ".$consul1." from ".$consul2." Where ".$consul3;
	// exit();

	$arrresultado = $conexion->doSelect($consul1,$consul2,$consul3);
		
	$horario_fecha= "No tiene fechas disponibles";


	// $divfecha = "";

		// echo "<pre>";
		// print_r($arrresultado);
		// echo "</pre>";
		// exit();

	foreach($arrresultado as $i=>$valor){

		$horario_id = utf8_encode($valor["horario_id"]);
		$horarioLunes= utf8_encode($valor["horarioLunes"]);
		$pk_horario= utf8_encode($valor["_pk_horario"]);
		$t_usuario_id = utf8_encode($valor["usuario_id"]);
		//$t_sede_id = utf8_encode($valor["sede_id"]);
//Use mb_substr to get the first character.
        
		$horario_activo = utf8_encode($valor["horario_activo"]);
		$horario_fecha = utf8_encode($valor["horario_fecha"]);	
		$horaini = utf8_encode($valor["horaini"]);	
		$horafin = utf8_encode($valor["horafin"]);	

		$horario_fechareg = utf8_encode($valor["horario_fechareg"]);
	//	$horario_intervalo = utf8_encode($valor["horario_intervalo"]);
	//	$sede_nombre = utf8_encode($valor["horario_fechareg"]);		
	
		$countChatHorarioLunes= strlen($horarioLunes);

	}

	// echo "<pre>";
	// print_r($arrresultado);
	// echo "</pre>";
	// exit();



	$vectorHorario = [];
	$vectorFecha = [];

/***************************************************************************/

// el fkecha, la horainicio de citas2 se usa para jalar el bloque que esta en rojo
// y la 

/***************************************************************************/







	$hquery1=" horaInicio, _fk_Fecha ";
	$hquery2=" citas2 ";
	$hquery3=" _fk_medicoTratante =  '$getmedico' order by 2 ";

	// echo "Select ".$hquery1." from ".$hquery2." where ".$hquery3;
	// exit();
	$arrresultado2 = $conexion->doSelect($hquery1, $hquery2, $hquery3);

	foreach ($arrresultado2 as $i => $valor) {
		$horainicio = utf8_encode($valor["horaInicio"]);
		$fkfecha = utf8_encode($valor["_fk_Fecha"]);
		$vectorHorario[$i]=$horainicio;
		$vectorFecha[$i]=$fkfecha;
	}


	// echo $arrresultado2[6]["horaInicio"]."<br>";

	// echo "<pre>";
	// print_r($arrresultado2);
	// echo "</pre>";
	// echo "<br>";
	// exit();


	$consul1=" horadesde, horahasta, horamodulo ";
	$consul2=" profesionales2 ";
	$consul3=" _pk_doctor = '$getmedico'";

	$arrresultado = $conexion->doSelect($consul1,$consul2,$consul3);


	foreach($arrresultado as $i=>$valor){
	  $horadesde=utf8_encode($valor["horadesde"]);
    $horahasta=utf8_encode($valor["horahasta"]);
    $horamodulo=utf8_encode($valor["horamodulo"]);

	}



		$x=0;
		$y=0;    
		// echo "horadesde: $horadesde -> ".
		$segundos_horaInicial=strtotime($horadesde);
		// echo "<br>";

    // echo "horahasta: $horahasta -> ".
        $segundos_horafinal = strtotime($horahasta);
		// echo "<br>";

		// echo 
		$minuto_modulo = date("i",strtotime($horamodulo));
		// echo "<br>";

		// echo 
		$horasiguiente = $segundos_horaInicial+(date("i",strtotime($horamodulo))*60);
		// echo "<br>";

		// echo date("H:i", $horasiguiente);
		// echo "<br>";

		// $horariovector=0;

if ($gethorario!="") {


		$horariovector="";
			while( $segundos_horaInicial < $segundos_horafinal  ){
				$horasiguiente = $segundos_horaInicial+(date("i",strtotime($horamodulo))*60);
				$segundos_horaInicial = $horasiguiente;
				// echo "hora final: ".$segundos_horafinal." - ".$segundos_horaInicial.": ".date("H:i", $segundos_horaInicial)."<br>";
				$mostrar_horario=date("H:i", $segundos_horaInicial);

				// echo date("H:i", $segundos_horaInicial)."<br>";
				$x++;
		
				// if ($arrresultado2[6]["horaInicio"]) {}

				// echo count($arrresultado2)."-";
				$y=0;
				$horariovector="";
				// $fkfecha="";
				$horariolink="";
				$estilolink="";

				while ( $y <= count($arrresultado2) ) {

					// if ( $arrresultado2[$y]["horaInicio"] == $mostrar_horario ) {
					if (  trim(strtotime($arrresultado2[$y]["horaInicio"])) == trim($segundos_horaInicial)  ) {
						// $horariolink = "reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$pk_horario";
						// $estilolink = "btn btn-success";
						// $horariovector=$arrresultado2[$y]["horaInicio"];
						// $horariovector=$horariovector.strtotime($arrresultado2[$y]["horaInicio"]).",";
						$horariovector.=$arrresultado2[$y]["horaInicio"];

					}else{
						// $horariolink="#";
						// $estilolink = "btn btn-danger"; 
					// 	$horariovector=$arrresultado2[$y]["horaInicio"];
					}

					$y++;
				
				}


				if ($horariovector=="") {
					$horariolink = "reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$gethorario";
					$estilolink = "btn btn-success";
				}else{
					// $horariolink="#";
					$horariolink="javascript:;";
					$estilolink = "btn btn-danger"; 					
				}


    	$divhoras .= "
				<a href='$horariolink' style='text-decoration:none;'>
					<button type='button' class='$estilolink' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>
					 $mostrar_horario </button>
				</a>
				";

			$divhoras2 .= "
				<a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$gethorario' style='text-decoration:none;'>
					<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>
					 $mostrar_horario </button>
				</a>
				";	

			}
	}


/*******************  garbage.php   *********************************/



}







// if ($horario_fecha== "No tiene fechas disponibles"){

// }
// else
// {
	if ($existeespecialidad=="1" && $existesede=="1" & $existehorario =="1"){
	// if ($existeespecialidad=="1" && $existesede=="1"){

		// echo $valortextmes."<br>";
		// echo count($arrresultado2)."<br>";

		
		$ii=0;
		$countsi=0;
		$countno=0;

		while ($ii <= count($arrresultado2)) {
			// echo $arrresultado2[$ii]["_fk_Fecha"]."<br>";
			if ( trim(strtotime($arrresultado2[$ii]["_fk_Fecha"])) == trim(strtotime($valortextmes)) ) {
				$countsi=$countsi+1;
			}else{
				$countno=$countno+1;
				// echo "no";
			}
			$ii++;
		}

		if ($countsi>0) {
			// echo "<script language='JavaScript'>alert('Fecha encontrada: ".$valortextmes."');</script>";
		
		}else{
			$divhoras="";

			if ($divhoras=="") {
				$divhoras=$divhoras2;
			}
					// $horariolink = "reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$gethorario";
					// $estilolink = "btn btn-success";

		}







    //	$x++;
   // }

    // if ($arrHorarioList<=$horahasta) {
    // 	echo "horario menor a la horahasta";
    // }








			$displayhorarios  ="";












		// $displayhorarios  ="";

		// if ($horario_intervalo=="" || $horario_intervalo=="0"){$horario_intervalo=20;}


		// $var1 = $horaini;
		// $var2 = $horafin;	

		// $fechaInicio = new DateTime($var1);
		// $fechaFin = new DateTime($var2);
		// $fechaFin = $fechaFin->modify( "+$horario_intervalo minutes"); 

		// $rangoFechas = new DatePeriod($fechaInicio, new DateInterval('PT15M'), $fechaFin);

		// foreach($rangoFechas as $fecha){
		//     $hora = $fecha->format("H:i") . PHP_EOL;

		//     $divhoras .= "	    	
		// 		<a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$pk_horario&i=$hora' style='margin-right: 10px; margin-bottom: 10px'>
		// 			<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; margin-top: 10px; padding: 5px 27px; border-radius: 20px; outline: none; box-shadow: 5px 5px 10px #0000001f; border: none;'>$hora </button>
		// 		</a>

		// 	";

		// }

		// if ($getintervalo!=""){
		// 	$hora = $getintervalo;
		// 	$divhoras = "	    	
		// 		<a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$pk_horario' style='margin-right: 10px; margin-bottom: 10px'>
		// 			<button type='button' class='btn btn-warning' style='font-size: 17px; cursor: pointer; margin-top: 10px; padding: 5px 27px; border: none; border-radius: 20px; outline: none; box-shadow: 5px 5px 10px #0000001f;'><i class='fa fa-times'></i> $hora </button>
		// 		</a>

		// 	";

		// 	$displayconfirmar  ="";
		// }


	// }


}

// echo $divhoras;	


require_once "views/reservar.php";

?>