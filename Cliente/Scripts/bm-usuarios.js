$(document).ready(function(){
	
	$('#grillaUsuarios').dataTable({
		"language": {
			"paginate": {
			  "previous": "Anterior",
			  "next": "Siguiente"			  
			},
			"lengthMenu": "Mostrar de a _MENU_ registros",			
			"info": "Mostrando _START_ - _END_ de _TOTAL_ registros",
			"infoFiltered": " - filtrados de _MAX_ registros",
			"search": "_INPUT_",
			"searchPlaceholder": "Buscar...",
			"infoEmpty": "Sin registros",
			"emptyTable": "No hay registros para mostrar",
			"zeroRecords": "La búsqueda no arrojó resultados"
		}
	});
	
	
});
//---------------------------------------------------------------------------------------------
function borrarUsuario(id_usuario, url_usuario){
	if(confirm("¿Desea borrar el usuario "+url_usuario+"?")){
		location = "admin-usuarios/eliminar:"+id_usuario+":"+url_usuario;
	}
}