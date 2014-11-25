<?	
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::Check();
	
	global $dato;
	if($dato){
				
			$usuario = new Usuario();
			$perfil = $usuario ->obtenerPerfilUsuario($dato);
			$var['base_modificada'] = '<base href="../"/>';
			$var['enlace_modificado'] = 'perfil-usuario/'.$dato;
			
			$var['id_usuario'] = $perfil[0]['id_usuario'];
			$var['nombre'] = $perfil[0]['nombre_perfil'];
			$var['prestigio'] = $perfil[0]['prestigio_perfil'];
			$var['url_usuario'] = $perfil[0]['url_usuario'];
			
			
			
			importar("Cliente/Vistas/perfil-usuario.html");
			die;
	}
	
	
	
	
	
	
	
	
	header("location: inicio");
	
?>