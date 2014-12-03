<?	
	importar("Servidor/Modelos/usuario.class.php");
        
	//Security::Check();
	$usuario = new Usuario();
	
				
	//------------------------------------------------------------------------------------------
	// Obtengo los Parametros 
	//------------------------------------------------------------------------------------------
	$email_usuario = $_SESSION['email_usuario_activo'];
	$clave_usuario = $_POST["clave_usuario"];
	
	//------------------------------------------------------------------------------------------
	// Consulto la base de datos
	//------------------------------------------------------------------------------------------
	
	if($usuario->loguearse($email_usuario, $clave_usuario)){ 
		
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