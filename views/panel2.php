<!DOCTYPE html>
<html>
<head>  
  <?php $xajax->printJavascript('lib/'); ?>
  <meta charset="utf-8">
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
  
  <!-- ezeToast -->
  <link rel="stylesheet" href="bower_components/izitoast/css/iziToast.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="bodyOnload()">
<!-- Site wrapper -->
<div class="wrapper">  

  <?php include_once "includeheader.php"; ?>

  <?php include_once "includesidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-top: -20px">
  

    <!-- Main content -->
    <section class="content">
        
      <?php include_once "includepanel.php"; ?>

    </section>
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

<!-- ezeToast -->
<script src="bower_components/izitoast/js/iziToast.min.js"></script>

<!-- moment -->
<script src="bower_components/moment/moment-with-locales.js"></script>


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

<script>

  $(function () {
    $('#daterangepicker').daterangepicker(
      {
        locale: {
          format: 'DD/MM/YYYY'
        },
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
          'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
        //,startDate: moment().subtract(29, 'days'),
        //endDate  : moment()
      }
    )

    $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
      var startDate = picker.startDate;
      var endDate = picker.endDate;

      $("#bntSubmitSearch").click();
      //alert("New date range selected: '" + startDate.format('YYYY-MM-DD') + "' to '" + endDate.format('YYYY-MM-DD') + "'");
    });
    //$('#daterangepicker').daterangepicker({ format: 'DD/MM/YYYY ' })    

    $('#tabla').DataTable({
      "scrollX": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    })

  })
    </script>
