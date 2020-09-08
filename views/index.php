<!DOCTYPE html>
<html>
<head>
  <meta charset="euc-jp">
  <?php $xajax->printJavascript('lib/'); ?>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Clinica</title>
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

  <!-- New Design -->
  <link rel="stylesheet" href="dist/css/main.css">

  <link href="dist/img/logicon.png" rel="icon">
  <link rel="shortcut icon" href="dist/img/logicon.png">

  <script>
    window.__lc = window.__lc || {};
    window.__lc.license = 12032925;;
    (function (n, t, c) {
      function i(n) {
        return e._h ? e._h.apply(null, n) : e._q.push(n)
      }
      var e = {
        _q: [],
        _h: null,
        _v: "2.0",
        on: function () {
          i(["on", c.call(arguments)])
        },
        once: function () {
          i(["once", c.call(arguments)])
        },
        off: function () {
          i(["off", c.call(arguments)])
        },
        get: function () {
          if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
          return i(["get", c.call(arguments)])
        },
        call: function () {
          i(["call", c.call(arguments)])
        },
        init: function () {
          var n = t.createElement("script");
          n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js", t.head
            .appendChild(n)
        }
      };
      !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
    }(window, document, [].slice))
  </script>
  <noscript><a href="https://www.morangesoft.com/" rel="nofollow">Chat with us</a>, powered by <a
      href="https://www.morangesoft.com/" rel="noopener nofollow" target="_blank">Morangesoft</a></noscript>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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

    .btn-animation,
    .btn-animation i,
    .btn-animation p {
      display: flex;
      justify-content: space-around;
      align-items: center;
      transition: all ease-in-out .2s;
      position: relative;
    }

    .btn-animation:hover p {
      transform: scale(0);
    }

    .btn-animation:hover i {
      margin-right: 40%;
    }

    .login-page {
      background: url('./dist/img/design/bg-home.png') no-repeat !important;
      background-size: cover !important;
      background-position: top right !important;
      background-attachment: fixed !important;
    }

    .login-box {
      margin: 10px 10% !important;
    }

    .sign-up {
      cursor: pointer;
      transform: rotateX(0);
    }
  </style>
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
</head>

