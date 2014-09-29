$(document).ready(function(){
	crearMapa("mapa");
	agregarMarcadores("mapa", mostrarDetalle);

});
//-------------------------------------------------------------------------------------
function mostrarDetalle(){
	$("#panel").html("Detalle!!");
}
