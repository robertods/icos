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
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Se confirmó correctamente que recibió lo acordado";
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "mis-trueques";
			break;
			case 'recibio-producto-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." La confirmación no pudo ser procesada. Intentelo mas tarde";
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "mis-trueques";
			break;
			
			case 'acepto-propuesta-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Ya aceptaste la propuesta...<br> Ahora realiza el trueque! ";
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "mis-trueques";
			break;
			case 'acepto-propuesta-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." La confirmación no pudo ser procesada. Intentelo mas tarde";
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "mis-trueques";
			break;
			
			case 'eliminar-propuesta-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-exclamation-triangle\"></i>"." Eliminaste la propuesta que habías ofrecido.";
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "mis-propuestas";
			break;
			case 'eliminar-propuesta-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No se pudo eliminar la propuesta correctamente. Intentelo mas tarde";
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "mis-propuestas";
			break;
			
			case 'eliminarme-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-exclamation-triangle\"></i>"." Ya eliminaste tu cuenta de ICOS. <br>Podrás volverte a registrar en cualquier momento";
				$var['clase_css_mensaje'] = "mensajeBorrado";
				$var['url_redireccion'] = "login";
				
			break;
			case 'eliminarme-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No se pudo eliminar tu cuenta correctamente. Intentelo mas tarde";
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "inicio";
			break;
			
			case 'edicion-mi-perfil-ok':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-check\"></i>"." Tus datos fueron editados correctamente";
				$var['clase_css_mensaje'] = "mensajeEdicion";
				$var['url_redireccion'] = "mi-perfil";
				
			break;
			case 'edicion-mi-perfil-error':	
				$var['mensaje_tarea'] = "<i class=\"fa fa-times\"></i>"." No se pudo eliminar tu cuenta correctamente. Intentelo mas tarde";
				$var['clase_css_mensaje'] = "mensajeError";
				$var['url_redireccion'] = "mi-perfil";
			break;
			
		}
	}
	
	
	importar("Cliente/Vistas/Comunes/mensaje.html");

?>