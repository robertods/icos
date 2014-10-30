$(document).ready(function(){
	
	$('#grillaProductos').dataTable({
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
	$("input[type='search']").width(400);
	$("input[type='search']").css('margin-bottom','8px');
	
});
//---------------------------------------------------------------------------------------------
function borrarProducto(id_producto, url_producto){
	if(confirm("¿Desea borrar el producto "+url_producto+"?")){
		location = "admin-productos/eliminar:"+id_producto+":"+url_producto;
	}
}