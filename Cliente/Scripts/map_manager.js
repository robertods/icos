var mapa;
var geocoder;

function crearMapa(id_div, clickEvent, dataCallback){

	geocoder = new google.maps.Geocoder();
	
	$("#"+id_div).gmap3({
          map:{
            options:{
              center:[-22.49156846196823, -64.75802349999992],
              zoom:2,
              mapTypeId: google.maps.MapTypeId.ROUTE,
              mapTypeControl: true,
              mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
              },
              navigationControl: true,
              scrollwheel: true,
              streetViewControl: true
            },
            events:{
				click: function(marker, event, context){
					if(typeof(clickEvent)!="undefined"){ clickEvent(id_div, event, dataCallback); }
				}
			}	
          }
        });
	
	mapa = $("#"+id_div);	
	mapa.gmap3('get').controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(new SearchBox());	
	
	
	//return $("#"+id_div).gmap3("get");
}

function codeAddress() {

  var mi_mapa = mapa.gmap3('get');

  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      mi_mapa.setCenter(results[0].geometry.location);
	  mi_mapa.setZoom(16);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('ingrese una dirección válida');
    }
  });
}

function SearchBox() {
    var searchTextBox = $('<input id="address" type="textbox" value="" onkeypress="buscarDireccion(event)" placeholder="Ingresá una dirección y pulsa enter para acercarte..." />');
    var div = $('<div class="geoSearchBox"></div>').append(searchTextBox);
	
    return div.get(0);
}

function buscarDireccion(e){
	if(e.which == 13){ //enter
		codeAddress();
	}
}

function determinarUbicacion(id_div, event, dataCallback){

	var marker_ubicacion = $("#"+id_div).gmap3({get:{name:"marker", tag: ["ubicacion"], all: true}});

	if(marker_ubicacion.length==0){
		$("#"+id_div).gmap3({
			marker:{
				latLng: event.latLng,
				options:{
					draggable:false
					/*,icon:new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green" + (isM1 ? "A" : "B") + ".png")*/
				},
				tag: "ubicacion",
				events:{
					click: function(marker, event, context){
						//clickEvent();
					}/*,
					dragend: function(marker){
						marker.setPosition(event.latLng);
						$(dataCallback).val(event.latLng);
					}*/
				}
			}
		});
	}
	else{
		marker_ubicacion[0].setPosition(event.latLng);
	}
	
	var myLatLng = event.latLng;
    var lat = myLatLng.lat();
    var lng = myLatLng.lng();
		
	$(dataCallback).val('POINT('+lng+' '+lat+')');
}

function pedirPosicion(pos) {
   var centro = new google.maps.LatLng(pos.coords.latitude,pos.coords.longitude);
   var mi_mapa = mapa.gmap3('get');
   mi_mapa.setCenter(centro);
   mi_mapa.setZoom(15);
}
 
function geolocalizame(){
	navigator.geolocation.getCurrentPosition(pedirPosicion);
}

function agregarMarcadores(id_div, listaMarcadores, clickEvent){

	$("#"+id_div).gmap3({clear:{name:"marker", all: true}});
	$("#"+id_div).gmap3({clear:{name:"cluster", all: true}});

	$("#"+id_div).gmap3({
		marker:{
            values: listaMarcadores,
            options:{
              draggable: false
            },
            events:{
				click: function(marker, event, context){
					clickEvent();
				}              
            },			
			cluster:{
			  radius: 50,
			  events:{ 
				click: function(cluster){
				  alert("quienes son?");
				}
			  },
			  0: {
				content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
				width: 66,
				height: 65
			  }
			}
        }		
	});

}