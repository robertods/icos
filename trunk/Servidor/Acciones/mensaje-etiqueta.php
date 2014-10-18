<?
	global $dato;
	if($dato){
		$datos = explode( ':', $dato );
		
		switch($datos[0]){
			case 'edicion-etiqueta-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Se ha actualizado la etiqueta ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "admin-etiquetas";
			break;
			case 'edicion-etiqueta-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No se pudo actualizar la etiqueta ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "admin-etiquetas";
			break;
			
			case 'borrado-etiqueta-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-exclamation-triangle\"></i>"." Se ha borrado la etiqueta ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-etiquetas";
			break;			
			case 'borrado-etiqueta-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No pudo borrarse la etiqueta".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "admin-etiquetas";
			break;
			
		}
	}
	
	
	importar("Cliente/Vistas/Comunes/mensaje.html");

?>