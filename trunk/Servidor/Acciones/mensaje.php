<?
	global $dato;
	if($dato){
		$datos = explode( ':', $dato );
		
		switch($datos[0]){
			case 'edicion-ok':	
				$var['mensaje_tarea'] = "Se ha borrado el registro ".$datos[1];
				$var['url_redireccion'] = "admin-usuarios";
			break;
			case 'edicion-error':	
				$var['mensaje_tarea'] = "No pudo actualizar el registro ".$datos[1];
				$var['url_redireccion'] = "admin-usuarios";
			break;
			case 'borrado-ok':	
				$var['mensaje_tarea'] = "Se ha borrado el registro ".$datos[1];
				$var['url_redireccion'] = "admin-usuarios";
			break;			
			case 'borrado-error':	
				$var['mensaje_tarea'] = "No pudo borrarse el registro".$datos[1];
				$var['url_redireccion'] = "admin-usuarios";
			break;
		}
	}
	
	
	importar("Cliente/Vistas/Comunes/mensaje.html");

?>