<?
	global $dato;
	if($dato){
		$datos = explode( ':', $dato );
		
		switch($datos[0]){
			case 'edicion-usuario-ok':	
				$var['mensaje_tarea'] = "Se ha actualizado el usuario ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-usuarios";
			break;
			case 'edicion-usuario-error':	
				$var['mensaje_tarea'] = "No pudo actualizar el usuario ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-usuarios";
			break;
			
			case 'borrado-usuario-ok':	
				$var['mensaje_tarea'] = "Se ha borrado el usuario ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-usuarios";
			break;			
			case 'borrado-usuario-error':	
				$var['mensaje_tarea'] = "No pudo borrarse el usuario".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-usuarios";
			break;
			
		}
	}
	
	
	importar("Cliente/Vistas/Comunes/mensaje.html");

?>