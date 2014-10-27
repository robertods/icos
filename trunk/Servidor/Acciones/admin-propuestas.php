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
	
	if($dato){
		$datos = explode( ':', $dato );			
			$var['base_modificada'] = '<base href="../"/>';
			if($datos[0] == "eliminar"){
				$resultado = $propuesta->borrarPropuesta($datos[1]);
				
				if($resultado){
					header("location: ../mensaje/borrado-propuesta-ok:{$datos[1]}");
				}else{
					header("location: ../mensaje/borrado-propuesta-error:{$datos[1]}");
				}							
				die;
			}
	}
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $propuesta->obtenerPropuestas();
	
	//echo "<pre>".print_r($respuesta, true)."</pre>";die;
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	
	$var['registros_tabla'] = "";
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
		//hacer aqui la segunda consulta 
        $array_productos_propuestos = $propuesta->obtenerListaPropuesta( $respuesta[$i]['lista_propuestos'] );
						
		$minitabla = "";
		$cantidad_prod = count($array_productos_propuestos);
		for($j=0;$j<$cantidad_prod;$j++){
			$minitabla .= $array_productos_propuestos[$j]['titulo_producto'] . "</br>";
		}
		
		
		//y lo devuelto ($resp2), guardarlo en el array:
		//$datos_grilla[ $i ]['lista_propuestos'] = $resp2;
		 
		$var['registros_tabla'] .= "<tr>
										<td>{$respuesta[$i]['id_propuesta']}</td>
										<td>{$respuesta[$i]['titulo_producto']}</td>
										<td>{$minitabla}</td>
										<td>{$respuesta[$i]['usuario_ofrece']}</td>										
										<td>{$respuesta[$i]['usuario_propone']}</td>
										<td><a href='javascript:borrarPropuesta({$respuesta[$i]['id_propuesta']})'>Eliminar</a></td>
									</tr>
									";
	}




	// llamo a la vista Grilla ----------------------------------------
	importar("Cliente/Vistas/Admin/bm-propuestas.html");
	
?>