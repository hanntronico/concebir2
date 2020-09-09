<?php


//include_once $_SERVER['DOCUMENT_ROOT']."/lib/phpmailer/libemail.php";

//include_once 'lib/phpmailer/libemail.php';

define ("R","m4T}5qdQ4pX3"); //Clave
define ("M","sacomici_concebir"); //Usuario
define ("E","sacomici_concebir"); //Bd
define ("N","localhost"); //Servidor 
//define ("N","5omC4aorW2tx"); //Servidor 

// define ("R","*274053*"); //Clave
// define ("M","root"); //Usuario
// define ("E","sacomici_concebir"); //Bd
// define ("N","localhost"); //Servidor 

// define ("N","5omC4aorW2tx"); //Servidor 


// Clase para realizar la conexion con la BD MySql

class ConexionBd {


	function open(){  

		if(!isset($this->conexion)){  

			$this->conexion = (mysqli_connect(N,M,R,E));  

			if (!$conexion) {

				echo mysqli_connect_error();

			}

		}  

	}   

	

	// Realiza las consultas a la Base de Datos

	function doSelect($strSelect,$strFrom,$strWhere=null,$strGroupBy=null,$strOrderBy=null) {

		$db = new ConexionBd();  

		$pos = strpos($strSelect, "select");if ($pos == true) {return false;}
		$pos = strpos($strSelect, "from");if ($pos == true) {return false;}
		$pos = strpos($strWhere, "select");if ($pos == true) {return false;}
		$pos = strpos($strWhere, "from");if ($pos == true) {return false;}
		//$pos = strpos($strSelect, "update");if ($pos == true) {return false;}
		//$pos = strpos($strWhere, "update");if ($pos == true) {return false;}

		$db->open();

		$consulta = isset($strSelect) ? "SELECT $strSelect" : "";

		$consulta .= isset($strFrom) ? " FROM $strFrom" : "";

		$consulta .= (isset($strWhere) and (strcmp($strWhere,"") != 0)) ? " WHERE $strWhere" : "";

		$consulta .= isset($strGroupBy) ? " GROUP BY $strGroupBy" : "";

		$consulta .= isset($strOrderBy) ? " ORDER BY $strOrderBy" : "";

		$consulta .= ";";	

        

		$resultado = $db->consulta($consulta);	
		$row =array();



		while ($rowq = mysqli_fetch_assoc($resultado)) {

	        $row[] = $rowq;	

	    }



		return $row;

	}

	



	function doInsert($strInsertInto,$strValues) {

		$db = new ConexionBd();  

		$pos = strpos($strInsertInto, "select");if ($pos == true) {return false;}
		$pos = strpos($strInsertInto, "from");if ($pos == true) {return false;}
		$pos = strpos($strValues, "select");if ($pos == true) {return false;}
		$pos = strpos($strValues, "from");if ($pos == true) {return false;}
		//$pos = strpos($strInsertInto, "update");if ($pos == true) {return false;}
		//$pos = strpos($strValues, "update");if ($pos == true) {return false;}

		$db->open();

		$consulta = isset($strInsertInto) ? "INSERT INTO ".$strInsertInto : "";

		$consulta .= isset($strValues) ? " VALUES ($strValues);" : ";";

		$resultado = $db->consulta($consulta);	
		
		//echo $resultado;

		return $resultado;

	}

	

	function doUpdate($strUpdate,$strSet,$strWhere=null) {

		$db = new ConexionBd();  

		$pos = strpos($strUpdate, "select");if ($pos == true) {return false;}
		$pos = strpos($strUpdate, "from");if ($pos == true) {return false;}
		$pos = strpos($strSet, "select");if ($pos == true) {return false;}
		$pos = strpos($strSet, "from");if ($pos == true) {return false;}
		//$pos = strpos($strUpdate, "update");if ($pos == true) {return false;}
		//$pos = strpos($strWhere, "update");if ($pos == true) {return false;}

		$db->open();

		

		$consulta = isset($strUpdate) ? "UPDATE $strUpdate" : "";

		$consulta .= isset($strSet) ? " SET $strSet" : "";

		$consulta .= isset($strWhere) ? " WHERE $strWhere" : "";

		$consulta .= ";";

		$resultado = $db->consulta($consulta);	

		

		return $resultado;

	}

	

	function doDelete($strDeleteFrom,$strWhere=null) {

		$db = new ConexionBd();  

		$pos = strpos($strDeleteFrom, "select");if ($pos == true) {return false;}
		$pos = strpos($strDeleteFrom, "from");if ($pos == true) {return false;}
		$pos = strpos($strWhere, "select");if ($pos == true) {return false;}
		$pos = strpos($strWhere, "from");if ($pos == true) {return false;}
		//$pos = strpos($strDeleteFrom, "update");if ($pos == true) {return false;}
		//$pos = strpos($strWhere, "update");if ($pos == true) {return false;}

		$db->open();

		

		$consulta = isset($strDeleteFrom) ? "DELETE FROM $strDeleteFrom" : "";

		$consulta .= isset($strWhere) ? " WHERE $strWhere" : "";

		$consulta .= ";";

		$resultado = $db->consulta($consulta);	

		

		return $resultado;

	}

	function doQuery($strQuery=null) {

		$db = new ConexionBd();  

		$db->open();

		$resultado = $db->consulta($strQuery);	

		return $resultado;

	}



	public function consulta($consulta){


        //developed mode
        //echo "\n SQL = $consulta";
        //developed mode end
        
		$resultado = mysqli_query($this->conexion, $consulta);

		$fichero = 'prueba.txt';		

		// Escribe el contenido al fichero
		//file_put_contents($fichero, $consulta);


		//if($resultado){  		

		if(!$resultado){  		

			$link = $_SERVER['PHP_SELF'];
			$link_array = explode('/',$link);
			$url = end($link_array);

			$mensaje = mysqli_error($this->conexion)."<br>Query: $consulta <br><br>modulourl:$url";

			/*
			$libemail = new LibEmail();

			$texto = $mensaje;
			$asunto = "Error Presentado en GestionGo";
			$email = "meneses.rigoberto@gmail.com";

			$resultado = $libemail->enviarcorreo($email, $asunto, $texto);	

			*/



			echo 'MySQL Error: ' . mysqli_error($this->conexion).' favor reportar al administrador del sistema<br>'.$consulta;  
			//echo 'Estamos trabajando en este modulo, pronto estará disponible para utilizarlo';  

			exit;  

		}  

		return $resultado;   

	}  



	public function fetch_array($consulta){   

		return mysql_fetch_array($consulta);  

	}  

	

	public function num_rows($consulta){   

		return mysql_num_rows($consulta);  

	}  



	public function getTotalConsultas(){  

		return $this->total_consultas;  

	}



	public function close(){ 

		if ($this->conexion){ 

			return mysqli_close($this->conexion); 

		} 

	}  



}

?>