<!DOCTYPE html>
<html>
<head>
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registro</title>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.0-beta.87/css/inputmask.css">

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

<div class="login-box" style="width: 600px">
  
  <!-- /.login-logo -->
  <div class="login-box-body" style="margin-top: 60px">  
    <p class="login-box-msg">
      
      <center>
        <a>
          <img src="dist/img/logo.png" class="img-responsive" style="max-height: 135px; ">
        </a>
      </center>
    </p>

    <form action="javascript:registrarusuario2()" style="margin-top: 30px">
      <center>
        <?php echo $info; ?>
      </center>      
      <div class="row">
          
        <h4>
            Mi cuenta:
        </h4>
        <hr>
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Escribe tu email" name="email" required="required" id="email" >              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Escribe tu contraseña" name="password" required="required" id="clave" >              
            </div>
        </div>        
        
        <h4>
            Mis datos:
        </h4>
        <hr>
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Escribe tus nombres" name="name" required="required" id="nombre" >              
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Escribe tus apellidos" name="lastname" required="required" id="apellido" >              
            </div>
        </div>
        
        <div class="form-group col-md-6">
          <select id="tipo-documento" class="form-control required" name="tipo-documento" id="tipo-documento" >
            <option value="0" selected>Tipo de documento</option>
            <option value="1" >DOCUMENTO NACIONAL DE IDENTIDAD(DNI)</option>
            <option value="2">CARNET DE EXTRANJERIA</option>
            <option value="3">PASAPORTE</option>
          </select>
        </div>
        
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Nro de Documento" required="required" name="documento" id="documento" >              
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Escribe tu número de celular" name="phone" required="required" id="celular" >              
            </div>
        </div>
        
        <div class="col-md-6 form-group">
            <input type="text" placeholder="Fecha de nacimiento" class="form-control" id="f-nacimiento" name="f-nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="DD/MM/AAAA">
        </div>
            <hr>
        <div class="col-md-6" style="display: none;">
            <p>¿Padecede de Alergias o Enfermedades?</p>
            <div class="custom-control custom-radio">
              <input type="radio" id="q-1-rdb-1" name="question-1" value="si" class="custom-control-input" >
              <label class="custom-control-label" for="q-1-rdb-1">Si</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="q-1-rdb-2" name="question-1" value="no" class="custom-control-input" checked>
              <label class="custom-control-label" for="q-1-rdb-2">No</label>
            </div>
        </div>
        
        <div class="form-group col-md-6" id="question-1-selected" style="display: none;">
            <label for="description-question-1">¿Cuales son?</label>
            <textarea class="form-control" id="description-question-1" rows="3" value=""></textarea>
        </div>
        
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Pais de nacimiento" name="pais-nacimiento" required="required" id="pais-nacimiento" >
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Ciudad de nacimiento" name="ciudad-nacimiento" required="required" id="ciudad-nacimiento" >
            </div>
        </div>
        
        <div class="col-md-6" style="display: none;">
            <p>¿Cuenta con seguro?</p>
            <div class="custom-control custom-radio">
              <input type="radio" id="q-2-rdb-1" name="question-2" value="si" class="custom-control-input" >
              <label class="custom-control-label" for="q-2-rdb-1">Si</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="q-2-rdb-2" name="question-2" value="no" class="custom-control-input" checked>
              <label class="custom-control-label" for="q-2-rdb-2">No</label>
            </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6" style="margin-top: 15px">
            <button type="submit" id="btnentr" class=" rounded-pill btn-lg morangesoft-background-primary
                btn-block text-uppercase">REGISTRATE</button>    
        </div>
        <div class="col-md-6" style="margin-top: 15px">
            <a href="./">
              <button type="button" id="btnentr" class=" rounded-pill btn-lg morangesoft-background-primary
                btn-block text-uppercase">INICIAR SESION</button>    
            </a>
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
<script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.0-beta.87/dist/jquery.inputmask.min.js"></script>
<script>

    $(document).ready(function() {
        $(":input").inputmask();
        $("input[name$='question-1']").click(function() {
            var yes_or_no = $(this).val();
            console.log(yes_or_no)
            if(yes_or_no === "si"){
                
                $("#question-1-selected").attr("required","required");
                $("#question-1-selected").css("visibility","visible");
                
            }else{
                $("#question-1-selected").removeAttr("required");
                $("#question-1-selected").css("visibility","hidden");
                
            }
        });
        
        $("input[name$='question-2']").click(function() {
            var yes_or_no = $(this).val();
            //console.log(yes_or_no)
            if(yes_or_no === "si"){
                $("#question-2-selected").css("visibility","visible");
                $("#question-2-selected").attr("required","required");
            }else{
                
                $("#question-2-selected").css("visibility","hidden");
                $("#question-2-selected").removeAttr("required");
                
            }
        });
    });
</script>

</body>
</html>
