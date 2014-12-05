
$(document).ready(function(){
	
	$(".botonSubirFotoPerfil").css('background-image', php_avatar);
	//creo cajas de carga de fotos
	$("#fileFoto1").change(function(){
		return ShowImagePreview( this.files, 1 );
	});
	
	$("#btnBorrar").click(function(){
		borrarCanvas( 1 );
	});
	
	
});

//------------------------------------------------------------------------------------------
function borrarUsuario(id_usuario){
	if(confirm("¿Estás seguro de eliminar tu cuenta?")){
		location = "mi-perfil/eliminar:"+id_usuario;
	}
}
