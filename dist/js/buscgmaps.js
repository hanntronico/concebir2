 var options = {
  //types: ['(cities)'],
  //componentRestrictions: {country: "ar"}
 };

  google.maps.event.addDomListener(window, 'load', function () {
      var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'), options);
      google.maps.event.addListener(places, 'place_changed', function () {
          var place = places.getPlace();
          var latitude = place.geometry.location.lat();
          var longitude = place.geometry.location.lng();

          document.getElementById("origen1lon").value = longitude;
          document.getElementById("origen1lat").value = latitude;

          //alert(place);

          //console.log(place);

          /*
          var address = place.formatted_address;
          
          var mesg = "Address: " + address;
          mesg += "\nLatitude: " + latitude;
          mesg += "\nLongitude: " + longitude;
          */

         var address_components = place.address_components;   

        console.log(place);

        var components={}; 
        jQuery.each(address_components, function(k,v1) {jQuery.each(v1.types, function(k2, v2){components[v2]=v1.long_name});})

        console.log(components);

        
        //var country = components.country;
        
        //var direccion2 = place.formatted_address;
        var direccion = place.formatted_address;
        var country = components.country;
        var calle = components.route;
        var codpostal = components.postal_code;
        var sublocalidad = components.sublocality;
        var ciudad = components.administrative_area_level_1;
        var ciudad2 = components.administrative_area_level_2;

        /*

        document.getElementById("infolatitud").value = latitude;
        document.getElementById("infolongitud").value = longitude;
        document.getElementById("infocountry").value = country;
        document.getElementById("infodir").value = direccion;
        document.getElementById("infocalle").value = calle;
        document.getElementById("infociudad").value = ciudad;
        document.getElementById("infociudad2").value = ciudad2;
        document.getElementById("infocodpostal").value = codpostal;
        document.getElementById("infosublocalidad").value = sublocalidad;

      */
        //var url = "https://maps.google.com/maps?q="+latitude+","+longitude+"&hl=es;z=14&amp;output=embed";

        

        //alert(url);
        //document.getElementById("iframemaps").src = url;

        //alert(1);
        

        /*
        
        document.getElementById("origen1lon").value = longitude;
        document.getElementById("ubic1").value = city2;
        document.getElementById("ubic2").value = city3;
        document.getElementById("ubic3").value = city4;

        if (city2!=""){
          document.getElementById("ubicorig").value = city2;
        }else if (city3!=""){
          document.getElementById("ubicorig").value = city3;
        }else if (city4!=""){
          document.getElementById("ubicorig").value = city4;
        }else {
          document.getElementById("ubicorig").value = city;
        }

        */

      });        
  });