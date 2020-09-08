<?php
    //testing
    session_start();
    if(isset($_SESSION)){
        
        $iniuser = $_SESSION["iniuser"];
        
        
        
    }else{
        echo "403";
    }
    
    /*
    var_dump($_SESSION);
    
    $string_JSON = file_get_contents('cita.json');
    $test_obj = json_decode($string_JSON);

    $response_STRING = array();
    $response_STRING["code"] = 200;
    $response_STRING["data"] = $test_obj;

    //echo json_encode($response_STRING);
    */
    
    