<script>
    moment.locale('es-pe');
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2]+ "/";
    //var my_location_domain = getUrl .protocol + "//" + getUrl.host + "/" ;
    var my_location_domain = getUrl .protocol + "//" + getUrl.host + "/"  + getUrl.pathname.split('/')[1] + "/" ;
    var my_location = getUrl.href
    console.log(my_location_domain)
    console.log(my_location)
    console.log(baseUrl)
    
    function bodyOnload(){
        getCitas()
        update_warning()
        //showNotfication()
        
        setInterval(function(){showNotfication()}, 3000);
    }
    
    function getCitas(){

        //var id_paciente =document.getElementById("id_paciente").value;
        //var ruta = baseUrl+'funciones/notification.php?id='+id_paciente;
        //var ruta = baseUrl+'api/api.php';
        var ruta = 'api/api.php';
        
        
        $.get( ruta, function( data ) {
            let response = null
            
            response = JSON.parse(data)  
            //console.log(response)
            //document.getElementById("badge-count").innerHTML = response.count;
            
            
            if(response.code === 200){
                
                
                let listLinks ;
                
                for (var i = 0; i < response.data.length; i++) {
                    response.data[i].state = true
                    response.data[i].firstw = true
                    response.data[i].firstw_state = true
                    response.data[i].cita_hora = response.data[i].cita_hora.slice(0, 5)
                    //console.log(response.data[i].cita_hora)
                }
                
                listLinks = response.data.map(val => citaTemplate(val))
				        //document.getElementById("dropdown-list-citas").innerHTML = listLink;
				
                //console.log(listLinks)
                var DB = getDataDB();
                var dataTest  = response.data;
                
                if(DB){
                    console.log("en local si hay DB ")

                    if(DB.length !== response.data.length){

                        console.log("new data update DB")
                        updateDB(response.data)

                    }else{
                      DB.sort();
                      dataTest.sort();

                      // y se realiza la comparación de cada elemento
                      let ok= false
                      for (let i = 0; i < DB.length; i++) {
                        //console.log(`${DB[i].cita_id} !== ${dataTest[i].cita_id}`);
                        
                        if(DB[i].cita_id !== dataTest[i].cita_id){
                          ok = true
                          break;
                        }
                        
                      }
                      //console.log(ok);
                      if(ok) {
                        console.log("new data 2 update DB")
                        updateDB(response.data)
                        
                      } 
                    }
                    
                    

                    
                    
                }else{
                    console.log("no hay DB agregaremos una")
                    updateDB(response.data)
                    
                }
                
            }else{
                console.log("hoy no hay citas")
                //mode production
                //updateDB([])
            }
            
        });
    }
    
    function getDataDB(){
        
        return JSON.parse(localStorage.getItem('DB_NOTIFICATION'));
    }
    
    function showNotfication(){
        //console.log("hi showNotfication")
        
        var DB = getDataDB();
        if(DB){
            
            var date = new Date;
            //var seconds = date.getSeconds();
            var minutes = date.getMinutes();
            var hour = date.getHours();
            //var hourMysqlFormat = `${('00' + hour).slice(-2)}:${('00' + minutes).slice(-2)}:00.000000`;
            var hourMysqlFormat = `${('00' + hour).slice(-2)}:${('00' + minutes).slice(-2)}`;
            console.log(hourMysqlFormat)
            let hour_now = moment(`${hour}:${minutes}`, "hh:mm");
            
            const existFirstWarning = DB.filter(cita => ( cita.firstw_state ));
            console.log("existFirstWarning",existFirstWarning)
            
            if(existFirstWarning.length > 0){
                validateWarning(existFirstWarning, hour_now, 120)
            }
            
            DB.forEach(function(cita){
                    //console.log(`firstw = (${cita.firstw}) firstw_state = (${cita.firstw_state}) `)
                    console.log(`cita_hora = (${cita.cita_hora}) hourMysqlFormat = ${hourMysqlFormat}`)
            });
            
            
            //const result = DB.filter(cita => (cita.cita_hora === hourMysqlFormat));
            
            const result = DB.filter(cita => (cita.state  && cita.cita_hora === hourMysqlFormat));
            const resultIndex = DB.findIndex(cita => (cita.state  && cita.cita_hora === hourMysqlFormat));
            
            //console.log("result filter",result, "with hour",hourMysqlFormat )
            if(result.length > 0){
                
                templateNotification(
                    `Ya es hora de tu cita ${result[0].cita_hora}`,
                    "#5ced5f",
                    "Ir a la cita!",
                    ()=>{ACTION_irCita(result[0].usuario_idmedico, result[0].usuario_idpaciente)}
                )
                
                DB[resultIndex].state = false
                //console.log(DB)
                updateDB(DB)
                
            }
            
/*    
            for (var i = 0; i < result.length; i++) {
                templateNotification(result[i])
            }
            */
                
        }
        
    }
    
    function validateWarning(DB, hour_now, minute_warning = 60,  type_warning = "firstw"){
     
        //console.log(DB)
        if(DB || DB.length > 0 ){
                
            /*
            DB.forEach(function(cita){
                console.log(`
                ${cita.cita_hora} 
                (${cita[type_warning]}  &&
                ${( moment(cita.cita_hora, "hh:mm").diff(hour_now, 'minute') )} > 0 &&
                ${minute_warning} >=  (${moment(cita.cita_hora, "hh:mm").diff(hour_now, 'minute')}) )`)
            });
            */
            const my_filter = (cita) =>(
                cita[type_warning]  &&   
                ( moment(cita.cita_hora, "hh:mm").diff(hour_now, 'minute') ) > 0 &&
                minute_warning >= ( moment(cita.cita_hora, "hh:mm").diff(hour_now, 'minute') ) 
            )
            
            const result_isComing = DB.filter(cita => my_filter(cita));
            //const index_isComing = DB.findIndex(cita => my_filter(cita));
                
            console.log("result_isComing filter",result_isComing, "with hour",hour_now._i, "type_warning",type_warning )
            
            if(result_isComing.length > 0){
                
                for (let index = 0; index < result_isComing.length; index++) {
                    
                    let pretty_hour = moment(result_isComing[index]["cita_hora"], "hh:mm").fromNow(true);
                    templateNotification(
                        `${result_isComing[index]["cita_hora"]} Usted tiene una cita en ${pretty_hour}`,
                        "#5cc4ed",
                        `Entendido`,
                        ()=>{ACTION_warning(result_isComing[index].id, type_warning+"_state")},
                    )
                }
                
                DB = getDataDB();
                for (let index = 0; index < DB.length; index++) {
                    
                    DB[index][type_warning] = false
                }
                
                //console.log("validateWarning DB",DB)
                updateDB(DB)
                
                
            }
        }
    }
    
    function update_warning(){
        var DB = getDataDB();
        
        //console.log(DB)
        if(DB ){
            if(DB.length > 0 ){
                console.log("update_warning")
                
                const result_isComing = []
                //const index_isComing = 0
                
                for (let index = 0; index < DB.length; index++) {
                    DB[index].firstw = true
                }
            }
            
        }
        //console.log(DB)
        updateDB(DB)       
    }
    
    function ACTION_warning(id, type_warning){
        //alert("hi")
        var DB = getDataDB();
        const index_isComing = DB.findIndex(cita => (cita.id === id))
        
        //console.log(index_isComing, id )
        DB[index_isComing][type_warning] = false
        //console.log(DB)
        updateDB(DB)
        
        //window.location.href = baseUrl+"views/index.php?v=resultado_consultas";
        
    }
    
    function ACTION_irCita(idMedico, idPaciente){
        
        //window.location.href = baseUrl+"views/index.php?v="+idMedico;
        
        //window.location.href = `${baseUrl}views/index.php?v=sala/${idMedico}`;
        //const url = `${baseUrl}sala/id=${idMedico}`;
        const url = `${my_location_domain}salas/sala_${idMedico}.php?id_paciente=${idPaciente}`;
        var win = window.open(url, '_blank');
        win.focus();
        
    }
    
    function templateNotification(message, backgroundColor, mButton = "Ir a la cita", action = () =>{}, actionc = () =>{} ){
        
        
        iziToast.show({
            timeout: false,
            //theme: 'dark',
            backgroundColor,
            message,
            position: 'topLeft', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                [`<button>${mButton}</button>`, function (instance, toast) {
                    action()
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                    }, toast, 'buttonName');
                }, true], // true to focus
                ['<button>Close</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                        onClosing: function(instance, toast, closedBy){
                            console.info('closedBy: ' + closedBy); // The return will be: 'closedBy: buttonName'
                            
                        }
                    }, toast, 'buttonName');
                }]
            ],
            onClosing: function(instance, toast, closedBy){
                console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                actionc()
            }
        });
    }
    
    
    function updateDB(data){
        localStorage.setItem('DB_NOTIFICATION', "");
        let stringData = JSON.stringify(data)
        localStorage.setItem('DB_NOTIFICATION', stringData);
        
    }
    
    
    
   
    /*
    */
    function citaTemplate(data){
        //console.log(data)
        let response =`<a class="dropdown-item" href="#">Cita a las: ${data.cita_hora}</a>`
        //console.log(response)
        return response;
        
    }
    
    
</script>
    
</body>
</html>
