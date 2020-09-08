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
        <div class='callout callout-info'>
          <div class='row'>
              <a href='medicos' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-user-md' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Medicos</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='callout callout-info'>
          <div class='row'>
              <a href='especialidades' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-list' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Especialidades</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='callout callout-info'>
          <div class='row'>
              <a href='sedes' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-tasks' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Sedes</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='callout callout-info'>
          <div class='row'>
              <a href='citas' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-calendar' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Citas</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
    </div>
  ";
}else if ($perfil=="2"){ // Medicos

  $panel = "
    <div class='row'>      
      <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='callout callout-info'>
          <div class='row'>
              <a href='citas' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-calendar' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Citas</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='callout callout-info'>
          <div class='row'>
              <a href='horarios' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-list' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Mis Horarios</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
    </div>
  ";

}else if ($perfil=="3"){ // Paciente

  $panel = "
    <div class='row'>      
      <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='callout callout-info'>
          <div class='row'>
              <a href='buscar-medicos' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-user-md' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Buscar Medicos</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
      <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class='callout callout-info'>
          <div class='row'>
              <a href='citas' >
                <div class='col-xs-5 col-md-4'>
                    <center>                  
                      <i class='fa fa-calendar' style='font-size: 40px'></i>
                    </center>
                </div>
                <div class='col-xs-7 col-md-8' style='padding-left: 0px; padding-top: 10px'>                    
                  <h4 style='text-align: justify'>Citas</h4>                                  
                  
                </div>
              </a>                
          </div>           
        </div>    
      </div>
    </div>
  ";
}



?>


<?php echo $panel; ?>