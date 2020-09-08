
    <!-- ezeToast -->
    <link rel="stylesheet" href="bower_components/izitoast/css/iziToast.min.css">
    
    <!-- ezeToast -->
    <script src="bower_components/izitoast/js/iziToast.min.js"></script>
    
    <!-- moment -->
    <script src="bower_components/moment/moment-with-locales.js"></script>
    
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    
    <script>
    //moment.locale('es-pe');
    moment.locale('es');
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2]+ "/";
    //var my_location_domain = getUrl .protocol + "//" + getUrl.host + "/" ;
    var my_location_domain = getUrl .protocol + "//" + getUrl.host + "/"  + getUrl.pathname.split('/')[1] + "/" ;
    var my_location = getUrl.href
    console.log(my_location_domain)
    console.log(my_location)
    console.log(baseUrl)
    
    bodyOnload()
    
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
        //var ruta = 'api/api.php';
        var ruta = 'api.php';
        
        
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
                    response.data[i].cita_hora = (response.data[i].cita_fecha).slice(11, 16)
                    /*
                    console.log("response.data[i].cita_fecha",response.data[i].cita_fecha)
                    console.log("response.data[i].cita_hora.slice(11, 5)",response.data[i].cita_fecha.slice(11, 16))
                    console.log("response.data[i].cita_hora",response.data[i].cita_hora)
                    */
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
        const url = `${my_location_domain}salas/sala_${idMedico}.php?idU=${idPaciente}&idM=${idMedico}`;
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
    

    function confirmarpago(idcita){
        bootbox.confirm("¿Pagar ahora?", function(result){
            if (result==true){
                document.location.href="seleccionarformapago?id="+idcita;
            }        
        })
    }
    
</script>
