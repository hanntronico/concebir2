<?php

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

if ($perfil=="1"){ // Administrador
  $menu = "
    <li style='padding-top: 20px;' class='animate__animated animate__fadeInLeft'>
      <a href='panel'>
        <i class='fa fa-dashboard'></i> Bienvenido
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 100ms;'>
      <a href='filtrosedes'>
        <i class='fa fa-search'></i> Buscar Medicos por Sede
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 120ms;'>
      <a href='buscar-medicos'>
        <i class='fa fa-search'></i> Ver todos los Medicos 
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 140ms;'>
      <a href='citas'>
        <i class='fa fa-calendar'></i> Citas
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 160ms;'>
      <a href='pagos'>
        <i class='fa fa-money'></i> Pagos
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 180ms;'>
      <a href='horarios'>
        <i class='fa fa-list'></i> Horarios
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 200ms;'>
      <a href='medicos'>
        <i class='fa fa-user-md'></i> Médicos
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 220ms;'>
      <a href='pacientes'>
        <i class='fa fa-users'></i> Paciente
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 240ms;'>
      <a href='especialidades'>
        <i class='fa fa-list'></i> Especialidades
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 260ms;'>
      <a href='sedes'>
        <i class='fa fa-list'></i> Sedes
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='padding-bottom: 20px; animation-delay: 280ms'>
      <a href='./?s=1'>
        <i class='fa fa-sign-out'></i> Salir
      </a>
    </li>
  ";
}else if ($perfil=="2"){ // Medicos
  $menu = "
    <li style='padding-top: 20px;' class='animate__animated animate__fadeInLeft'>
      <a href='panel'>
        <i class='fa fa-dashboard'></i> Bienvenido
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 100ms;'>
      <a href='citas'>
        <i class='fa fa-calendar'></i> Citas
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 120ms;'>
      <a href='pagos'>
        <i class='fa fa-money'></i> Pagos
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 140ms;'>
      <a href='horarios'>
        <i class='fa fa-list'></i> Horarios
      </a>
    </li>  
    <li style='padding-bottom: 20px; animation-delay: 160ms;' class='animate__animated animate__fadeInLeft'>
      <a href='./?s=1'>
        <i class='fa fa-sign-out'></i> Salir
      </a>
    </li>
  ";
}else if ($perfil=="3"){ // Paciente
  $menu = "
    <li style='padding-top: 20px;' class='animate__animated animate__fadeInLeft'>
      <a href='panel'>
        <i class='fa fa-dashboard'></i> Bienvenido
      </a>
    </li>
<!--    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 100ms;'>
      <a href='buscar'>
        <i class='fa fa-search'></i> Buscar Medicos por Especialidad
      </a>
    </li>-->
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 100ms;'>
      <a href='filtrosedes'>
        <i class='fa fa-search'></i> Buscar Medicos por Sede
      </a>
    </li>
    
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 120ms;'>
      <a href='buscar-medicos'>
        <i class='fa fa-search'></i> Ver todos los Medicos 
      </a>
    </li>
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 140ms;'>
      <a href='citas'>
        <i class='fa fa-calendar'></i> Mis Citas
      </a>
    </li> 
    <li class='animate__animated animate__fadeInLeft' style='animation-delay: 160ms;'>
      <a href='pagos'>
        <i class='fa fa-money'></i> Pagos Realizados
      </a>
    </li>  
    <li style='padding-bottom: 20px; animation-delay: 180ms;' class='animate__animated animate__fadeInLeft'>
      <a href='./?s=1'>
        <i class='fa fa-sign-out'></i> Salir
      </a>
    </li>
  ";
}


?>

<head>
  <style>
    .sidebar-menu>li {
      background: transparent !important;
    }

    .skin-blue .sidebar a {
      /* color: green !important; */
      font-size: 16px !important;
    }

    .callout.callout-info {
      border-color: green;
    }

    .main-sidebar {
      border-right-width: 1px;
      border-color: green;
      border-right-color: green;
      /* border-right: 2px solid gray !important; */
      background: red;
    }

    .bg-aqua,
    .callout.callout-info,
    .alert-info,
    .label-info,
    .modal-info .modal-body {
      background-color: transparent !important;
      border-bottom: 1px solid green !important;
    }

    .btn-success {
      background-color: transparent !important;
      border-color: green !important;
      color: green !important;
    }

    .content-wrapper {
      background-color: transparent;
    }

    .callout h4 {
      color: green !important;
    }

    .skin-blue .sidebar-menu>li>a {
      transition: all ease-in-out .3s;
    }

    .skin-blue .sidebar-menu>li:hover>a {
      background: white !important;

      color: #296c23 !important;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
</head>

<aside class="main-sidebar">
  <section class="sidebar">
    <!-- <img src="dist/img/design/imagen11.png" width="100%" alt=""> -->



    <ul class="sidebar-menu" data-widget="tree">

      <div class="user-panel">

        <!-- <center> -->

          <a style="color: #FFF" href="#">
            <img src="arch/<?php echo $imguser;?>" class="img-circle img-logo" alt="<?php echo $login;?>"><br><br>

            <?php echo $login;?>

            <?php echo $perfil;?>
          </a>

        <!-- </center> -->

      </div>



      <?php echo $menu;?>
    </ul>

  </section>
</aside>

<script src="dist/js/sidebar.js"></script>