<?	
	importar("Servidor/Modelos/usuario.class.php");
        
	//Security::Check();
	
	$usuario = new Usuario();
					
	//------------------------------------------------------------------------------------------
	// Obtengo los Parametros 
	//------------------------------------------------------------------------------------------

	$email_usuario = $_POST["email_usuario"];
	
	//------------------------------------------------------------------------------------------
	// Consulto la base de datos
	//------------------------------------------------------------------------------------------
		
	$ya_existe_email = $usuario->comprobarExistenciaEmail($email_usuario);
	
	$respuesta = 0;
	
	if($ya_existe_email){
		$respuesta = 1;		
	}
	
	//------------------------------------------------------------------------------------------
	// Genero una respuesta
	//------------------------------------------------------------------------------------------
    	
	echo $respuesta;
	
?>