<?
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/cookie.class.php");
	$usuario = new Usuario();
	//cerrar-sesion aqui y luego redirecciono al login
	if($usuario->cerrarSesion()){
		header("Location: login");
		die();
	}
	header("Location: inicio");
?>