<?php

session_start();
$login=$_SESSION[login];
$imguser=$_SESSION[imguser];
$iniuser=$_SESSION[iniuser];
$perfil=$_SESSION[perfil];

if ($perfil=="1"){ // Administrador
  $panel = "
    <div class='row'>
      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #03a9f43d; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .3s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='buscar-medicos' >
            <i class='fa fa-user-md' style='font-size: 40px; color: white; background: #03A9F4; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center'>Medicos</h4>
          </a>          
        </div>   

      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #8fc74d69; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .6s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='filtrosedes' >
            <i class='fa fa-tasks' style='font-size: 40px; color: white; background: #8BC34A; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center;'>Sedes</h4> 
          </a>                
        </div>    

      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #ffc1074a; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .9s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='citas' >
            <i class='fa fa-calendar' style='font-size: 40px; color: white; background: #FFC107; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center;'>Citas</h4>                                  
          </a>                
        </div> 

      </div>

    </div>
  ";
}else if ($perfil=="2"){ // Medicos

  $panel = "
    <div class='row'>      
      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #ffc1074a; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .3s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='citas' >
            <i class='fa fa-calendar' style='font-size: 40px; color: white; background: #FFC107; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center;'>Citas</h4>                                  
          </a>                
        </div>   

      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #03a9f43d; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .6s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='horarios' >
            <i class='fa fa-list' style='font-size: 40px; color: white; background: #03A9F4; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center;'>Mis Horarios</h4>                                  
          </a>                
        </div>   

      </div>
    </div>
  ";

}else if ($perfil=="3"){ // Paciente

  $panel = "
    <div class='row'>      
      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #03a9f43d; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .3s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='buscar-medicos' >
            <i class='fa fa-user-md' style='font-size: 40px; color: white; background: #03A9F4; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center;'>Buscar Medicos</h4>                                  
          </a> 
        </div>

      </div>

      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #ffc1074a; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .6s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='citas' >
            <i class='fa fa-calendar' style='font-size: 40px; color: white; background: #FFC107; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center;'>Citas</h4>                                  
          </a>                
        </div>    

      </div>

      <div class='col-md-4 col-sm-6 col-xs-12'>

        <div style='box-shadow: 3px 13px 22px #8fc74d69; border: none; margin-top:20px; display: flex; justify-content: center; padding: 30px; border-radius: 10px; animation-delay: .9s;' class='card-design animate__animated animate__fadeInTopRight'>
          <a style='display: flex; flex-direction: column; align-items: center; justify-content: center; ' href='filtrosedes' >
            <i class='fa fa-tasks' style='font-size: 40px; color: white; background: #8BC34A; padding: 30px; width: 100px; height: 100px; border-radius: 50%; display: flex; justify-content: center;'></i>
            <h4 style='text-align: center;'>Sedes</h4> 
          </a>                
        </div>    

      </div>


    </div>
  ";
}

$panel .= '<head>
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
/>
<style>
  .card-design {
    transition: all ease-in-out .2s !important;
  }
  .card-design:hover {
    box-shadow: none !important;
    transform: translate(4px, 2px) !important;
  }
</style>
</head>';

?>


<?php echo $panel; ?>