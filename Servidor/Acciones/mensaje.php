<?
	global $dato;
	if($dato){
		$datos = explode( ':', $dato );
		
		switch($datos[0]){
			case 'edicion-usuario-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Se ha actualizado el usuario ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "admin-usuarios";
			break;
			case 'edicion-usuario-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No se pudo actualizar el usuario ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "admin-usuarios";
			break;
			
			case 'borrado-usuario-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-exclamation-triangle\"></i>"." Se ha borrado el usuario ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-usuarios";
			break;			
			case 'borrado-usuario-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No pudo borrarse el usuario".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "admin-usuarios";
			break;
			
			case 'borrado-propuesta-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-exclamation-triangle\"></i>"." Se ha borrado la propuesta ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-propuestas";
			break;			
			case 'borrado-propuesta-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No pudo borrarse la propuesta".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "admin-propuestas";
			break;
		}
	}
	
	
	importar("Cliente/Vistas/Comunes/mensaje.html");

?>