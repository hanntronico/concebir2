<!DOCTYPE html>
<html>
<head>
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Horio de trabajo</title>
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">



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

          <?php echo $info;?>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">                
                <div class="row">
                  <div class="col-md-8 col-xs-6">
                    <h3 class="box-title"><i class="fa fa-user-md"></i> Médicos</h3>
                  </div>
                  <div class="col-md-4 col-xs-6" style="text-align: right;">
                      
                    <a href="modificar-horario-trabajo?id_medico=<?php echo $getid;?>">
                      <button type="button" class="btn btn-success">+ Agregar horario</button>
                    </a>                 
                  </div>
                  
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabla" class="table table-bordered table-striped" style='font-size: 14px; width: 100%'>
                <thead>
                <tr >                               
                  <th>Id</th>                  
                  <th>Descripción</th>
                  <th>Activo</th>                  
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php echo $textohtml;?>
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>

         


          <!-- Input addon -->
        

        </div>
       
      </div>

      

      

      
      <!-- /.row -->
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
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="dist/js/func.js"></script>
<script src="lib/bootbox/bootbox.js"></script>




<script>
  $(function () { 
    $('#daterangepicker').daterangepicker(
      {
        locale: {
          format: 'DD/MM/YYYY'
        },
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
          'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
        //,startDate: moment().subtract(29, 'days'),
        //endDate  : moment()
      }
    )

    $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
      var startDate = picker.startDate;
      var endDate = picker.endDate;

      $("#bntSubmitSearch").click();
      //alert("New date range selected: '" + startDate.format('YYYY-MM-DD') + "' to '" + endDate.format('YYYY-MM-DD') + "'");
    });

    $('#tabla').DataTable({     
      "scrollX": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }      
    })

  })
</script>
<?php include_once "scriptall.php"; ?>

</body>
</html>
