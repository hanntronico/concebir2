﻿﻿<!DOCTYPE html>
<html>

<head>
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reservar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
  
  
  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <style class="INLINE_PEN_STYLESHEET_ID">
    html, body {
  margin: 0;
  padding: 0;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  font-size: 14px;
}

#calendar {
  max-width: 900px;
  margin: 40px auto;
}
  </style>

  
</head>

<body class="hold-transition skin-blue sidebar-mini">
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
  var currentlocation= window.location.href;
  window.location.href= currentlocation+"&h="+month;
  //alert(month);
});
$("#day").change(function(){
  var day= $("#day").val();
  var currentlocation= window.location.href;
  window.location.href= currentlocation+"&dia="+day;
  //alert(day);
});
  $('#calendar').fullCalendar({
    themeSystem: 'bootstrap4',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listMonth'
    },
    weekNumbers: true,
    eventLimit: true, // allow "more" link when too many events
   // events: 'https://fullcalendar.io/demo-events.json'
  });

});


function myFunction() {
         var day= document.getElementById("month").value;
        alert (day);
}
  </script>
  <style>
      html, body {
  margin: 0;
  padding: 0;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  font-size: 14px;
}

#calendar {
  max-width: 900px;
  margin: 40px auto;
}

  </style>
  <!-- Site wrapper -->
  <div class="wrapper">

    <?php include_once "includeheader.php"; ?>

    <?php include_once "includesidebar.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top: -20px">


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class='col-md-12' style='margin-top: 15px'>
            <div style='background: #FFF; padding: 10px'>

              <div class='row'>
                <div class='col-md-3 animate__animated animate__fadeInDown'
                  style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 30px 0;" >
                  <div style='height: 200px'>
                    <img src='arch/<?php echo $usuario_img;?>'
                      style='max-height: 200px; border-radius: 50%; box-shadow: 3px 11px 16px #1f4e3626;'
                      alt='<?php echo $usuario_nombre;?> <?php echo $usuario_apellido;?>'
                      title='<?php echo $usuario_nombre;?> <?php echo $usuario_apellido;?>'>

                  </div>
                  <a>
                    <h4 style='font-size: 22px'><?php echo $usuario_nombre;?> <?php echo $usuario_apellido;?></h4>
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
                  <div <?php echo $displaysedes;?>>


                    <h3 class="animate__animated animate__fadeInDown">
                      <i class="fa fa-building"></i> Seleccione la Sede para la Reserva:
                    </h3>
                    <div class="animate__animated animate__fadeInDown" style="margin-top: 15px">
                    
                    
                      <?php echo $divsedes;?>
                    </div>

                  </div>
                </div>

                  <div style="padding-left: 26%;" <?php echo $displayfechas;?> >


                    <h3 class="animate__animated animate__fadeInDown" style="margin-top: 50px;">
                      <i class="fa fa-calendar"></i> Seleccione la fecha de su Reserva:
                    </h3>
                    <div class="animate__animated animate__fadeInDown" style="margin-top: 15px">
                    <input type="date" placeholder="Mes" id="month" />

                      <?php echo $divfecha;?>
                    </div>
                  </div>

                  <hr>
                  <div <?php //echo $displayhorarios;?>>


                    <h3 class="animate__animated animate__fadeInDown">
                      <i class="fa fa-clock-o"></i> Seleccione el horario de su Reserva:
                    </h3>
                    <div class="animate__animated animate__fadeInDown" style="margin-top: 15px">

                      <?php echo $divhoras;?>
                    </div>
                  </div>

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
        </div>


      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
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
  <?php include_once "scriptall.php"; ?>
 

<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
  <script id="INLINE_PEN_JS_ID">
    $(function () {

  $('#calendar').fullCalendar({
    themeSystem: 'bootstrap4',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listMonth' },

    weekNumbers: true,
    eventLimit: true, // allow "more" link when too many events
    events: 'https://fullcalendar.io/demo-events.json' });


});
    //# sourceURL=pen.js
  </script>

</body>

</html>