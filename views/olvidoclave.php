<!DOCTYPE html>
<html>
<head>
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Olvido de Clave</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

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

  <style type="text/css">
    .form-control {
      background-color: transparent !important;
      border: 1px solid #ced4da !important;
      border-radius: 0 !important;
      border: 0px !important;
      border-bottom: 1px solid green !important;
      font-size: 15px;
      min-height: 48px;
      font-weight: 500;
  }

   .morangesoft-background-primary {
      background: #1B8FC8;
      border-color: #058FD2;
      color: #fff;
      font-size: 15px;
      font-weight: 600;
      min-height: 48px;
  }
  </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body" style="margin-top: 100px">  

    <p class="login-box-msg">
      
      <center>
        <a href="../">
          <img src="dist/img/logo.png" class="img-responsive" style="max-height: 135px; ">
        </a>
      </center>
    </p>
    <p class="login-box-msg">
      
      <h3 style="text-align: center; font-size: 16px; color: #000; font-weight: bold;">Olvidaste tu Clave</h3>
      <hr>
    </p>

    <form action="index" method="GET" style="margin-top: 30px">
      <center>
        <?php echo $info; ?>
      </center>      
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Escribe tu Correo" required="required" id="usuario" name="email" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>      
      <div class="row">        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" id="btnentr" class=" rounded-pill btn-lg morangesoft-background-primary
                btn-block text-uppercase">RECUPERAR</button>	  
        </div>      
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="dist/js/func.js"></script>
<script src="lib/bootbox/bootbox.js"></script>

</body>
</html>
