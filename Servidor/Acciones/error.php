<?
	global $APP;
	global $error;
	
	if($APP->modoDebug){	
		$var['mensajeError'] = str_replace('Servidor/Controllers/','',$error->mensaje);
		$var['archivo'] = $error->archivo;
		$var['linea'] = $error->linea;
		$var['horario'] = $error->fecha;
		$var['pila'] = preg_replace("/\n/", '<br>', $error->pila);

		importar("Cliente/Vistas/Comunes/error_dev.html");
	}	
	else{		
		importar("Cliente/Vistas/Comunes/error_usr.html");
	}	

?>