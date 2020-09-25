<?php
// $hostname = "localhost";
// $username = "sacomici_concebir";
// $password = "m4T}5qdQ4pX3";
// $database= "sacomici_concebir";

$hostname = "localhost";
$username = "root";
$password = "*274053*";
$database= "sacomici_concebir";


$mysqli = new mysqli($hostname, $username, $password, $database);
$divhoras="";
// Create connection
//$conn = new mysqli($servername, $username, $password);

// Check connection
if ($mysqli ->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";


$sede= $_GET["sede"];

$fecha= $_GET["fecha"];
$ubicacion= $_GET["ubicacion"];
$sede_nombre= $_GET["s"];
// echo "sedenombre: ". $sede_nombre;
$ubicacionh= "h.".$ubicacion;

$fecha= date_create($fecha); 
$fecha= date_format($fecha, "Y/m/d");
// echo "FECHA: ".$fecha;
$pk_doctor= $_GET["profesional"];
// Perform query


$nombre="";

if ($result = $mysqli -> query("SELECT p._pk_doctor, p.name, p.name_ap_pat, p.name_ap_mat, p.especialidad, p.horamodulo, p.horadesde, p.horahasta, h.horario1Lunes, $ubicacionh   FROM profesionales2 AS p 
INNER JOIN horario2 AS h ON  p._pk_doctor = h._fk_doctor  WHERE _pk_doctor='$pk_doctor'   ")) {
  echo "Returned rows are: " . $result -> num_rows;

  // Free result set
  //$result -> free_result();

if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {

      $usuario_id=$row["_pk_doctor"];
      $nombre= $row["name"]. " ".$row["name_ap_pat"]. " ".$row["name_ap_mat"] ;

      echo "Especialidad: " . $row["especialidad"]. "<br>";
      $horadesde= $row["horadesde"];
      $horahasta= $row["horahasta"];
      echo "Horadesde:".$horadesde;
      echo "Apellido Materno: " . $row["name_ap_pat"]. "<br>";
      echo "Horario1Lunes: " . $row["horario1Lunes"]  . "<br>";
      $ubicacion1Lunes= $row[$ubicacion];
      echo $ubicacion."    ". $ubicacion1Lunes  . "<br>";
      $horamodulo= $row["horamodulo"];
      
      //echo "horamodulo: " . $horamodulo  . "<br>";
      //if (is_numeric($horamodulo))

      echo "resultados:".substr_count($ubicacion1Lunes, $sede)."            ?????????????         ";
      $discount_start_= '18:47';    
      $result = mb_substr($horamodulo, 3, 2);

//if (is_numeric($result ))
  //  $result = $string + 0;
//else // Let the number be 0 if the string is not a number

      $intervalo = intval($result);
      $horam= intval($result);

      $theDate    = new DateTime('18:47');
      $horamodulo= new DateTime($horamodulo);
      //echo $stringDate = $theDate->format('H:i:s');
      echo "intervalo".$intervalo;
      echo $stringDate = "horamodulo".$horamodulo->format('i:s');
      $i=0;
      $sedesanisidro= "";

      /*foreach (count_chars($ubicacion1Lunes, 1) as $i => $val) {
      $d=0; 
        echo "There were $val instance(s) of \"" , chr($i) , "\" in the string.\n";
         while ($val>$d)
      {
      if (chr($i)=="0")
      {
      $sedesanisidro+= "0";
      }
      }		
      }

*/

  $e=0;
  $numcaracteres= count_chars($ubicacion1Lunes);
  $countsedeocurrences= substr_count($ubicacion1Lunes, $sede);
  $sedepos= array();

  while ($countsedeocurrences>$e)
  {
    $restodeocurrencias= substr_count($ubicacion1Lunes, $sede);
    echo $restodeocurrencias;
    $sedepos[$e]=strrpos($ubicacion1Lunes,$sede);
    $checkpos= $sedepos[$e];
    echo $chekpos;
    if ($restodeocurrencias==0)
      {
        $e=9999999;
      }
    else{
      //echo "POSICION ULTIMO CARACTER: ".$sedepos[$e];
      $ubicacion1Lunes=substr_replace($ubicacion1Lunes,"", $sedepos[$e]);
      $e++;
    }
  }

  $horaactual=$horadesde;
  $horaactual= mb_substr($horaactual, 0, 2);
  //
  echo "hora actual: ".$horaactual."      finhoraactual";
  $horaactual = intval($horaactual);

  echo "CONTADOR:   ".$countsedeocurrences." FIN CONTADOR";
  echo "NUMERO DE CARACTERES:   ".$numcaracteres." FIN NUMERO CARACTERES";

    $intervaloactual=0;
    $horaAgendada= array();
    $sentencia_consulta="SELECT horaInicio, _fk_Fecha 
                         FROM citas2 
                         WHERE _fk_ubicacion =$sede 
                         AND _fk_medicoTratante ='$pk_doctor' 
                         AND _fk_Fecha>CURRENT_TIMESTAMP 
                         AND _fk_Fecha=DATE('$fecha')";
  echo $sentencia_consulta;

    if ($consulta=$mysqli -> query("SELECT horaInicio, _fk_Fecha FROM citas2 WHERE _fk_ubicacion =$sede AND _fk_medicoTratante ='$pk_doctor' AND _fk_Fecha>CURRENT_TIMESTAMP AND _fk_Fecha=DATE('$fecha')"));
    {

      if (mysqli_num_rows($consulta) > 0) {
        $c=0;
        while($row = mysqli_fetch_assoc($consulta)) {
          $horaAgendada[$c]= $row["horaInicio"];
          $horaAgendada[$c]= mb_substr($horaAgendada[$c], 0, 5);

          echo "Inicio HoraAgendada".$horaAgendada[$c]."Fin HoraAgendada";
          $c++;
        }
      }
    }

    while ($i<$countsedeocurrences)
      {
        $mult= $sedepos[$i];
        $mult= intval($mult);
        echo "mult:". $mult;
        echo "horamodulo: ".$horam;
        $intervalo= $horam*$mult;
        $intervaloactual= $intervalo;

        if ($intervaloactual==60)
          {
          	$horaactual= $horaactual+1;
          	$intervaloactual=00;	
          }
        else if ($intervaloactual>60)
          {
            echo "intervaloactuale es : ".$intervaloactual. "   ". " horaactual es ". $horaactual;
            $horaactual= $horadesde+round($intervaloactual/60);
            echo "HORA ES MAS QUE 60 Y ES :".$horaactual;
            $intervaloactual=round($intervaloactual%60);
            echo "intervaloactuale ahora  es : ".$intervaloactual. "   ";
          }

          $hora=$horaactual.":".$intervaloactual;
          if ($hora!=$horaAgendada[$i])
            {
              echo "BLOQUE". $hora. "FIN DEL BLOQUE";
              $divhoras .= "	    	
            			<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id&h=$horario_id&i=$hora' style='margin-right: 10px; margin-bottom: 10px'>
            				<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; margin-top: 10px; padding: 5px 27px; border-radius: 20px; outline: none; box-shadow: 5px 5px 10px #0000001f; border: none;'>$hora </button>
            			</a>";
            }
            else
            	echo "....HORA AGENDADA Y HORA BLOQUE MATCH....";
            $i++;
      }

    }
         


         } else {
            echo "No hay fechas disponibles";
         }
}


echo $divhoras;


$divespecialidades ="";
$divsedes ="";
$divfecha ="";
/*
$divespecialidades = "
		<a href='reservar?id=$usuario_id&e=$getespecialidad'>
			<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; border: none; border-radius: 20px; padding: 5px 27px; box-shadow: 5px 5px 10px #0000001f; outline: none;'>".$usuario_especialidad."</button>
		</a>
	";


$divsedes = "
				<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id'>
					<button type='button' class='btn btn-success' style='font-size: 17px; cursor: pointer; padding: 5px 27px; margin-top: 20px; border-radius: 20px; outline: none;  background: #76ce81 !important; box-shadow: 0px 11px 10px #0000001f; border: none; color: white !important; '>".$sede_nombre." </button>
				</a>			
			";

$divfecha = "
			<a href='reservar?id=$usuario_id&e=$especialidad_id&s=$sede_id'>
				<button type='button' class='btn btn-warning' style='font-size: 17px; cursor: pointer; border-radius: 20px; border: none; padding: 5px 27px; outline: none; box-shadow: 0px 11px 10px #0000001f;'><i class='fa fa-times'></i> $horario_fecha </button>
			</a>
		";	


		";
*/

// echo

$displaysedes="";
$displayfechas="";
$displayhorarios="";
$displayconfirmar="";

require_once "views/reservar.php";

exit();
?>

<!DOCTYPE html>
<html>
<head>  
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reservar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link href="dist/img/logicon.png" rel="icon">
  <link rel="shortcut icon" href="dist/img/logicon.png">
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/datatables.min.css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
  <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
  <link rel="canonical" href="https://codepen.io/pen/?&amp;editable=true&amp;editors=001=https%3A%2F%2Ffullcalendar.io%2F">
  
  
<!--   
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->



  <style class="INLINE_PEN_STYLESHEET_ID">
/*    html, body {
      margin: 0;
      padding: 0;
      font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
      font-size: 14px;
    }

    #calendar {
      max-width: 900px;
      margin: 40px auto;
    }*/
  </style>

  



  <style>
    #btn-reservar .btn-warning {
      background: none !important;
      color: black !important;
      border: 0 !important;
    }

    #btn-reservar .fa-times {
      display: none;
    }
  </style>

  <script>
    $(function() {
      $("#month").change(function(){
        var month= $("#month").val();
        // $("#mes").val(month);

        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();

        if(dd<10) { dd='0'+dd; } 
        if(mm<10) { mm='0'+mm; } 
        var today = yyyy+"-"+mm+"-"+dd; 


      if (month >= today){

          var hlink = "";  
          
          if ($("#mes").val()=="") {
            hlink="&h="+month;
            window.location.href = window.location.href+hlink;
          }else{
            if (month==$("#mes").val()) {
              hlink="";
              window.location.href = window.location.href+hlink;
            }else{
              
              var str = window.location.href;
              var olink = str.split("&h=");
              hlink=olink[0]+"&h="+month;
              window.location.href = hlink;

            }
          }


      }else{
        alert("Ingresar fecha válida")
        return false;
      }
       
  });

      // $("#day").change(function(){
      //   var day= $("#day").val();
      //   var currentlocation= window.location.href;
      //   window.location.href= currentlocation+"&dia="+day;
      //   //alert(day);
      // });

      // $('#calendar').fullCalendar({
      //   themeSystem: 'bootstrap4',
      //   header: {
      //     left: 'prev,next today',
      //     center: 'title',
      //     right: 'month,agendaWeek,agendaDay,listMonth'
      //   },
      //   weekNumbers: true,
      //   eventLimit: true, // allow "more" link when too many events
      //  // events: 'https://fullcalendar.io/demo-events.json'
      // });

    });

  </script>

  <style>
