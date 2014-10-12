<?
	global $dato;
	importar("Servidor/Modelos/usuario.class.php");
	
	$usuario = new Usuario();
	$datos = explode( ';', $dato );
	
	if($usuario->activar($datos[0],$datos[1])){
		$var['mensaje'] = "tu cuenta se activo!";
		importar("Cliente/Vistas/Comunes/activacion.html");
	}
	else{
		$var['mensaje'] = "error en activacion!, intentalo mas tarde...";	
		importar("Cliente/Vistas/Comunes/activacion.html");
	}
	
?>