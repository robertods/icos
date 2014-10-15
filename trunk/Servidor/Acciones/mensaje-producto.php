<?
	global $dato;
	if($dato){
		$datos = explode( ':', $dato );
		
		switch($datos[0]){
			case 'edicion-producto-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Se ha actualizado el producto ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "admin-productos";
			break;
			case 'edicion-producto-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No se pudo actualizar el producto ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "admin-productos";
			break;
			
			case 'borrado-producto-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-exclamation-triangle\"></i>"." Se ha borrado el producto ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "admin-productos";
			break;			
			case 'borrado-producto-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No pudo borrarse el producto".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "admin-productos";
			break;
			
		}
	}
	
	
	importar("Cliente/Vistas/Comunes/mensaje.html");

?>