/*    html, body {
        margin: 0;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }

    #calendar {
      max-width: 900px;
      margin: 40px auto;
    }*/
  </style>




</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-top: -20px">
  

    <!-- Main content -->

      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div style="background: #FFF; padding: 10px;">


              <div class='row'>
                <div class='col-md-3 animate__animated animate__fadeInDown'
                  style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 30px 0;" >
                  <div style='height: 200px'>
                    <img src='arch/<?php // echo $usuario_img;
?>'
                      style='max-height: 200px; border-radius: 50%; box-shadow: 3px 11px 16px #1f4e3626;'
                      alt='<?php echo $nombre;?>'
                      title='<?php echo $nombre;?>'>
                  </div>
                  <a>
                    <h4 style='font-size: 22px'><?php echo $nombre;?></h4>
                  </a>
                </div>
                
            <div class='col-md-9'>
                  <hr>
                  <h3 class="animate__animated animate__fadeInDown">
                    <i class="fa fa-user-md"></i> Especialidad:
                  </h3>
                                  <?php echo $divespecialidades;?>

                  <div class="animate__animated animate__fadeInDown" style="margin-top: 15px" id="btn-reservar">
                  </div>

                  <hr>

                  <div <?php echo $displaysedes;?>

                    <h3 class="animate__animated animate__fadeInDown">
                      <i class="fa fa-building"></i> Seleccione la Sede para la Reserva:
                    </h3>
                    <div class="animate__animated animate__fadeInDown" style="margin-top: 15px">
                    
                      <?php echo $divsedes;?>
                    </div>

                  </div>

                   <hr> 

                  <div <?php echo $displayfechas;?> >

                    <h3 class="animate__animated animate__fadeInDown">
                      <i class="fa fa-calendar"></i> Seleccione la fecha de su Reserva:
                    </h3>
                    <div class="animate__animated animate__fadeInDown" style="margin-top: 15px">
                    
                    <input type="date" placeholder="Mes" id="month"  value="<?php echo $valortextmes; ?>" />
                    <input type="hidden" name="mes" id="mes" value="<?php echo $valortextmes; ?>">

                       <?php echo $divfecha;?>

                    </div>
                  </div>

                  <hr> 

                  <div <?php echo $displayhorarios;?>>

                    <h3 class="animate__animated animate__fadeInDown">
                      <i class="fa fa-clock-o"></i> Seleccione el horario de su Reserva:
                    </h3>
                    <div class="animate__animated animate__fadeInDown" style="margin-top: 15px">

                      <?php echo $divhoras;?>
                    </div>
                  </div>



                </div>

                <hr>



                  <!-- <hr> -->



                  <hr>
                  <div class="animate__animated animate__fadeInDown" <?php echo $displayconfirmar;?>>

                    <form action="javascript:confirmarreserva()">
                      <button type="submit" class="btn btn-primary"
                        style="font-size: 18px; border: none; outline: none; box-shadow: 5px 5px 10px #0000001f; border-radius: 20px; padding: 5px 27px;">
                        <i class="fa fa-check"></i>&nbsp; Confirmar Reserva</button>

                      <input type="hidden" id="medico" value="<?php echo $usuario_id;?>">
                      <input type="hidden" id="especialidad" value="<?php echo $getespecialidad;?>">
                      <input type="hidden" id="sede" value="<?php echo $getsede;?>">
                      <input type="hidden" id="horario" value="<?php echo $gethorario;?>">
                      <input type="hidden" id="hora" value="<?php echo $getintervalo;?>">

                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>

      </section>




    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="dist/js/func.js"></script>
<script src="lib/bootbox/bootbox.js"></script>

<?php // include_once "scriptall.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
    
</body>
</html>
