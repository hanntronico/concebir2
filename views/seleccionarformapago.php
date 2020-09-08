<!DOCTYPE html>
<html>
<head>
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Seleccionar Forma de Pago </title>
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
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <div class="row">   
        <div class='col-md-12'>
            <h3>Por favor espera a la confirmación del call center para realizar el pago. Si el call center ya se contactó contigo y confirmó tu cita, puedes proceder con el pago. </h3>  
        </div>             
      </div>  
  

      <div class="row" style="margin-top: 20px;">          
          <div class='col-lg-4 col-md-6' style='margin-bottom: 15px;'>
            <div class='package-content bg-light border text-center p-2 my-2 my-lg-0' style='background: #FFF; padding: 20px'>
                <div class='package-content-heading border-bottom' style="border: none;">
                    <a href='confirmarpago?f=1&id=<?php echo $getcita;?>'>
                      <center>
                          <img src='dist/img/culqi.png' class='img-responsive' style='height:90px' />
                      </center>                         
                    </a>
                </div>            
                <a href='confirmarpago?f=1&id=<?php echo $getcita;?>' class='btn btn-primary' style='margin-top: 5px'>Seleccionar</a>
            </div>
        </div>
<!--          <div class='col-lg-4 col-md-6' style='margin-bottom: 15px; display: none;'>
            <div class='package-content bg-light border text-center p-2 my-2 my-lg-0' style='background: #FFF; padding: 20px'>
                <div class='package-content-heading border-bottom'>
                    <a href='confirmarpago?f=2&id=<?php //echo $getcita;?>'>
                      <center>
                          <img src='dist/img/paypal.png' class='img-responsive' style='height:90px' />
                      </center>                         
                    </a>
                </div>            
                <a href='confirmarpago?f=2&id=<?php //echo $getcita;?>' class='btn btn-primary' style='margin-top: 5px'>Seleccionar</a>
            </div>
        </div> -->

         <div class='col-lg-4 col-md-6' style='margin-bottom: 15px;'>
            <div class='package-content bg-light border text-center p-2 my-2 my-lg-0' style='background: #FFF; padding: 20px'>
                <div class='package-content-heading border-bottom' style="border: none;padding: 20px;">
                    <a href='confirmarpago?f=2&id=<?php echo $getcita;?>'>
                      <center>
                          <img src='dist/img/visanet.png' class='img-responsive'  />
                      </center>                         
                    </a>
                </div>            

                <a href='confirmarpago?f=2&id=<?php echo $getcita;?>' class='btn btn-success' style='margin-top: 5px'>Seleccionar</a>

<!-- <a target="_blank" href="https://www.visanetlink.pe/pagoseguro/VENTASDEPRODUCTOSONLINE/660833"><button style="padding: 10px 16px; line-height: 1.3333333; border-radius: 6px;  -moz-border-radius: 5px;   -webkit-border-radius: 5px; color: #fff;background-color: #0054cb;">Seleccionar</button></a> -->



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
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
