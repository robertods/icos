$(document).ready(function(){
	crearMapa("mapa");
	
	$("#txtBuscar").keypress(function(e) {
		if(e.which == 13){ //enter
			buscarProductos();
		}
	});
	
	$("#btnBuscar").click(buscarProductos);
	

});
//-------------------------------------------------------------------------------------
function buscarProductos(){
	var texto_buscado = $("#txtBuscar").val().trim()
	if(texto_buscado.length > 0){
	
		var paramentros = {}
		paramentros.texto_buscado = texto_buscado;
		
		consultarServidor("Ajax-buscar-productos", paramentros, ponerEnMapa);
		
	}
}
function ponerEnMapa(respuesta){

	var marcadores =
	[
	  {latLng:[48.8620722, 2.352047], data:"Paris !"},
	  {address:"86000 Poitiers, France", data:"Poitiers : great city !"},
	  {address:"66000 Perpignan, France", data:"Perpignan ! <br> GO USAP !", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}}
	];
	
	agregarMarcadores("mapa", marcadores, mostrarDetalle);
	
	
}
//-------------------------------------------------------------------------------------
function mostrarDetalle(info){
	$("#panel").html("Detalle!!");
}
