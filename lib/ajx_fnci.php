<?php
include_once '../lib/configinc_in.php';
include_once '../lib/xajax_0.2.4/xajax.inc.php';
include_once '../lib/funciones.php';
include_once '../lib/mysqlclass.php';
include_once '../lib/phpmailer/libemail.php';

session_start();

$GLOBALS[fechaactual] = formatoFechaHoraBd();
$GLOBALS[conexion] = new ConexionBd();

$xajax = new xajax('ajx_fnci.php');

$xajax->registerFunction('ingresarusuario');
$xajax->registerFunction('cambiarestatususuario');
$xajax->registerFunction('eliminarusuario');
$xajax->registerFunction('cambiarestatusespecialidad');
$xajax->registerFunction('eliminarespecialidad');
$xajax->registerFunction('cambiarestatussede');
$xajax->registerFunction('eliminarsede');
$xajax->registerFunction('cambiarestatususuarioespecialidad');
$xajax->registerFunction('eliminarusuarioespecialidad');
$xajax->registerFunction('cambiarestatususuariosede');
$xajax->registerFunction('eliminarusuariosede');
$xajax->registerFunction('cambiarestatuscita');
$xajax->registerFunction('eliminarcita');
$xajax->registerFunction('registrarusuario');
$xajax->registerFunction('registrarusuario2');
$xajax->registerFunction('cargarespecialidadessedes');
$xajax->registerFunction('confirmarreserva');
$xajax->registerFunction('cambiarestatushorario');
$xajax->registerFunction('eliminarhorario');
$xajax->registerFunction('cambiarestatuspago');
$xajax->registerFunction('eliminarpago');
$xajax->registerFunction('guardarestatuspago');
$xajax->registerFunction('guardarestatuscita');



