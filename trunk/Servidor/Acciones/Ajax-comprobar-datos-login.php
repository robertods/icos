<?	
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/cookie.class.php");
        
	//Security::Check();
	
	$usuario = new Usuario();
	
				
	//------------------------------------------------------------------------------------------
	// Obtengo los Parametros 
	//------------------------------------------------------------------------------------------
	$email_usuario = $_POST["email_usuario"];
	$clave_usuario = $_POST["clave_usuario"];
	$recordar_usuario = (int) $_POST['recordar_usuario'];
	
	//------------------------------------------------------------------------------------------
	// Consulto la base de datos
	//------------------------------------------------------------------------------------------
	
	if($usuario->loguearse($email_usuario, $clave_usuario)){ 
		$_SESSION['usuario_activo'] = $usuario->get('url_usuario');
		$_SESSION['id_usuario_activo'] = $usuario->get('id_usuario');
		$_SESSION['email_usuario_activo'] = $usuario->get('email_usuario');
		
		if($recordar_usuario){			
			$valorCookie = Cookie::prepararValor($_SESSION['usuario_activo']);
			Cookie::actualizarCookie($_SESSION['usuario_activo'], 'icos_login', $valorCookie, 5);			
		}
		else{											
			Cookie::borrarCookie($_SESSION['usuario_activo'],'icos_login');
		}
					
		$valido = true;
		
	}
	else{
		$valido = false;
	}
	
	//------------------------------------------------------------------------------------------
	// Genero una respuesta
	//------------------------------------------------------------------------------------------
    class Respuesta{}	
	$respuesta = new Respuesta();
	
	$respuesta->valido = $valido;
	
	echo json_encode($respuesta);
	
?>