<?php

	// phpinfo();

	// $datosreniec = json_decode(file_get_contents('http://104.200.144.70:8085/api/datosreniec/08714804'), true);

// https://104.200.144.70/api/datosreniec/70435464 ------ nueva URL

	// $api="https://104.200.144.70/api/datosreniec/".$_POST["dni"];
	$api="https://104.200.144.70/api/datosreniec/70435464";
	$datosreniec = json_decode(file_get_contents($api), true);

	echo $datosreniec['status'];

	// if ($datosreniec['status']=='1') {
	// 	echo $datosreniec['objModel']['nombres']."-".$datosreniec['objModel']['apellidoPaterno']." ".$datosreniec['objModel']['apellidoMaterno'];
	// }
	// elseif($datosreniec['status']=='0'){
	// 	echo "NA";		
	// }








	// echo $datosreniec['status']."-".$datosreniec['objModel']['nombres']."-".$datosreniec['objModel']['apellidoPaterno']."-".$datosreniec['objModel']['apellidoMaterno'];

	// echo $datosreniec['objModel']['nombres']."<br>";
	// echo $datosreniec['objModel']['apellidoPaterno']."<br>";
	// echo $datosreniec['objModel']['apellidoMaterno']."<br>";


?>