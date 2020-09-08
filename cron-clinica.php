<?php 
include_once('mysql.php');
class ClientRestApi{
	//Config log
	var $ENABLE_LOG = true;
	//Config tables
	var $TBL_API_ESPECIALIDADES="api_especialidades";
	var $TBL_API_DOCTORES="api_doctores";
	var $TBL_API_HORAS="api_horas";
	
	var $mysql = null;

	var $TOKEN = "49eda093231d5d78581eecb438dadff6";
	
	//Config Urls
	var $especialidadesUrl = "http://200.106.58.172:8080/apis/v1/apihc.php/especialidades";
	var $medicosEspecialidadUrl = "http://200.106.58.172:8080/apis/v1/apihc.php/doctor/listaMedicos";
	var $listaFechasMedicoUrl = "http://200.106.58.172:8080/apis/v1/apihc.php/doctor/listaFechasMedico";
	var $listaHorasMedicoUrl = "http://200.106.58.172:8080/apis/v1/apihc.php/doctor/listaHorasMedico";
	
	function __construct(){
		$this->mysql = new MySQL('localhost', 'root', '', 'clinica_gonzalez');
	}
	public function insertEspecialidad($esp){
		try{
			$this->mysql->insert($this->TBL_API_ESPECIALIDADES, $esp);
			//$this->log("Nueva especialidad insertada ");
		}catch(Exception $e){
			echo 'Caught exception: ', $e->getMessage();
			
		}
	}
	public function insertMedico($id_consultorio,$medico){
		try{
			$medico['id_consultorio'] = $id_consultorio;
			$this->mysql->insert($this->TBL_API_DOCTORES, $medico);
			//$this->log("Nuevo médico insertado ");
		}catch(Exception $e){
			echo 'Caught exception: ', $e->getMessage();
			
		}
	}
	public function insertHoras($id_consultorio,$hora){
		try{
			$hora['id_consultorio'] = $id_consultorio;
			$fechaSinFormato = DateTime::createFromFormat('d/m/Y', $hora['fecha']);
			$hora['fecha'] = $fechaSinFormato->format('Y-m-d');
			$this->mysql->insert($this->TBL_API_HORAS, $hora);
			//$this->log("Nueva hora insertada ");
		}catch(Exception $e){
			echo 'Caught exception: ', $e->getMessage();
			
		}
	}
	public function getEspecialidades(){
		$ch = curl_init();		
		
		curl_setopt($ch, CURLOPT_URL, $this->especialidadesUrl);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '. $this->TOKEN, 'Content-Type: application/json'));	
		$data = $this->decodeString(curl_exec($ch));
		
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get specialities');

		return $data;		
	}


	public function getMedicosEspecialidad($id_consultorio) {
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $this->medicosEspecialidadUrl.'?id_consultorio='.$id_consultorio);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '. $this->TOKEN, 'Content-Type: application/json'));	
		$data = $this->decodeString(curl_exec($ch));
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get doctors');

		return $data;
	}
	public function getListaFechasMedico($id_consultorio,$id_medico) {
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $this->listaFechasMedicoUrl.'?id_consultorio='.$id_consultorio.'&id_medico='.$id_medico);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '. $this->TOKEN, 'Content-Type: application/json'));	
		$data = $this->decodeString(curl_exec($ch));
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get doctors hours');

		return $data;
	}
	public function getListaHorasMedico($id_subconsultorio,$id_medico,$fecha) {
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $this->listaHorasMedicoUrl.'?id_subconsultorio='.$id_subconsultorio.'&id_medico='.$id_medico.'&fecha='.$fecha);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '. $this->TOKEN, 'Content-Type: application/json'));	
		$data = $this->decodeString(curl_exec($ch));
	
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get doctors hours: '.curl_error($ch));
		return $data;
	}
	private function decodeString($data){ 
		return json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data), true);
	}
	public function log($log){
		if($this->ENABLE_LOG){
			file_put_contents('./log_'.date("j.n.Y").'.log',date("d/m/Y H:i:s").' - '.$log.PHP_EOL, FILE_APPEND);
		}
	}
}

$api = new ClientRestApi();
$api->log('==========================Inicio Proceso=====================');
$api->log('Obteniendo especialidades');
$especialidades = $api->getEspecialidades();
$dateInicio = new DateTime();
foreach ($especialidades as $esp) {
	$api->log('    Especialidad: '.$esp['id_consultorio'].' - '. $esp['descripcion']);
	$api->insertEspecialidad($esp);
	$medicos = $api->getMedicosEspecialidad($esp['id_consultorio']);
	if(!isset($medicos['error'])){
		foreach($medicos as $medico){
			$api->insertMedico($esp['id_consultorio'],$medico);
			$api->log('         '.$medico['medico']);
			$listaFechasMedico = $api->getListaFechasMedico($esp['id_consultorio'],$medico['id_medico']);
			if(!isset($listaFechasMedico['error'])){
				foreach($listaFechasMedico as $fecha){
					$api->log('            Fecha: '.$fecha['fecha']);
					$listaHorasMedico = $api->getListaHorasMedico($fecha['id_subconsultorio'],$medico['id_medico'],$fecha['fecha']);
					if(!isset($listaHorasMedico['error'])){
						foreach($listaHorasMedico as $horas){
							$horas['fecha'] = $fecha['fecha'];
							$api->insertHoras($esp['id_consultorio'],$horas);
							$api->log('            	Hora: '.$horas['hora']);
						}
					}else{
							$api->log('         	Sin horas.');
					}
				}
			}else{
				$api->log('            Fecha: '. $listaFechasMedico['message']);
			}
		}
	}else{
		$api->log('Sin medicos en especialidad '.$esp['id_consultorio']);

	}
}
$dateFin = new DateTime();
$interval = $dateInicio->diff($dateFin);
$elapsed = $interval->format('Duracion proceso: %i minutos %s segundos');
$api->log($elapsed);
?>