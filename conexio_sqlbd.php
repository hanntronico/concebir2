<?php

// $serverName = '190.223.55.250';
// $serverName = 'localhost';
// $serverName = "190.223.55.250\sqlexpress"; 
// $serverName = "192.168.7.207\sqlexpress"; 
// $serverName = "192.168.7.207"; 
$serverName = "192.168.7.220"; 

echo "este es nuevo código";


// $uid = 'sa';
// $pwd = '9239541@infoudch2015';
// $databaseName = 'UNITES';
$connectionInfo = array("Database"=>"UNITES", "UID"=>"sa", "PWD"=>"9239541@infoudch2015");

// $connectionInfo = array('UID'=>$uid,'PWD'=>$pwd,'Database'=>$databaseName);

$conn = sqlsrv_connect($serverName,$connectionInfo);
// $conn = mssql_connect($serverName,$connectionInfo);

date_default_timezone_set("America/Lima");
// sqlsrv_errors

// if($conn){
// 	echo 'exito!!!'; 
// }else{
// 	echo 'Connection failure<br />';die(print_r(sqlsrv_errors(),TRUE));
// }

	if(sqlsrv_errors()){
		echo 'Conexion Fallida : ', sqlsrv_errors();
		exit();
	}

$consulta="SELECT * FROM alumno where cod_alumno="."'201510123'";
$resul=sqlsrv_query($conn,$consulta);
$row=sqlsrv_fetch_array($resul);

// // var_dump($row);
echo $row[0]."-".$row[1]."-".$row[2]."-".$row[3]."-".$row[4]."-".$row[5];

?>