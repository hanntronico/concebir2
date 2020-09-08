<!DOCTYPE html>
<html>
<head>
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Confirmar Pago </title>
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

    <!-- Incluye Culqi Checkout en tu sitio web-->
    <script src="https://checkout.culqi.com/js/v3"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  

  <?php include_once "includeheader.php"; ?>

  <?php include_once "includesidebar.php"; ?>

  

  <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

    <section class="content">
      <div class="row">   

        <div class='col-md-12'>
            <h4>Id Cita: <?php echo $cita_id;?></h4> 
            <h4>Precio: <?php echo $cita_preciomostrar;?></h4>  
        </div>       
      </div>      
        <form target='iframeupload' action="uploadpagocita.php" enctype="multipart/form-data" method="POST">
            <div class="row" style="margin-top: 0px">
                <div class='col-md-3'  style="margin-top: 15px">
                  <div class='package-content bg-light border text-center p-2 my-2 my-lg-0' style='background: #FFF;'>
                    <div style="background: #3c8dbc; padding: 5px">
                        <label for="plan_id" style="font-size: 18px; color: #FFF; font-weight: 600">Forma de Pago</label>  
                    </div>
                   
                    <div>
                      <form name="myform" style="margin-top: 30px">
                        <div id="mensaje" style="color: red; font-size: 16px; text-align: center;">
                              
                            </div>
                        <center>
                              <button type="button" style="background: transparent; border: 0px solid #FFF; cursor: pointer;">
                                <img src="<?php echo $formapagoimg;?>" style="padding: 20px;" class="img-responsive">  
                              </button>
                              <br>                              




<?php if ($getformapago=="1"){ ?>

  <button type="button" id="comprarculqi"  style="background: orange; border: 0px solid #FFF; cursor: pointer; padding: 7px 17px; color: #fff; font-size: 17px; border-radius: 5px">
    Pagar
  </button> 
  
<?php }elseif($getformapago=="2"){ ?>
  <a target="_blank" href="https://www.visanetlink.pe/pagoseguro/VENTASDEPRODUCTOSONLINE/660833" style="padding: 10px 16px; line-height: 1.3333333; border-radius: 6px;  -moz-border-radius: 5px;   -webkit-border-radius: 5px; color: #fff;background-color: #0054cb; font-weight: bolder;">
Seleccionar</a>  
<?php } ?>

<!-- <a target="_blank" href="https://www.visanetlink.pe/pagoseguro/VENTASDEPRODUCTOSONLINE/660833"><button style="padding: 10px 16px; line-height: 1.3333333; border-radius: 6px;  -moz-border-radius: 5px;   -webkit-border-radius: 5px; color: #fff;background-color: #0054cb; font-weight: bolder;">Seleccionar</button></a>       --> 
                      
                              <br><br>
                              </center>

                            </form> 


                            <form id='formact' name='formact' action='procesarpagoculqi.php' method='post' enctype='multipart/form-data' >
                              <input type="hidden" name="cita_id" id="cita_id" value="<?php echo $cita_id;?>">                                
                              <input type="hidden" name="token" id="token">  

                              <button type="submit" style="display: none;">
                                Ejecutar
                              </button>
                            </form> 
                    </div>                   
                  </div>
                </div>
          
                <div class='col-md-4' id="div_infopago" <?php echo $displayinfopago ?> >
                    <div class='package-content bg-light border  p-2 my-2 my-lg-0' style='background: #FFF;'>
                      <div style="background: #3c8dbc; text-align: center; padding: 5px">
                        <label for="plan_id" style="font-size: 18px; color: #FFF; font-weight: 600">Información para el Pago</label>  
                      </div>
                      <div style="padding: 0px 10px 10px 10px; font-size: 16px"> 
                          
                          <?php echo $infopago ?>
                       
                      </div>
                    </div>
                </div>

                <div class='col-md-4' id="div_infopago6_2"  style="display: none;"> <?php echo $displayformapago6;?>>
                  <div class='package-content bg-light border p-2 my-2 my-lg-0' style='background: #FFF;'>
                    <div style="background: #3c8dbc; text-align: center; padding: 5px ">
                      <label for="plan_id" style="font-size: 18px; color: #FFF; font-weight: 600">Anexar Comprobante</label>  
                    </div>

                    <div class="box-body" style="padding: 10px">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="referencia">Monto Pagado <span style="color: red">*</span></label>
                                <input type="number" class="form-control" id="monto" name="monto" placeholder="Ej: 10" required="required" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="referencia">Referencia <span style="color: red"></span></label>
                                <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Ej: 23823238" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="usuario_fechanac">Fecha de Pago: <span style="color: red">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right datepicker" id="fechapago" name="fechapago" placeholder="dd/mm/aaaa" required="required" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="referencia">Observaciones <span style="color: red"></span></label>
                                <textarea type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones del Pago" autocomplete="off"></textarea>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-3" style="text-align: right;">
                                <label for="file1" style="cursor: pointer;">
                                  <img src="arch/0.jpg" style="height: 60px">
                                </label>
                                <br />
                            </div>
                            <div class="col-lg-9">
                                <label class="control-label" for="file1"> Cargar Comprobante </label>
                                <div class='form-group ' style='overflow: hidden; '>
                                    <input type='file' id='file' name='file1' accept="image/*" >
                                    <br>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                   

                    <div class="row">
                        <input type="hidden" id="formapago_id" name="formapago_id" value="<?php echo $formapago_id;?>">
                        <input type="hidden" id="moneda" name="moneda" value="<?php echo $l_moneda_id;?>">
                        <input type="hidden" name="plan_id" value="<?php echo $plan_id;?>">

                        
                            <center>
                                <button type="submit" class="btn btn-success" style="font-size: 16px; ">Confirmar Pago</button>
                            </center>
                            <br>
                        

                    </div>
                  </div>
                    <!-- /.box-body -->


                    
                </div>
            </div>
        </form>

        <iframe id="iframeupload" name="iframeupload" height="0" width="0"></iframe>


    </section>
    <!-- /.content -->
  </div>


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

<script>
                                      
    function confirmarpago(){       
      document.getElementById("mensaje").innerHTML = "Procesando el pago... Por favor espere...<br><br>";
      document.formact.submit();
      /*
          if (confirm('Estas seguro que quieres subir procesar este pago?')) { 
              
          }                                                                   
        */
    }

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

    <script>
          // Configura tu llave pública
          Culqi.publicKey = 'pk_test_7JC9LIOwrcJJZehi';  

          //pk_test_7JC9LIOwrcJJZehi
          //pk_live_UgKJVzm5hpmf9SfV                       
          
          // Configura tu Culqi Checkout
          Culqi.settings({
              title: 'Pago Cita',
              currency: 'PEN',
              description: 'Pago Cita',
              amount: <?php echo $cita_precioculqi;?>
          });
          // Usa la funcion Culqi.open() en el evento que desees
          $('#comprarculqi').on('click', function(e) {            
              // Abre el formulario con las opciones de Culqi.settings
              Culqi.open();
              e.preventDefault();
          });

          function culqi() {
            if (Culqi.token) { // ¡Objeto Token creado exitosamente!
                var token = Culqi.token.id;
                document.getElementById("token").value = token;
                confirmarpago();
                //alert('Se ha creado un token:' + token);
            } else { // ¡Hubo algún problema!
                // Mostramos JSON de objeto error en consola
                console.log(Culqi.error);
                alert(Culqi.error.user_message);
            }
          };
      </script>
    
</body>
</html>
