<?php

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

if($perfil == '2'){
    $BTN_sala = <<<XML
<a href="salas/sala_26.php" style="cursor: pointer; float: left; margin-left: 5px">
    <button type="button" class="btn btn-success">Ir a mi sala</button>
</a>
XML;
} else if ($perfil == '3'){
    $BTN_sala = <<<XML
<a href="salas/sala_26.php" style="cursor: pointer; float: left; margin-left: 5px">
    <button type="button" class="btn btn-success">Ir a mi cita</button>
</a>
XML;
}


?>
<script>
  window.__pushpro = {
    site_uuid: "9d559833-c424-49ff-9fba-59e1c1d60ac7"
  }
</script>
<script src="https://storage.googleapis.com/push-pro-java-scripts/pushpro-lib.js"></script>

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
<noscript><a href="https://www.morangesoft.com/chat-with/12032925/" rel="nofollow">Chat with us</a>, powered by <a
    href="https://www.morangesoft.com" rel="noopener nofollow" target="_blank">Morangesoft</a></noscript>

<head>
  <link rel="stylesheet" href="dist/css/main.css">
</head>

<header class="main-header">
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->



    <!-- <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> -->
      <!-- <span class="sr-only"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span> -->
    <!-- </a> -->


<!--     <div class="row" style="padding: 30px;">
      <div class="col-md-4">
        hann              
      </div>
      <div class="col-md-4 text-center">
          <a href="panel">
            <img src="dist/img/logo2.png" height="100%" class="imglogobar">
          </a>
      </div>
      <div class="col-md-4">
        hann              
      </div>
    </div> -->


    <div class="main-img">

      <div>
        <a onclick="javascript:history.back()" class="back-button" style="cursor: pointer; float: left; margin-left: 5px">
          <button type="button" class="btn"><i class="fa fa-angle-left"></i>&nbsp;&nbsp;Atras</button>
        </a>

        <?php echo $BTN_sala;?>
      </div>

      <div style="text-align: center;">
        <a href="panel" class="img-logo">
          <img src="dist/img/logo2.png" height="100%" class="imglogobar">
        </a>
      </div>


      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="arch/<?php echo $imguser;?>" class="user-image" alt="<?php echo $login;?>">
              <span class="hidden-xs"><?php echo $login;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="arch/<?php echo $imguser;?>" class="img-circle" alt="<?php echo $login;?>">

                <p>
                  <?php echo $login;?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="micuenta" class="btn btn-default btn-flat">Mi Cuenta</a>
                </div>
                <div class="pull-right">
                  <a href="index?s=1" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>

      </div>

    </div>

  </nav>
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
</header>