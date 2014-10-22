<?
	// voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	$propuesta = new Propuesta();
	
	Seguridad::CheckAdmin();

	// obtengo los datos para edicion y borrado si los hay ------------------------
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
		$datos = explode( ':', $dato );			
			$var['base_modificada'] = '<base href="../"/>';
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $propuesta->obtenerPropuestas();
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	
	$var['registros_tabla'] = "";
	$cantidad = count($resp);
	for($i=0;$i<$cantidad;$i++){
		//hacer aqui la segunda consulta 
         $resp2 = $miBD -> ejecutar( ".........", $array(  $resp[$i]['id_propuesta'] ) );
		
		//y lo devuelto ($resp2), guardarlo en el array:
		$datos_grilla[ $i ]['lista_propuestos'] = $resp2;
		 
		$var['registros_tabla'] .= "<tr>
										<td>{$respuesta[$i]['titulo_producto']}</td>
										<td>{$respuesta[$i]['lista_propuestos']}</td>
										<td>{$respuesta[$i]['usuario_ofrece']}</td>										
										<td>{$respuesta[$i]['usuario_propone']}</td>
										
									</tr>
									";
	}




	// llamo a la vista Grilla ----------------------------------------
	importar("Cliente/Vistas/Admin/bm-propuestas.html");
	
?>