<body class="login-page">

  <div class="login-box">

    <!-- Log In -->
    <div class="login-box-body box-log-in animate__animated animate__flipInY" style="margin-top: 60px;">
      <p class="login-box-msg">

        <div style="display: flex; justify-content: center; align-items: center; margin-top: 25px;">
          <img width="60" src="dist/img/logo.png" class="img-responsive" style="max-height: 135px; ">
          <h3 style="margin-left: 10px;">Bienvenida</h3>

        </div>
      </p>

      <form action="javascript:ingresarusuario()" style="margin-top: 30px">
        <center>
          <?php echo $info; ?>
        </center>

        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Escribe tu Correo" required="required" id="usuario"
            value="admin">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback" style="">
          <input type="password" class="form-control" placeholder="Escribe tu Clave" required="required" id="clave"
            value="admin">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
          <div class="col-xs-12 password" style="text-align: right;">
            <a href="olvidoclave">Recuperar contraseña</a><br><br>
          </div>

          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" id="btnentr" class="btn-lg btn-animation morangesoft-background-primary 
                btn-block text-uppercase">
              <p style="margin: 0;">Acceder</p>
              <i class="fa fa-arrow-right"></i>
            </button>
          </div>

          <div class="col-xs-12 create-account" style="text-align: center; margin: 10px 0;">
            <span class="sign-up" style="font-size: 17px; color: #000">
              ¿No tienes una cuenta? <br>
              <strong>Registrate ahora</strong>
            </span>
            <br><br>
          </div>

        </div>
      </form>

    </div>
    <!-- End Log In -->


    <!-- Sign Up -->
    <div class="login-box-body box-sign-up animate__animated animate__flipInY" style="margin-top: 60px;">

      <p class="login-box-msg">

      </p>

      <form action="javascript:registrarusuario2()" style="margin-top: 30px">
        
        <center>
          <?php echo $info; ?>
        </center>
        <div>

          <!-- Step 1 -->
          <div class="step-1 animate__animated" style="padding-bottom: 30px;">

            <h4>
              <i class="fa fa-arrow-left close-sign-up" style="cursor: pointer;"></i>&nbsp;
              Ingresa tus datos
            </h4>
            <hr>
            <div>
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Escribe tu email" name="email" required="required"
                  id="email">
              </div>
            </div>
            <div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Escribe tu contraseña" name="password"
                  required="required" id="clave">
              </div>
            </div>

            <button type="submit" id="btnentr" class="btn-animation rounded-pill btn-lg morangesoft-background-primary
                btn-block text-uppercase next" style="margin-top: 40px;">
              <p style="margin: 0;">Siguiente</p>
              <i class="fa fa-arrow-right"></i>
            </button>
          </div>

          <!-- Step 2 -->
          <div class="step-2 animate__animated">

            <h4 style="margin-top: 20px !important;">
              <i class="fa fa-arrow-left prev" style="cursor: pointer;"></i>&nbsp;
              Ingresa tus datos
            </h4>
            <hr>
            <div>
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Escribe tus nombres" name="name"
                  required="required" id="nombre">
              </div>
            </div>
            <div>
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Escribe tus apellidos" name="lastname"
                  required="required" id="apellido">
              </div>
            </div>

            <div class="form-group ">
              <select id="tipo-documento" class="form-control required" name="tipo-documento">
                <option value="0" selected>Tipo de documento</option>
                <option value="1">DOCUMENTO NACIONAL DE IDENTIDAD(DNI)</option>
                <option value="2">CARNET DE EXTRANJERIA</option>
                <option value="3">PASAPORTE</option>
              </select>
            </div>


            <div>
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Nro de Documento" required="required"
                  name="documento" id="documento">
              </div>
            </div>

            <div>
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Escribe tu número de celular" name="phone"
                  required="required" id="celular">
              </div>
            </div>

            <div class=" form-group">
              <input type="text" placeholder="Fecha de nacimiento" class="form-control" id="f-nacimiento"
                name="f-nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                data-inputmask-placeholder="DD/MM/AAAA">
            </div>

            <div class="row">
              <div style="margin: 15px 0;">
                <button type="submit" id="btnentr" class="btn-animation rounded-pill btn-lg morangesoft-background-primary
                btn-block text-uppercase">
                  <p style="margin: 0;">Regístrate</p>
                  <i class="fa fa-send"></i>
                </button>
              </div>
            </div>


          </div>

        </div>

      </form>

    </div>
    <!-- End Sign Up -->






  </div>
  <!-- /.login-box -->

  <!-- Start of ChatBot (www.chatbot.com) code -->
  <script type="text/javascript">
    window.__be = window.__be || {};
    window.__be.id = "5ef37e585eb72900076526af";
    (function () {
      var be = document.createElement('script');
      be.type = 'text/javascript';
      be.async = true;
      be.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.chatbot.com/widget/plugin.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(be, s);
    })();
  </script>



  <!-- End of ChatBot code -->
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function () {
      $('.box-sign-up').hide()
      $('.step-2').hide()
      $('.sign-up').click(function (e) {
        e.preventDefault();
        $('.box-sign-up').show();
        $('.box-log-in').hide();
      });
      $('.close-sign-up').click(function (e) {
        e.preventDefault();
        $('.box-sign-up').hide();
        $('.box-log-in').show();
      });
      $('.next').click(function (e) {
        e.preventDefault();

        const elemts = new Array($('.step-1').find('input').val());
        elemts.map((element) => {
          if (element == '') {
            swal('Error!', 'Se requiere llenar todos los campos', 'error')
          } else {
            $('.step-2').show();
            $('.step-1').hide();
          }
        });

      });
      $('.prev').click(function (e) {
        e.preventDefault();
        $('.step-1').show();
        $('.step-2').hide();
      })
    });
  </script>

  <script src="dist/js/func.js"></script>
  <script src="lib/bootbox/bootbox.js"></script>
</body>

</html>