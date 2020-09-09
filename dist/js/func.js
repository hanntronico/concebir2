function guardarestatuscita(){    
    
    var cita_id = document.getElementById("cita_id").value;        
    var estatus = document.getElementById("estatus").value;        

    xajax_guardarestatuscita(cita_id, estatus);
}


function guardarestatuspago(){    
    
    var pago_id = document.getElementById("pago_id").value;        
    var estatus = document.getElementById("estatus").value;        

    xajax_guardarestatuspago(pago_id, estatus);
}



function eliminarpago(pago_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarpago(pago_id);
        }        
    })
}

function cambiarestatuspago(pago_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatuspago(pago_id, estatus);
        }        
    })
}





function confirmarreserva(){
    
    var medico = document.getElementById("medico").value;
    var especialidad = document.getElementById("especialidad").value;
    var sede = document.getElementById("sede").value;
    var horario = document.getElementById("horario").value;
    var hora = document.getElementById("hora").value;

    xajax_confirmarreserva(medico, especialidad, sede, horario, hora);
    
    
}



function cargarespecialidadessedes(){    

    var medico = document.getElementById("medico").value;
    
    xajax_cargarespecialidadessedes(medico);        
}


function registrarusuario2(){
    
    let ok = true
    let msg = ""

    console.log("enviado");
    
    var email = document.getElementById("email").value;
    var clave = document.getElementById("clave").value;
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    
    
    var tipo_documento = document.getElementById("tipo-documento").value;
    var f_nacimiento = document.getElementById("f-nacimiento").value;
    
    var celular = document.getElementById("celular").value;
    var documento = document.getElementById("documento").value;
    var t_document_select = document.getElementById("tipo-documento");
    // var description_question_1 = document.getElementById("description-question-1").value;
    
    var t_document_select_selected = t_document_select.options[t_document_select.selectedIndex].value;
    
    
    
    if(t_document_select_selected === "0"){
        ok= false
        msg = "Seleccione el tipo de documento!"
    }
    // var pais_nacimiento = document.getElementById("pais-nacimiento").value;
    // var ciudad_nacimiento = document.getElementById("ciudad-nacimiento").value;
    
    
    
    // var question_2 = document.getElementsByName('question-2');
    // let question_2_value;
    // let question_2_selected_value = ""
    
    // for (var i = 0, length = question_2.length; i < length; i++) {
    //   if (question_2[i].checked) {
    //     // do whatever you want with the checked radio
    //     question_2_value=question_2[i].value;
    //     // only one radio can be logically checked, don't check the rest
    //     break;
    //   }
    // }
    
    // if(question_2_value === "si"){
    //     var seguro_select = document.getElementById("tipo-seguro");
    //     var seguro_select_selected = seguro_select.options[seguro_select.selectedIndex].value;
        
        
    //     //alert("si-"+seguro_select_selected)
        
    //     if(seguro_select_selected === "0"){
    //         ok= false
    //         msg = "Seleccione el seguro!"
    //     }else{
    //         question_2_selected_value = seguro_select.options[seguro_select.selectedIndex].text
    //         //question_2_selected_value = seguro_select_selected
    //     }
    // }


    // var f_nacimiento = ""
    // if ($("#f-nacimiento").inputmask("isComplete")){
        
    //     f_nacimiento = $("#f-nacimiento").inputmask("unmaskedvalue")
        
    // } else {
    //     ok= false
    //     msg = "Ingrese su fecha de nacimiento!"
        
    // }
    
    
    if(!ok){
        alert(msg)   
        
        /*
        */
    }else{
        console.log(
            "nombre: ", 
            nombre, 
            "apellido: ", 
            apellido, 
            "email: ", 
            email, 
            "celular: ", 
            celular, 
            "documento: ", 
            documento, 
            "t_document_select_selected :", 
            t_document_select_selected, 
            // "question_2_selected_value", 
            // question_2_selected_value, 
            // "pais_nacimiento", 
            // pais_nacimiento, 
            // "ciudad_nacimiento", 
            // ciudad_nacimiento, 
            "f_nacimiento", 
            f_nacimiento, 
            "clave: ", 
            clave
        );
        let data = {
            email, 
            clave, 
            nombre, 
            apellido, 
            t_document_select_selected, 
            documento, 
            celular,
            f_nacimiento 
            // description_question_1, 
            // pais_nacimiento, 
            // ciudad_nacimiento, 
            // question_2_selected_value
        }
        xajax_registrarusuario2(data);
        //xajax_registrarusuario(nombre, apellido, email, celular, dni, clave);
    }

    
    
}

