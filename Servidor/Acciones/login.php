<?
	/*importar("Servidor/Modelos/usuario.class.php");
	$usuario = new Usuario();
	
	//si hay un usuario en sesion, salta login y va al inicio
	if(isset($_SESSION['usuario_activo'])){
		header("location: inicio");
		die;
	}
	
	//si no hay usuario en sesion, pero hay una cookie, intenta un autologin
	if(!isset($_SESSION['usuario_activo']) && isset($_COOKIE['icos_login'])){
		if($usuario->autoLogin($_COOKIE['icos_login'])){
			$_SESSION['usuario_activo'] = $usuario->get('url_usuario');
			$_SESSION['id_usuario_activo'] = $usuario->get('id_usuario');
		}
		die;
	}
		*/
	//si no va al formulario
	importar("Cliente/Vistas/login.html");

?>