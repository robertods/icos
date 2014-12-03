$(document).ready(function(){
	
	crearMapa("mapa");
	
	var etiquetasPredefinidas = etiquetas_disponibles;
	
	$("#txtEtiqueta").keypress(function(e) {
		if(e.which == 13){ //enter
			buscarProductos();
		}
	});
	
	//creo componentes de etiqueta
	$('#txtEtiqueta').tagit({
		availableTags: etiquetasPredefinidas,		
		singleField: true,
		singleFieldNode: $('#hidEtiqueta')
	});	
	
	
	$("#btnBuscar").click(buscarProductos);
	

});
//-------------------------------------------------------------------------------------
function buscarProductos(){
	var texto_buscado = $("#hidEtiqueta").val().trim()
	if(texto_buscado.length > 0){
	
		var paramentros = {}
		paramentros.texto_buscado = texto_buscado;
		
		consultarServidor("Ajax-buscar-productos", paramentros, ponerEnMapa);
		
	}
}
function ponerEnMapa(respuesta){

	var marcadores = [];
	//respuesta[1].titulo_producto: "matematica 3"
	$.each(respuesta, function(indice, elemento){
		var posiciones = elemento.ubicacion_producto.substring(6, elemento.ubicacion_producto.length-1).split(" ");

		var ubicacion = new google.maps.LatLng( parseFloat(posiciones[1]), parseFloat(posiciones[0]) );
		var obj = {	'latLng': ubicacion, 
					'data':"Paris !", 
					'options':{'icon': "Cliente/Imagenes/Markers/default_marker.png"}
				  }
		
		marcadores.push(obj);
	});
	
	/*var marcadores =
	[
	  {latLng:[48.8620722, 2.352047], data:"Paris !", options:{icon: "Cliente/Imagenes/Markers/default_marker.png"}}
	];*/
	
	agregarMarcadores("mapa", marcadores, mostrarDetalle);
	
	
}
//-------------------------------------------------------------------------------------
function mostrarDetalle(info){
	$("#panel").html("Detalle!!");
}
