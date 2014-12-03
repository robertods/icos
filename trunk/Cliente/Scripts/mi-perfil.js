

function borrarUsuario(id_usuario){
	if(confirm("¿Estás seguro de eliminar tu cuenta?")){
		location = "mi-perfil/eliminar:"+id_usuario;
	}
}
