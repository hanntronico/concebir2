<!DOCTYPE html>
<html>

<head>
    <?php $xajax->printJavascript('lib/'); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Medico</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/horario/css/style.css" />
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
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/datatables.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <style>
        .content-wrapper {
            background: white !important;
        }

        /* .js .cd-schedule__timeline li {
    height: 20px !important;
}*/
        .btn-warning,
        .btn-success {
            background: none !important;
            color: black !important;
            border: 0 !important;
        }

        .fa-times {
            display: none;
        }

        #reservar {
            position: relative;
            top: -15px;
        }

        #lblSedes {
            position: relative !important;
            top: -17px;
            font-size: 18px;
        }

        #contSedes {
            margin-top: 15px;
            position: relative;
            top: -27px;
        }

        .btn-reserved button {
            background: #76ce81 !important;
            color: white !important;
            border: none;
            box-shadow: 0px 11px 10px #0000001f;
        }

        button {
            outline: none;
        }
        
    </style>
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
                                <div class='col-md-3'>
                                    <div style='height: 200px'>
                                        <img src='arch/<?php echo $usuario_img;?>'
                                            style='max-height: 200px; border-radius: 50%; box-shadow: 3px 11px 16px #1f4e3626;'
                                            alt='<?php echo $usuario_nombre;?> <?php echo $usuario_apellido;?>'
                                            title='<?php echo $usuario_nombre;?> <?php echo $usuario_apellido;?>'>

                                    </div>
                                </div>
                                <div class='col-md-9'>
                                    <a>
                                        <h4 style='font-size: 22px'><?php echo $usuario_nombre;?>
                                            <?php echo $usuario_apellido;?></h4>
                                    </a>
                                    <hr>
                                    <a href='reservar?e=5&id=<?php echo $usuario_id;?>' class="btn-reserved">
                                        <button type='button' class='btn btn-primary'
                                            style='font-size: 17px; padding: 5px 27px; margin-top: 20px; border-radius: 20px; outline: none;'
                                            id="reservar"><i class='fa fa-calendar'></i> Reservar</button>
                                    </a>
                                    <hr>
                                    <h3 id="lblSedes">
                                        <i class="fa fa-building"></i> Sedes
                                    </h3>
                                    <div style="margin-top: 15px" id="contSedes">
                                        <?php echo $divsedes;?>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row" style="font-size: 1.25em;">
                    <div class='col-md-12'>
                        <div style='background: #FFF;'>
                            <div class='row'>
                                <div class='col-md-3'></div>
                                <div class='col-md-9'>
                                    <?php 
                                      if ($semana!="") {
                                        echo "Disponible : ".$semana; 
                                      }else{
                                        echo "Sin Horario";
                                      }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>


      <div class="js" style="position: relative; top: -91px;">
        <div class="cd-schedule cd-schedule--loading margin-top-lg margin-bottom-lg js-cd-schedule" style="background-color: white;">



<!--                     <div class="cd-schedule__timeline">
                        <ul>
                            <li><span>08:00</span></li>
                            <li><span>08:30</span></li>
                            <li><span>09:00</span></li>
                            <li><span>09:30</span></li>
                            <li><span>10:00</span></li>
                            <li><span>10:30</span></li>
                            <li><span>11:00</span></li>
                            <li><span>11:30</span></li>
                            <li><span>12:00</span></li>
                            <li><span>12:30</span></li>
                            <li><span>13:00</span></li>
                            <li><span>13:30</span></li>
                            <li><span>14:00</span></li>
                            <li><span>14:30</span></li>
                            <li><span>15:00</span></li>
                            <li><span>15:30</span></li>
                            <li><span>16:00</span></li>
                            <li><span>16:30</span></li>
                            <li><span>17:00</span></li>
                            <li><span>17:30</span></li>
                            <li><span>18:00</span></li>
                        </ul>
                    </div> -->
                    <!-- .cd-schedule__timeline -->

<!--                     <div class="cd-schedule__events">
                      <ul>
                        <?php //echo $semana; ?>
                      </ul>
                    </div> -->

<!--                     <div class="cd-schedule-modal">
                        <header class="cd-schedule-modal__header">
                            <div class="cd-schedule-modal__content">
                                <span class="cd-schedule-modal__date"></span>
                                <h3 class="cd-schedule-modal__name"></h3>
                            </div>

                            <div class="cd-schedule-modal__header-bg"></div>
                        </header>

                        <div class="cd-schedule-modal__body">
                            <div class="cd-schedule-modal__event-info"></div>
                            <div class="cd-schedule-modal__body-bg"></div>
                        </div>

                        <a href="#0" class="cd-schedule-modal__close text-replace">Close</a>
                    </div> -->

                    <div class="cd-schedule__cover-layer"></div>
                </div>
            </div>
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

    <!-- .cd-schedule -->
    <script src="bower_components/horario/js/util.js"></script>
    <!-- util functions included in the CodyHouse framework -->
    <script src="bower_components/horario/js/main.js"></script>

    <?php include_once "scriptall.php"; ?>

</body>

</html>