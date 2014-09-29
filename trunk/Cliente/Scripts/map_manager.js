function crearMapa(id_div){
	$("#"+id_div).gmap3({
          map:{
            options:{
              center:[-22.49156846196823, -64.75802349999992],
              zoom:2,
              mapTypeId: google.maps.MapTypeId.SATELLITE,
              mapTypeControl: true,
              mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
              },
              navigationControl: true,
              scrollwheel: true,
              streetViewControl: true
            }
          }
        });
	//return $("#"+id_div).gmap3("get");
}

function agregarMarcadores(id_div, clickEvent){

	$("#"+id_div).gmap3({
		marker:{
            values:[
              {latLng:[48.8620722, 2.352047], data:"Paris !"},
              {address:"86000 Poitiers, France", data:"Poitiers : great city !"},
              {address:"66000 Perpignan, France", data:"Perpignan ! <br> GO USAP !", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}}
            ],
            options:{
              draggable: false
            },
            events:{
				click: function(marker, event, context){
					clickEvent();
				}              
            }
        }
	});

}