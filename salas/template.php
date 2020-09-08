<?php


    session_start();
    date_default_timezone_set("America/Lima");
    
    $path ='../lib/config.php';
    
    if(file_exists($path)){
        
        include_once $path;
        
    }else{
        echo "Error 404";
        die();
    }
    function validate_meetings($date){
        $state = false;
        $message = "Hi!";
        
        $minutes_to_add = 20;

        //params date format "2020-06-12 13:25:00";
        $string_start_time = $date;
        
        $start_time = strtotime($string_start_time); //DB horainicio
        
        $validate_time_end = new DateTime($string_start_time);
        
        $validate_time_end->add(new DateInterval('PT' . $minutes_to_add . 'M'));
        
        $end_time = $validate_time_end->format('Y-m-d H:i');
        
        $end_time = strtotime($end_time);
        
        /////
        
        $now = strtotime(date("Y-m-d H:i:s"));  
        
        //$end_time = strtotime("2020-06-05 14:10:00"); //DB horafin
        
        $start_time_now = round(($start_time - $now) / 60,2);  
        $end_time_now = round(($end_time - $now) / 60,2);  
        
        
        if($start_time_now >= 0){
            
            //echo "tu cita es en $start_time_now minutos";
            //echo "\n";
            $state = false; 
            $message = "Tu cita es en $start_time_now minutos";
        }
        else if($end_time_now >= 0){
            /*
            echo "Ya puedes ingresar a tu cita ";
            echo "\n";
            echo "En ";
            echo $end_time_now;
            echo " minutos termina;";
            echo "\n";
            */
            $state = true;
            $message = "Ya puedes ingresar a tu cita. En $end_time_now minutos termina";
            
        }else{
            $state = false;
            
            $message = "Ya termino tu cita";   
            //echo "Ya termino tu cita";   
        }

        
        
        $response["code"] = 200;
        $response["message"] = $message;
        
        return $response;
    }
    
try {
    $id_contact = "";
    
    $id_medico = "";
    $id_usuario = "";
    
    //var_dump($_GET);
    //var_dump($_SESSION);
    
    if(isset($_SESSION)){
        
        $iniuser = $_SESSION["iniuser"];
        
        if(isset($_GET["idM"]) && isset($_GET["idU"]) ){
            
            //$id_medico = isset($_GET["idM"]);
            //$id_usuario = isset($_GET["idU"]);
    
            
            
            if(isset($_SESSION["perfil"])){
                
                if($_SESSION["perfil"] == "2"){
                    
                    $id_contact = $id_usuario;
                    
                } else if($_SESSION["perfil"] == "3"){
                    
                    $id_contact = $id_medico;
                    
                }
            }  
        }
    
        $conexion = new ConexionBd();

        $arrresultado = $conexion->doSelect("
    	cita_fecha,
        usuario_idmedico,
        usuario_idpaciente,
        especialidad_id,
        sede_id,
         cita_fechareg,
         cita_activo,
         cita_eliminado,
         usuario_idreg 
        ",
    	"
    	cita 
    	",
    	"
    	usuario_idpaciente = '$iniuser'
        AND cita_activo = '1' 
        AND cita_eliminado = '0'
    	");
    	
    	$date_now = date("Y-m-d");
    	
    	$result= array();
    	
        foreach($arrresultado as $i=>$valor){
            
            $date = explode(" ", utf8_encode($valor["cita_fecha"]));
            //echo " ".$date[0]." == ".$hoy;
            
            if($date[0] == $hoy){
                $result[] = $valor;
            }
        
        }
        
        $ok= false;
        
        foreach($result as $val){
            
            $reponse = validate_meetings($val["cita_fecha"]);
            
            if($reponse["state"]){
                
                $ok = true;
                echo "<center>" . $reponse["message"] . "</center>";
                break;
            }
            
        }
        
        (!$ok) && (die());
        
        
            
    }else{
        
        echo "<center>Inicie sesion!</center>";
        
        die();
        
    }
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
        
    /*
    echo "SESSION=";
    echo "<br/>";
    echo "get=";
    var_dump($_GET);
    echo "<br/>";
    
    SESSION=
    array(4) { ["login"]=> string(5) "Pedro" ["iniuser"]=> string(2) "10" ["perfil"]=> string(1) "3" ["imguser"]=> string(17) "5edfc28a43f4e.png" }
    get=array(1) { ["id_paciente"]=> string(2) "10" }
    */
    
?>

<script>
var chat_appid = '54668';
var chat_auth = 'd65e4372efde6764ebc02ca41c445552';
</script>
<?php 

	if(isset($_SESSION["login"]) && $_SESSION["iniuser"] > 0) { ?>
	 <script>
		var chat_id = "<?php echo $_SESSION["iniuser"]; ?>";
		var chat_name = "<?php echo $_SESSION["login"]; ?>"; 
		var chat_link = "<?php echo $_SESSION["user_link"]; ?>"; //Similarly populate it from session for user's profile link if exists
		var chat_avatar = "<?php echo $_SESSION["imguser"]; ?>"; //Similarly populate it from session for user's avatar src if exists
		var chat_role = "<?php echo $_SESSION["perfil"]; ?>"; //Similarly populate it from session for user's role if exists
		var chat_friends = '<?php echo $id_medico; ?>'; //Similarly populate it with user's friends' site user id's eg: 14,16,20,31
		</script>
	<?php } ?>
<script>
(function() {
    var chat_css = document.createElement('link'); chat_css.rel = 'stylesheet'; chat_css.type = 'text/css'; chat_css.href = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.css';
    document.getElementsByTagName("head")[0].appendChild(chat_css);
    var chat_js = document.createElement('script'); chat_js.type = 'text/javascript'; chat_js.src = 'https://fast.cometondemand.net/'+chat_appid+'x_xchat.js'; var chat_script = document.getElementsByTagName('script')[0]; chat_script.parentNode.insertBefore(chat_js, chat_script);
})();
</script>