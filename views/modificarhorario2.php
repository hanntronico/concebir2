<!DOCTYPE html>
<html>
<head>
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Horario</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link href="dist/img/logicon.png" rel="icon">
<link rel="shortcut icon" href="dist/img/logicon.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  

  <?php include_once "includeheader.php"; ?>
  
  <?php include_once "includesidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <section class="content">
      

      
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <?php echo $infotexto;?>
            <div class="box-header with-border">
               
              <div class="row">
                <div class="col-md-12">
                  <h3 class="box-title" style="line-height: 25px"><i class="fa fa-calendar"></i> Horario </h3>
                </div>
                
              </div>
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form target='iframeupload'  action="uploadhorario" enctype="multipart/form-data" method="POST">
              <div class="box-body">               
                <div class="row" style="margin-top: 15px">                                       
                    <div class="form-group col-md-3">
                        <label for="medico">Medico: <span style="color: red">*</span></label>
                        <select class="form-control" name="medico" id="medico">
                            <?php echo $optionmedico;?>
                        </select>
                    </div>                     
                    <div class="form-group col-md-3">
                        <label for="fecha">Fecha Inicio: <span style="color: red">*</span></label>                        
                            <input type="text" class="form-control pull-right datepicker" id="fecha" name="fecha" value="<?php echo $horario_fecha;?>" required="required" placeholder="dd/mm/aaaa">
                        
                    </div>
                     <div class="form-group col-md-3">
                        <label for="fecha">Fecha Fin: <span style="color: red">*</span></label>                        
                            <input type="text" class="form-control pull-right datepicker" id="fechafin" name="fechafin" value="<?php echo $horario_fecha_fin;?>" required="required" placeholder="dd/mm/aaaa">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="fecha">Hora Inicia: <span style="color: red">*</span></label>
                        
                            <input type="text" class="form-control pull-right timepicker" id="horaini" name="horaini" value="<?php echo $horaini;?>" placeholder="hh:mm" required="required">
                        
                    </div> 

                     <div class="form-group col-md-3">
                        <label for="fecha">Hora Finaliza: <span style="color: red">*</span></label>
                        
                            <input type="text" class="form-control pull-right timepicker" id="horafin" name="horafin" value="<?php echo $horafin;?>" placeholder="hh:mm" required="required">
                        
                    </div> 
                   <div>
                    <div class="form-group col-md-3">
                        <label for="dia_inicio">Dia Inicio: <span style="color: red"></span></label>
                        <select class="form-control" name="dia_inicio" id="dia_inicio">
                            <?php echo $option_days;?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dia_fin">Dia Fin: <span style="color: red"></span></label>
                        <select class="form-control" name="dia_fin" id="dia_fin">
                            <?php echo $option_days;?>
                        </select>
                    </div>
                    
                     <div class="form-group col-md-3">
                        <label for="sede">Sede: <span style="color: red"></span></label>
                        <select class="form-control" name="sede" id="sede">
                            <?php echo $optionsede;?>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-3">
                      <label for="horario_intervalo">Intervalo de Minutos Cita: <span style="color: red"></span></label>
                      <input type="number" class="form-control" id="horario_intervalo" name="horario_intervalo" placeholder="Intervalo de Minutos Cita" value="<?php echo $horario_intervalo;?>">
                    </div>  
                    </div> 
                </div>                        
              </div>

              <div class="box-footer">
                <center>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </center>
              </div>
              <input type="hidden" class="form-control" id="horario_id" name="horario_id" value="<?php echo $horario_id;?>" >
            </form>
          </div>
          <!-- /.box -->

         

         <iframe id="iframeupload" name="iframeupload" height="0" width="0" style="display: none;"></iframe>
         


          <!-- Input addon -->
        

        </div>
       
      </div>

      

      
    </section>
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
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="dist/js/func.js"></script>
<script src="lib/bootbox/bootbox.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {

    $('.select2').select2();

    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,      
      format: 'dd/mm/yyyy'
    })

    $('.timepicker').timepicker({
      showInputs: false,
      showMeridian: false
    })


  })
</script>


<script>
  $(function () {
    

    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,      
      format: 'dd/mm/yyyy'
    })

  })
</script>
<?php include_once "scriptall.php"; ?>

</body>
</html>
