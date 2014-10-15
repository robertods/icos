<?
	global $dato;
	importar("Servidor/Modelos/usuario.class.php");
	
	$usuario = new Usuario();
	$datos = explode( ';', $dato );
	
	if($usuario->activar($datos[0],$datos[1])){
		$var['mensaje'] = "<i class=\"fa fa-check\"></i>"." Tu cuenta se activo!";
		$var['clase_css_mensaje'] = "mensajeEdicion";
		importar("Cliente/Vistas/Comunes/activacion.html");
	}
	else{
		$var['mensaje'] = "<i class=\"fa fa-times\"></i>"." Error en activacion! Intentalo mas tarde...";
		$var['clase_css_mensaje'] = "mensajeError";		
		importar("Cliente/Vistas/Comunes/activacion.html");
	}
	
?>