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
			
			case 'edicion-mi-producto-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Se ha actualizado el producto ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "mis-productos";
			break;
			case 'edicion-mi-producto-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No se pudo actualizar el producto ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "mis-productos";
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
			case 'borrado-mi-producto-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-exclamation-triangle\"></i>"." Se ha borrado el producto ".$datos[1];
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "mis-productos";
			break;			
			case 'borrado-mi-producto-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No pudo borrarse el producto".$datos[1];
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "mis-productos";
			break;
			case 'procesar-denuncia-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Su denuncia se envio correctamente";
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "inicio";
			break;
			case 'procesar-denuncia-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." Su denuncia no pudo ser procesada. Intentelo mas tarde";
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "inicio";
			break;
			
			case 'recibio-producto-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." Se confirmó correctamente que recibió el producto/servicio";
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "mis-trueques";
			break;
			case 'recibio-producto-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." La confirmación no pudo ser procesada. Intentelo mas tarde";
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "mis-trueques";
			break;
		}
	}
	
	
	importar("Cliente/Vistas/Comunes/mensaje.html");

?>