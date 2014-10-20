<?	
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/chat.class.php");
	$chat = new Chat();
	Seguridad::Check();
	
	$var['cantidadMensajesNuevos'] = $chat->obtenerCantidadMensajesSinLeer($_SESSION['usuario_activo']);
	
	importar("Cliente/Vistas/Usuario/inicio.html");
	
?>