<?php

//API URL


// //create a new cURL resource
// $ch = curl_init($url);

// //setup request to send json via POST
// $data = array(
//     'username' => 'codexworld',
//     'password' => '123456'
// );

// $payload = json_encode(array("user" => $data));

// //attach encoded JSON string to the POST fields
// // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// //set the content type to application/json
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// //return response instead of outputting
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// //execute the POST request
// $result = curl_exec($ch);

// var_dump($result);

// //close cURL resource
// curl_close($ch);
    












	// $datosreniec = json_decode(file_get_contents('http://104.200.144.70:8085/api/datosreniec/08714804'), true);

// https://104.200.144.70/api/datosreniec/70435464 ------ nueva URL

	// $api="https://104.200.144.70/api/datosreniec/".$_POST["dni"];
	// $api="http://104.200.144.70/api/datosreniec/70435464";
	$api="http://104.200.144.70:8085/api/datosreniec/70435464";
	$datosreniec = json_decode(file_get_contents($api), true);

	var_dump($datosreniec);

	// echo $datosreniec['status'];

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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>

<script src="sw.js"></script>

<button type="button" id="boton" class="btn btn-secondary btn-lg">Button</button>




