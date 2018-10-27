<?php

// $serverName = '190.223.55.250';
// $serverName = 'localhost';
// $serverName = "190.223.55.250\sqlexpress"; 
$serverName = "192.168.7.207\sqlexpress"; 
// $serverName = "192.168.7.207"; 

// $uid = 'sa';
// $pwd = '9239541@infoudch2015';
// $databaseName = 'UNITES';
// $connectionInfo = array("Database"=>"UNITES", "UID"=>"sa", "PWD"=>"9239541@infoudch2015");

// sqlsrv:Server=SEBASTIAN-PC\SQLEXPRESS;Database=softwareoperacional

// $connectionInfo = array('UID'=>$uid,'PWD'=>$pwd,'Database'=>$databaseName);

$conn = sqlsrv_connect($serverName,$connectionInfo);
// $conn = mssql_connect($serverName,$connectionInfo);

if($conn){
	echo 'exito!!!'; 
}else{
	echo 'Connection failure<br />';die(print_r(sqlsrv_errors(),TRUE));
}
// phpinfo();

?>