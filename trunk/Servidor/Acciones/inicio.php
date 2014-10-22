<?	
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/chat.class.php");
	
	if(Seguridad::getRol($_SESSION["id_usuario_activo"]) == 2 ){
			header("location: administrador-icos");
			die;
	}
	
	Seguridad::Check();
	$chat = new Chat();
	
	
	$var['cantidadMensajesNuevos'] = $chat->obtenerCantidadMensajesSinLeer($_SESSION['usuario_activo']);
	
	importar("Cliente/Vistas/Usuario/inicio.html");
	
?>