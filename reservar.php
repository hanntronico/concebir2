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


	$divfecha = "";

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

		// while( $x <= 20  ){
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
					$horariolink = "reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$pk_horario";
					$estilolink = "btn btn-success";
				}else{
					$horariolink="#";
					$estilolink = "btn btn-danger"; 					
				}


    	$divhoras .= "
				<a href='$horariolink' style='text-decoration:none;'>
					<button type='button' class='$estilolink' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>
					 $mostrar_horario </button>
				</a>
				";

				// $divhoras .= "$x-$mostrar_horario - $horariovector.<br>";

		}


    // echo " ".$segundos_horafinal = $segundos_horafinal+strtotime($horamodulo);
    // exit();
    // echo $segundos_horafinal = $segundos_horafinal+(date("i",strtotime($horamodulo))*60);
    	// echo $horafinal = date("H:i",$segundos_horafinal);
    // exit();
    	// echo "<br>";
    	// echo $x."<br>";



    // 	$divhoras .= "
				// <a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$pk_horario'>
				// 	<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>desde las $horadesde hasta las $horahasta </button>
				// </a>
				// ";


	if ($pk_horario==$gethorario){
	/*	$divfecha = '
			<a href="reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id">
				<button type="button" class="btn btn-warning" style="font-size: 17px; cursor: pointer; border-radius: 20px; border: none; padding: 5px 27px; outline: none; box-shadow: 0px 11px 10px #0000001f;"><i class="fa fa-times"></i> $horario_fecha </button>
			</a>
			<table class="table-condensed table-bordered table-striped">
                <thead>
                    <tr>
                      <th colspan="7">
                        <span class="btn-group">
                            <a class="btn"><i class="icon-chevron-left"></i></a>
                        	<a class="btn active">February 2012</a>
                        	<a class="btn"><i class="icon-chevron-right"></i></a>
                        </span>
                      </th>
                    </tr>
                    <tr>
                        <th>Su</th>
                        <th>Mo</th>
                        <th>Tu</th>
                        <th>We</th>
                        <th>Th</th>
                        <th>Fr</th>
                        <th>Sa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="muted">29</td>
                        <td class="muted">30</td>
                        <td class="muted">31</td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                        <td>16</td>
                        <td>17</td>
                        <td>18</td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td class="btn-primary"><strong>20</strong></td>
                        <td>21</td>
                        <td>22</td>
                        <td>23</td>
                        <td>24</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                        <td>29</td>
                        <td class="muted">1</td>
                        <td class="muted">2</td>
                        <td class="muted">3</td>
                    </tr>
                </tbody>
            </table>
		';	*/

		// $existehorario = 1;
	}

			// if ($divfecha==""){
			//     $fechass="0";
			// 	$divfecha= "
			// 		<div class='alert alert-warning' style='text-align: center; font-weight: normal;'>
			//             <a style='color: #000; font-size: 14px; text-decoration: none;'>
			//                 No tiene fechas cargadas
			//             </a><br>
			//         </div>

			// 	";
			// }





	// $gethorario 




}



		// echo "existe ".$existeespecialidad." ".$existesede." ".$existehorario;
		// exit();

	// echo "<script> alert('"."existe ".$existeespecialidad." ".$existesede." ".$existehorario."') </script>";


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
			echo "<script language='JavaScript'>alert('Fecha encontrada: ".$valortextmes."');</script>";
		}



		// exit();
		// echo "</pre>";
		
		// exit();


		// echo "hann";
		// exit();
			// echo $pk_horario;
			// echo "<br>";
			// echo $horarioLunes;
			// echo "<br>";
			// echo $countChatHorarioLunes;
			// echo "<br>";

