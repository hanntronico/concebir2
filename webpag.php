<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Buscar Medicos</title>
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />

	<style>
		.card-medical {

			background: #FFF;
			padding: 30px 20px;
			// border: 1px solid;
			width: 100%;
			max-width: 400px;
			height: 500px;
			border-radius: 5px; 
			box-shadow: 10px 10px 20px #00000012;

		}

		.btn-medical button {
			width: 100%;
			border-radius: 20px;
		}
		.btn-reserved button i {
			transition: all ease-in-out .2s;
		}

		.btn-reserved button {
			transition: all ease-in-out .2s;
			background: #76ce81 !important;
			color: white !important;
			border: none;
			box-shadow: 0px 11px 10px #0000001f;
		}

		.btn-more-information button {
			border: none;
			margin-top: 10px;
		}

		.btn-animation, .btn-animation i, .btn-animation span{
			display: flex;
			justify-content: center;
			align-items: center;
			transition: all ease-in-out .2s;
			position: relative;
		  }
		  .btn-animation:hover {
			  transform: translateY(3px);
			  box-shadow: none;
		  }
		  .btn-animation:hover span {
			transform: scale(0);
		  }
		  
		  .btn-animation:hover i{
			right: 48%;
			position: absolute;
		  }
	</style>
</head>

<body>
	
<div class="wrapper">
	

  <div class="content-wrapper" style="margin-top: 20px">
  
  hanntronic

    <!-- Main content -->
    <section class="content">
<!--         <div class="row">
          <div class="col-md-12">
            <h4 style="line-height: 30px; font-weight: 600">Seleccione el Doctor</h4>
          </div>
        </div> -->

<!--         <div class="row">
					<div class='col-md-4 col-sm-6 col-xs-12' style='margin: 20px 0 40px 0; display: flex; justify-content: center;'>
							<div class='card-medical animate__animated animate__flipInX' style='animation-delay: .".$animation_delay."s;'>              
									<div class='row'> -->
										
<!-- 							      <div class='col-sm-12'>
							        <div style='height: 200px; display: flex; justify-content: center;'>
								        <a href='medico?e=5&id=$usuario_id'>
								              <img src='arch/5efcb1b93b1d8.jpg' style='max-width: 100%; max-height: 200px; border-radius: 50%; box-shadow: 3px 11px 16px #1f4e3626;' alt='5efcb1b93b1d8.jpg' title='5efcb1b93b1d8.jpg'>
								            </a>	
							        </div>
									  </div> -->
											

							        <!-- <div class='col-sm-12'> -->
<!-- 							          <a href='medico?e=5&id=$usuario_id'>
							            <h4 style='font-size: 22px; text-align: center; padding: 20px 0;'>Andrea Delgado</h4>
							          </a>
							          <hr> -->
							          <!-- <div class='row'> -->
<!-- 							            <div class='col-sm-12' style='margin-top: 10px'>
							              <a href='reservar?e=5&id=$usuario_id' class='btn-medical btn-reserved'>
											<button type='button' class='btn btn-primary btn-animation' style='font-size: 17px'>
											 <span style='margin-right: 8px;'>Reservar</span>
											 <i class='fa fa-calendar' style='color: white !important;'></i>
											</button>
							              </a>
							            </div> -->

<!-- 							            <div class='col-sm-12' style='margin-top: 10px'>
							              <a href='medico?e=5&id=$usuario_id' class='btn-medical btn-more-information'>
											<button type='button' class='btn btn-success btn-animation' style='font-size: 17px'>
											<span style='margin-right: 8px;'>Ver Más</span>
											<i class='fa fa-list'></i>
											</button>
							              </a>
							            </div> -->
							            
							          <!-- </div> -->
							          <!-- end row -->
											<!-- </div> -->
											<!-- end col -->
											

<!-- 							      </div>
							    </div>
							  </div>
			        </div> -->
      

    </section>
    <!-- /.content -->
  </div>




</div>  











</body>
</html>