function registrarusuario(){
    

    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    var email = document.getElementById("email").value;
    var celular = document.getElementById("celular").value;
    var dni = document.getElementById("dni").value;
    var clave = document.getElementById("clave").value;


    xajax_registrarusuario(nombre, apellido, email, celular, dni, clave);
    
    
}

function eliminarhorario(horario_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarhorario(horario_id);
        }        
    })
}

function cambiarestatushorario(horario_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatushorario(horario_id, estatus);
        }        
    })
}



function eliminarcita(cita_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarcita(cita_id);
        }        
    })
}

function cambiarestatuscita(cita_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatuscita(cita_id, estatus);
        }        
    })
}



function eliminarusuarioespecialidad(usuarioespecialidad_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarusuarioespecialidad(usuarioespecialidad_id);
        }        
    })
}

function cambiarestatususuarioespecialidad(usuarioespecialidad_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatususuarioespecialidad(usuarioespecialidad_id, estatus);
        }        
    })
}


function eliminarusuariosede(usuariosede_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarusuariosede(usuariosede_id);
        }        
    })
}

function cambiarestatususuariosede(usuariosede_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatususuariosede(usuariosede_id, estatus);
        }        
    })
}



function eliminarsede(sede_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarsede(sede_id);
        }        
    })
}

function cambiarestatussede(sede_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatussede(sede_id, estatus);
        }        
    })
}


function eliminarespecialidad(especialidad_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarespecialidad(especialidad_id);
        }        
    })
}

function cambiarestatusespecialidad(especialidad_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatusespecialidad(especialidad_id, estatus);
        }        
    })
}


function eliminarusuario(usuario_id){

    bootbox.confirm("Esta seguro que desea eliminar?", function(result){
        if (result==true){
            xajax_eliminarusuario(usuario_id);
        }        
    })
}

function cambiarestatususuario(usuario_id, estatus){

    bootbox.confirm("Esta seguro que desea cambiar el estatus?", function(result){
        if (result==true){
            xajax_cambiarestatususuario(usuario_id, estatus);
        }        
    })
}

function ingresarusuario(){
	
	var usuario = document.getElementById("usuario").value;
	var password = document.getElementById("clave").value;
	if(usuario=="" || password == ""){
		alert("Error: el usuario y password no pueden estar vacios");
	}else{
		xajax_ingresarusuario(usuario, password);
	}
	
}



$(function(){
  $('#documento').keypress(function(e) {
        if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
        e.preventDefault();
  });
});



function obtenerdatosreniec(){

    var docu = document.getElementById("documento").value;

    // $.post( "example.php", {dni: docu}, function( data ) {
    //     // // $( ".result" ).html( data );
    //     // var datos = data.split("-",2);
    //     // if (datos[0]!="NA") {
    //     //     document.getElementById("nombre").value = datos[0];
    //     //     document.getElementById("apellido").value = datos[1];
    //     // }else{
    //     //     alert( "error" );
    //     // }


    //   .done(function() {
    //     alert( "second success" );
    //   })

    //   .fail(function() {
    //         alert( "error" );
    //   })


    // });



    var jqxhr = $.post( "datosreniec.php", {dni: docu}, function( data ) {
      // alert( "success" );

    })
    
      .done(function( data ) {
      
      var daterr = data.split("Warning",2);

      if (daterr[0]!=" "){
        alert("Error de respuesta");
      }else{
        var datos = data.split("-",2);
        if (datos[0]!="NA") {
            document.getElementById("nombre").value = datos[0];
            document.getElementById("apellido").value = datos[1];
        }else{
            document.getElementById("nombre").value = "";
            document.getElementById("apellido").value = "";
            alert( "DNI no encontrado" );
        } 
      }

        // alert( datos[0] );
      
   

      
      })

      .fail(function( data ) {
        alert( "error" );
      })


}