// $x=0;
// $horaInicial="09:00";
// $minutoAnadir=10;
// echo "pk_doctor: ".$pk_doctor; exit();




      // $segundos_horafinal = strtotime($horafinal);
    	// echo " ".$segundos_horafinal = $segundos_horafinal+strtotime($horamodulo);
    	// $segundos_horafinal = $segundos_horafinal+(date("i",strtotime($horamodulo))*60);
    	// echo $horafinal = date("H:i",$segundos_horafinal);
    	// echo "<br>";
    	// echo $x."<br>";

    	// exit();



    //	$x++;
   // }

    // if ($arrHorarioList<=$horahasta) {
    // 	echo "horario menor a la horahasta";
    // }


	// echo "<pre>";
	// print_r($arrresultado);
	// echo "</pre>";
	// exit();


// while( $x <= 53 ){
// 	$segundos_horaInicial=strtotime($horaInicial);
// 	$segundos_minutoAnadir=$minutoAnadir*60;
// 	$arrHorarioList[$x] = date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
// 	$horaInicial = $arrHorarioList[$x];
// 	$x++;
// }


			$displayhorarios  ="";


			// $i=0;
			// while ( $i <= $countChatHorarioLunes ) {
			// 	// echo $i.": ".$horarioLunes[$i];
			// 	// echo "<br>";	
			// 	// $i++;

			// 	if ($horarioLunes[$i]=="1") {
			// 		echo $horarioLunes[$i].": disponible"."<br>";
			// 	// }elseif ($horarioLunes[$i]=="0") {
			// 	// 	echo "no disponible"."<br>";
			// 	}


			// }

			// exit();

			// $horarioL=""; 
			// $i=0;
			// $c=0;
			// $limit=0;
			// $arrCharHorarioLunes= array();
			// while($countChatHorarioLunes>$i)
			// {
			//     $c=$i+1;
			//     $arrCharHorarioLunes[$i] = mb_substr($horarioLunes, $i, $c, "UTF-8");
			// 		 //remover el caracter $i de $horarioLunes despues de esta linea
			// 		 //asignar el nuevo valor a horariolunes
		 
			//     if ($arrCharHorarioLunes[$i] =="0") {
			 
			    
			//    // $horarioL.= "8:10"." - ".$arrCharHorarioLunes[$i]."<br>";
			//     $limit= $c+5;
			//     $horarioL.= substr($arrHorarioList,$c, $limit);

			//     //$horarioL.= $arrHorarioList[$i];
			    
			//      $divhoras .= "$horaini.$horario_fecha.$horafin
			// 			<a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$pk_horario'>
			// 				<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>$horarioL </button>
			// 			</a>			
			// 		";
			//     }
			//     $i++;

			// }

			// echo $horarioL; 
			// echo $divhoras;	
			// exit();
			// echo "<pre>";
			// print_r($arrCharHorarioLunes);
			// echo "</pre>";
			// exit();













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



/*****************************************************************************************/

// $horarioL=""; 
// $i=0;
// $c=0;
// $limit-0;
// $arrCharHorarioLunes= array();
// while($countChatHorarioLunes>$i)
// {
//     $c=$i+1;
//     $arrCharHorarioLunes[$i] = mb_substr($horarioLunes, $i, $c, "UTF-8");
//  //remover el caracter $i de $horarioLunes despues de esta linea
 
//  //asignar el nuevo valor a horariolunes
 
 
//     if ($arrCharHorarioLunes[$i] =="0")
//     {
 
    
//    // $horarioL.= "8:10"." - ".$arrCharHorarioLuness[$i]."<br>";
//     $limit= $c+5;
//     $horarioL.= substr($arrHorarioList,$c, $limit);

//     //$horarioL.= $arrHorarioList[$i];
    
//      $divfecha .= "$horaini.$horario_fecha.$horafin
// 			<a href='reservar?id=$pk_doctor&e=$especialidad_id&s=$sede_id&h=$pk_horario'>
// 				<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none;  box-shadow: 5px 5px 10px #0000001f;margin: 8px;'>$horarioL </button>
// 			</a>			
// 		";
//     }
//     $i++;

// }

// //echo $horarioL; 
// //exit();
// // echo "<pre>";
// // print_r($arrCharHorarioLunes);
// // echo "</pre>";

/**************************************************************************************************/




require_once "views/reservar.php";

?>