<?	
	importar("Servidor/Modelos/seguridad.class.php");
	
	
	if(Seguridad::getRol($_SESSION["id_usuario_activo"]) == 2 ){
			header("location: administrador-icos");
			die;
	}
	
	Seguridad::Check();
		
	importar("Cliente/Vistas/Usuario/inicio.html");
	
?>