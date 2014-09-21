<?	
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/cookie.class.php");
	importar("Servidor/Modelos/email.class.php");
	importar("Servidor/Modelos/view.class.php");
        
	//Security::Check();
	
	$usuario = new Usuario();
					
	//------------------------------------------------------------------------------------------
	// Obtengo los Parametros 
	//------------------------------------------------------------------------------------------
	$nombre_usuario = $_POST["nombre_usuario"];
	$email_usuario = $_POST["email_usuario"];
	$clave_usuario = $_POST["clave_usuario"];
	
	//------------------------------------------------------------------------------------------
	// Consulto la base de datos
	//------------------------------------------------------------------------------------------
	global $APP;
		
	$codigo_autorizacion = sha1($APP->saltMail.md5($nombre_usuario.$email_usuario.date("Y-d-m h:i:s")));	
				
	if($usuario->registrar($nombre_usuario, $clave_usuario, $email_usuario, $codigo_autorizacion)){
				
		$diccionario = array( 
							  '{usuario_minusculas}' => ucfirst(strtolower($nombre_usuario)),
							  '{url_icos}' => $APP->urlApp,
							  '{usuario}' => $nombre_usuario,
							  '{codigo_autorizacion}' => $codigo_autorizacion
							);		
							
		$plantilla = View::template("Email/activar-cuenta-html.html");		
		$cuerpo_email_html = View::render($plantilla, $diccionario);
		
		$plantilla = View::template("Email/activar-cuenta-texto.html");
		$cuerpo_email_texto = View::render($plantilla, $diccionario);	
				
		$resultado = Email::enviar( $email_usuario, 'Activacion de Cuenta ICOS', $cuerpo_email_html, $cuerpo_email_texto );
		
		if($resultado->enviado){
			$usuario_tmp_creado = true;
		}
		else{
			$usuario_tmp_creado = false;
		}
				
	}
	else{
		$usuario_tmp_creado = false;
	}	
	
	//------------------------------------------------------------------------------------------
	// Genero una respuesta
	//------------------------------------------------------------------------------------------
    class Respuesta{
		public $usuario_creado;
		public $email_registrado;
		
	}
	
	$respuesta = new Respuesta();
	$respuesta->usuario_creado = $usuario_tmp_creado;
	$respuesta->email_registrado = $email_usuario;
	
	echo json_encode($respuesta);
	
?>