function guardarestatuscita($cita_id=null, $estatus=null){

	$objResponse = new xajaxResponse();	

	$resultado = $GLOBALS[conexion]->doUpdate("cita", "
	estatus_id = '$estatus'
	", "cita_id='$cita_id'");	

	$texresp ="Cambiado el Estatus Correctamente";
	
	if ($resultado){		
		$objResponse->addAlert($texresp);		
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error cambiando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}



function guardarestatuspago($pago_id=null, $estatus=null){

	$objResponse = new xajaxResponse();	

	$arrresultado = $GLOBALS[conexion]->doSelect("
		pago.pago_id, pago_monto, pago_referencia, pago_activo, pago_eliminado,
		pago_fechapago, pago.usuario_id, 
		pago.cita_id, pago.formapago_id, pago.estatus_id, pago_observacion, 
		pago_img, pago_banco,
		DATE_FORMAT(pago_fechareg,'%d/%m/%Y %H:%i:%s') as pago_fechareg, 
		usuario_nombre, usuario_apellido, formapago_nombre, estatus_nombre,
		cita.estatus_id as estatus_idcita
	    ",
		"pago	
			inner join usuario on usuario.usuario_id = pago.usuario_id			
			inner join cita on cita.cita_id = pago.cita_id			
			inner join formapago on formapago.formapago_id = pago.formapago_id			
			inner join estatus on estatus.estatus_id = pago.estatus_id			
		",
		"pago_eliminado = '0' and pago.pago_id = '$pago_id'");
	foreach($arrresultado as $i=>$valor){

		$pago_id = utf8_encode($valor["pago_id"]);
		$pago_monto = utf8_encode($valor["pago_monto"]);
		$pago_referencia = utf8_encode($valor["pago_referencia"]);
		$pago_activo = utf8_encode($valor["pago_activo"]);
		$cita_id = utf8_encode($valor["cita_id"]);
		$formapago_id = utf8_encode($valor["formapago_id"]);
		$estatus_id = utf8_encode($valor["estatus_id"]);
		$estatus_idcita = utf8_encode($valor["estatus_idcita"]);
		$pago_observacion = utf8_encode($valor["pago_observacion"]);
		$pago_img = utf8_encode($valor["pago_img"]);
		$pago_banco = utf8_encode($valor["pago_banco"]);
		$pago_fechareg = utf8_encode($valor["pago_fechareg"]);	

		$usuario_nombre = utf8_encode($valor["usuario_nombre"]);	
		$usuario_apellido = utf8_encode($valor["usuario_apellido"]);	
		$formapago_nombre = utf8_encode($valor["formapago_nombre"]);	
		$estatus_nombre = utf8_encode($valor["estatus_nombre"]);	

	  	$pago_monto = number_format($pago_monto,2,",","."). " PEN";  	

	}

	$resultado = $GLOBALS[conexion]->doUpdate("pago", "
	estatus_id = '$estatus'
	", "pago_id='$pago_id'");	

	if ($estatus=="2" && ( $estatus_idcita=="4" ||  $estatus_idcita=="5" ) ){ // Pago Confirmado

		$resultado = $GLOBALS[conexion]->doUpdate("cita", "
		estatus_id = '6'
		", "cita_id='$cita_id'");	

	}

	$texresp ="Cambiado el Estatus Correctamente";
	
	if ($resultado){		
		$objResponse->addAlert($texresp);		
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error cambiando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}



function eliminarpago($pago_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("pago", "pago_activo = '0', pago_eliminado = '1' ", "pago_id='$pago_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatuspago($pago_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("pago", "
			pago_activo = '$estatus'
			", "pago_id='$pago_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function eliminarhorario($horario_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("horario", "horario_activo = '0', horario_eliminado = '1' ", "horario_id='$horario_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatushorario($horario_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("horario", "
			horario_activo = '$estatus'
			", "horario_id='$horario_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}


function confirmarreserva($medico=null, $especialidad=null, $sede=null, $horario=null, $hora=null){

	$objResponse = new xajaxResponse();

	if ($sede==""){$sede=0;}

	$arrresultado = $GLOBALS[conexion]->doSelect("
		usuario.usuario_id, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_email, usuario.usuario_clave, 
		usuario.usuario_dni, usuario.usuario_celular, usuario.usuario_img, usuario.perfil_id, usuario.usuario_activo,
		usuario.usuario_eliminado, usuario.usuario_idreg,
		DATE_FORMAT(usuario_fechareg,'%d/%m/%Y %H:%i:%s') as usuario_fechareg, 
		usuario_paypal, usuario_precio
	    ",
		"usuario				
		",
		"usuario_eliminado = '0' and usuario.usuario_id = '$medico'");
	foreach($arrresultado as $i=>$valor){
		$usuario_precio = utf8_encode($valor["usuario_precio"]);
	}

		
	$arrresultado = $GLOBALS[conexion]->doSelect("
		horario.horario_id, horario.usuario_id, horario.sede_id,  
		horario_activo, horario_eliminado, horario.usuario_idreg,	
		DATE_FORMAT(horario_fecha,'%Y-%m-%d') as horario_fecha
	    ",
		"horario				
		",
		"horario_eliminado = '0' and horario.horario_id = '$horario'");
	foreach($arrresultado as $i=>$valor){

		$horario_id = utf8_encode($valor["horario_id"]);
		$t_usuario_id = utf8_encode($valor["usuario_id"]);
		$t_sede_id = utf8_encode($valor["sede_id"]);

		$horario_activo = utf8_encode($valor["horario_activo"]);
		$horario_fecha = utf8_encode($valor["horario_fecha"]);	
		$horaini = utf8_encode($valor["horaini"]);	
		$horafin = utf8_encode($valor["horafin"]);	
		$horario_fechareg = utf8_encode($valor["horario_fechareg"]);		

	}

	$horario_fecha = $horario_fecha." ".$hora;
	

	$resultado = $GLOBALS[conexion]->doInsert("
	cita
		(cita_fecha, usuario_idmedico, usuario_idpaciente, especialidad_id, sede_id, 
		cita_fechareg, cita_activo, cita_eliminado, usuario_idreg, cita_precio, estatus_id) 
	",
	"'$horario_fecha', '$medico', '$_SESSION[iniuser]', '$especialidad', '$sede', 
	'$GLOBALS[fechaactual]', '1', '0', '$_SESSION[iniuser]','$usuario_precio','4'");


	$arrresultado2 = $GLOBALS[conexion]->doSelect("max(cita_id) as cita_id","cita");
	if (count($arrresultado2)>0){
		foreach($arrresultado2 as $i=>$valor){
			$cita_id = strtoupper($valor["cita_id"]);
		}
	}
	


	// $texresp ="Registrado Correctamente la Reserva, procederemos con el pago de la misma";	
	$texresp ="Ha sido registrada correctamente su Reserva, en un corto tiempo le confirmaremos la Cita a su correo y a su celular.";	
	$objResponse->addAlert($texresp);

	// $objResponse->addScript("window.location = 'seleccionarformapago?id=$cita_id';");
	$objResponse->addScript("window.location = 'citas';");

	return $objResponse;

}

function cargarespecialidadessedes($medico_id=null){

	$objResponse = new xajaxResponse();
	

	$arrresultado = $GLOBALS[conexion]->doSelect("especialidad.especialidad_id, especialidad_nombre",
		"especialidad
			inner join usuarioespecialidad on usuarioespecialidad.especialidad_id = especialidad.especialidad_id
		",
		"especialidad_eliminado = '0' and usuarioespecialidad_activo = '1' and usuarioespecialidad.usuario_id = '$medico_id'");

	$optionespecialidad .= "<option value=''>-- Seleccione --</option>";
	foreach($arrresultado as $i=>$valor){
		$especialidad_id = utf8_encode($valor["especialidad_id"]);
		$especialidad_nombre = utf8_encode($valor["especialidad_nombre"]);	
		
		if ($t_especialidad_id==$especialidad_id){
			$optionespecialidad .= "<option selected='selected' value='$especialidad_id'>$especialidad_nombre</option>";
		}else{
			$optionespecialidad .= "<option value='$especialidad_id'>$especialidad_nombre </option>";
		}
	}


	if (count($arrresultado)==1){
		$option = "<option selected='selected' value='$especialidad_id'>$especialidad_nombre</option>";
	}else if (count($arrresultado)==0){
		$option = "<option value=''>NO TIENE ESPECIALIDADES</option>";			
	}

	$objResponse->addAssign("especialidad", "innerHTML", $option);	




	$arrresultado = $GLOBALS[conexion]->doSelect("sede.sede_id, sede_nombre",
		"sede
			inner join usuariosede on usuariosede.sede_id = sede.sede_id
		",
		"sede_eliminado = '0' and usuariosede_activo = '1' and usuariosede.usuario_id = '$medico_id'");

	$optionsede .= "<option value=''>-- Seleccione --</option>";
	foreach($arrresultado as $i=>$valor){
		$sede_id = utf8_encode($valor["sede_id"]);
		$sede_nombre = utf8_encode($valor["sede_nombre"]);	
		
		if ($t_sede_id==$sede_id){
			$optionsede .= "<option selected='selected' value='$sede_id'>$sede_nombre</option>";
		}else{
			$optionsede .= "<option value='$sede_id'>$sede_nombre </option>";
		}
	}


	if (count($arrresultado)==1){
		$option = "<option selected='selected' value='$sede_id'>$sede_nombre</option>";
	}else if (count($arrresultado)==0){
		$option = "<option value=''>NO TIENE SEDES</option>";			
	}

	$objResponse->addAssign("sede", "innerHTML", $option);	



	return $objResponse;
}



function registrarusuario2($data){
    // var_dump($data);
	// echo $data;
 //  exit();

	$objResponse = new xajaxResponse();

    $email = utf8_decode($data["email"] );
    $clave = utf8_decode($data["clave"] );
    $nombre = utf8_decode($data["nombre"] );
    $apellido = utf8_decode($data["apellido"] );
    $t_document_select_selected = utf8_decode($data["t_document_select_selected"] );
    $documento = utf8_decode($data["documento"] );
    $celular = utf8_decode($data["celular"] );
    $f_nacimiento = utf8_decode($data["f_nacimiento"] );
    $description_question_1 = utf8_decode($data["description_question_1"] );
    $pais_nacimiento = utf8_decode($data["pais_nacimiento"] );
    $ciudad_nacimiento = utf8_decode($data["ciudad_nacimiento"] );
    $question_2_selected_value = utf8_decode($data["question_2_selected_value"] );

	if ($usuario_email!=""){
		$arrresultado = $GLOBALS[conexion]->doSelect("usuario_id","usuario",
			"usuario_eliminado ='0' and (usuario_email = '$email')");

		if (count($arrresultado)>0){
			$texresp ="Error: Ya el Email se encuentra registrado en el sistema, por favor verifique";	
			$objResponse->addAlert($texresp);
			return $objResponse;
		}	
	}
	

	$resultado = $GLOBALS[conexion]->doInsert("
	usuario
		(f_nacimiento,
        alerg_enferm,
        pais,
        ciudad,
        seguro,
        usuario_nombre, usuario_apellido, usuario_email, usuario_clave, usuario_dni, usuario_celular, usuario_img, 
		perfil_id, usuario_activo, usuario_eliminado, usuario_fechareg, usuario_idreg) 
	",
	"'$f_nacimiento',
	'$description_question_1',
	'$pais_nacimiento',
	'$ciudad_nacimiento',
	'$question_2_selected_value',
	'$nombre', '$apellido', '$email', '$clave', '$dni', '$celular','1.png',
	'3','1', '0', '$GLOBALS[fechaactual]', '0'");

	$arrresultado2 = $GLOBALS[conexion]->doSelect("max(usuario_id) as usuario_id","usuario");
	if (count($arrresultado2)>0){
		foreach($arrresultado2 as $i=>$valor){
			$usuario_id = strtoupper($valor["usuario_id"]);
		}
	}

	
	$_SESSION[iniuser] = $usuario_id;
	$_SESSION[login] = $nombre;
	$_SESSION[imguser] = "1.png";
	$_SESSION[perfil] = 3;		

	$texresp ="Registrado Correctamente";	
	$objResponse->addAlert($texresp);

	$objResponse->addScript("window.location = 'panel';");

	return $objResponse;

}

function registrarusuario($nombre=null, $apellido=null, $email=null, $celular=null, $dni=null, $clave=null){

	$objResponse = new xajaxResponse();

	$nombre = utf8_decode($nombre);	
	$apellido = utf8_decode($apellido);	
	$email = utf8_decode($email);	
	$celular = utf8_decode($celular);	
	$dni = utf8_decode($dni);	
	$clave = utf8_decode($clave);		

	if ($usuario_email!=""){
		$arrresultado = $GLOBALS[conexion]->doSelect("usuario_id","usuario",
			"usuario_eliminado ='0' and (usuario_email = '$email')");

		if (count($arrresultado)>0){
			$texresp ="Error: Ya el Email se encuentra registrado en el sistema, por favor verifique";	
			$objResponse->addAlert($texresp);
			return $objResponse;
		}	
	}
	

	$resultado = $GLOBALS[conexion]->doInsert("
	usuario
		(usuario_nombre, usuario_apellido, usuario_email, usuario_clave, usuario_dni, usuario_celular, usuario_img, 
		perfil_id, usuario_activo, usuario_eliminado, usuario_fechareg, usuario_idreg) 
	",
	"'$nombre', '$apellido', '$email', '$clave', '$dni', '$celular','1.png',
	'3','1', '0', '$GLOBALS[fechaactual]', '0'");

	$arrresultado2 = $GLOBALS[conexion]->doSelect("max(usuario_id) as usuario_id","usuario");
	if (count($arrresultado2)>0){
		foreach($arrresultado2 as $i=>$valor){
			$usuario_id = strtoupper($valor["usuario_id"]);
		}
	}

	
	$_SESSION[iniuser] = $usuario_id;
	$_SESSION[login] = $nombre;
	$_SESSION[imguser] = "1.png";
	$_SESSION[perfil] = 3;		

	$texresp ="Registrado Correctamente";	
	$objResponse->addAlert($texresp);

	$objResponse->addScript("window.location = 'panel';");

	return $objResponse;

}


function eliminarcita($cita_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("cita", "cita_activo = '0', cita_eliminado = '1' ", "cita_id='$cita_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatuscita($cita_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("cita", "
			cita_activo = '$estatus'
			", "cita_id='$cita_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function eliminarusuariosede($usuariosede_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("usuariosede", "usuariosede_activo = '0', usuariosede_eliminado = '1' ", "usuariosede_id='$usuariosede_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatususuariosede($usuariosede_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("usuariosede", "
			usuariosede_activo = '$estatus'
			", "usuariosede_id='$usuariosede_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function eliminarusuarioespecialidad($usuarioespecialidad_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("usuarioespecialidad", "usuarioespecialidad_activo = '0', usuarioespecialidad_eliminado = '1' ", "usuarioespecialidad_id='$usuarioespecialidad_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatususuarioespecialidad($usuarioespecialidad_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("usuarioespecialidad", "
			usuarioespecialidad_activo = '$estatus'
			", "usuarioespecialidad_id='$usuarioespecialidad_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}


function eliminarsede($sede_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("sede", "sede_activo = '0', sede_eliminado = '1' ", "sede_id='$sede_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatussede($sede_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("sede", "
			sede_activo = '$estatus'
			", "sede_id='$sede_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}


function eliminarespecialidad($especialidad_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("especialidad", "especialidad_activo = '0', especialidad_eliminado = '1' ", "especialidad_id='$especialidad_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatusespecialidad($especialidad_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("especialidad", "
			especialidad_activo = '$estatus'
			", "especialidad_id='$especialidad_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}


function eliminarusuario($usuario_id=null){

	$objResponse = new xajaxResponse();

	$resultado = $GLOBALS[conexion]->doUpdate("usuario", "usuario_activo = '0', usuario_eliminado = '1' ", "usuario_id='$usuario_id'");
	if ($resultado){
		$texresp ="Eliminado Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function cambiarestatususuario($usuario_id=null, $estatus=null){

	$objResponse = new xajaxResponse();
	

	$resultado = $GLOBALS[conexion]->doUpdate("usuario", "
			usuario_activo = '$estatus'
			", "usuario_id='$usuario_id'");
	if ($resultado){
		$texresp ="Cambiado el Estatus Correctamente";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");
	}else{
		$texresp ="Error eliminando el estatus, por favor verifique o reporte el mismo al administrador del sistema";
		$objResponse->addAlert($texresp);
		$objResponse->addScript("window.location.reload()");

	}

	return $objResponse;
}

function ingresarusuario($usuario=null, $password=null){


	$objResponse = new xajaxResponse();

	$usuario = trim(utf8_decode($usuario));	
	$password = trim(utf8_decode($password));	
	
	$arrresultado = $GLOBALS[conexion]->doSelect("
			usuario.usuario_id,  usuario.usuario_clave, usuario.usuario_img, usuario_apellido,
			usuario.usuario_activo, usuario.usuario_eliminado, usuario.perfil_id, 
			usuario.usuario_nombre, usuario.usuario_email
		",
			"usuario				
				inner join perfil on usuario.perfil_id = perfil.perfil_id
			",
			"usuario_activo ='1' and usuario_email = '$usuario' and usuario_clave = '$password'");

	if (count($arrresultado)>0){
		foreach($arrresultado as $i=>$valor){

			$usuario_id = utf8_encode($valor["usuario_id"]);			
			$perfil_id = utf8_encode($valor["perfil_id"]);					
			$usuario_nombre = utf8_encode($valor["usuario_nombre"]);
			$usuario_apellido = utf8_encode($valor["usuario_apellido"]);
			$usuario_img = utf8_encode($valor["usuario_img"]);
			$usuario_email = utf8_encode($valor["usuario_email"]);
			$usuario_activo = utf8_encode($valor["usuario_activo"]);

			if ($usuario_img==""){$usuario_img= "1.png";}
			

			if ($usuario_activo=="1"){
				
				$_SESSION[login] = $usuario_nombre;							
				$_SESSION[iniuser] = $usuario_id;							
				$_SESSION[perfil] = $perfil_id;									
				$_SESSION[imguser] = $usuario_img;	

				$texresp = "Bienvenido $usuario_nombre $usuario_apellido";

				$objResponse->addAlert($texresp);
				
				$objResponse->addScript("window.location = 'panel';");			
				
				
			}else{
				$texresp ="Usuario Inactivo, por favor enviar un email a administrador del sistema para solicitar la activacion";
				$objResponse->addAlert($texresp);
			}		

		}
	}else{
		$texresp ="Error, de ingreso al sistema, verifique su usuario y clave.";
		$objResponse->addAlert($texresp);
	}

	return $objResponse;
}


$xajax->processRequests();
?>