<?
    importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::Check();
	
	
				
			$usuario = new Usuario();
			$perfil = $usuario ->obtenerMiPerfil($_SESSION['id_usuario_activo']);
			$var['base_modificada'] = '<base href="../"/>';
			
			$var['id_usuario'] = $perfil[0]['id_usuario'];
			$var['nombre'] = $perfil[0]['nombre_perfil'];
			$var['prestigio'] = $perfil[0]['prestigio_perfil'];
			$var['email'] = $perfil[0]['email_usuario'];
		    $var['clave'] = $perfil[0]['clave_usuario'];
			
			importar("Cliente/Vistas/Usuario/mi-perfil.html");
			
			
		
	
	
	
?>