function crearMapa(id_div){
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
            }
          }
        });
	//return $("#"+id_div).gmap3("get");
}

function agregarMarcadores(id_div, listaMarcadores, clickEvent){

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
            }
        }
	});

}