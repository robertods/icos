<?
    // voy a usar este modelo -----------------------------------------
	importar("Servidor/Modelos/trueque.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/propuesta.class.php");
	
	Seguridad::Check();
	
	$propuesta = new Propuesta();
	$trueque = new Trueque();
	//----------------------------------
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
		$datos = explode( ':', $dato );			
		$var['base_modificada'] = '<base href="../"/>';
		if($datos[0] == "confirmacion"){					
					header("location: ../puntuacion/{$datos[1]}");											
					die;
				}	
	}
	
	
	
	//consulto la base de datos ---------------------------------------
	$respuesta = $trueque->obtenerMisTrueques($_SESSION['id_usuario_activo']);
	
	//echo "<pre>".print_r($respuesta,true)."</pre>";die;
		
	// armo los registros de la tabla con los datos obtenidos ---------	
	$var['registros_tabla'] = "";
	
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
	
	    //hacer aqui la segunda consulta 
        $array_productos_propuestos = $propuesta->obtenerListaPropuesta( $respuesta[$i]['id_propuesta'] );
						
		$minitabla = "";
		$cantidad_prod = count($array_productos_propuestos);
		for($j=0;$j<$cantidad_prod;$j++){
			$minitabla .= $array_productos_propuestos[$j]['titulo_producto'] . "</br>";
		}
	
	$estado = "???";
	//$estado = ($respuesta[$i]['estado_trueque']) ? 'Finalizado' : 'Pendiente';	
	switch((int)$respuesta[$i]['estado_trueque']){
		case 0: 
			$estado = 'Pendiente'; 			
		break;
		case 1: 
			$estado = '1 confirmación'; 
			$boton = $respuesta[$i]['fecha_finalizado_trueque'];
		break;
		case 2: 
			$estado = 'Finalizado'; 
			$boton = $respuesta[$i]['fecha_finalizado_trueque'];
		break;
	}
	
	$puntos_que_di = (int)($respuesta[$i]['ofrece']==$_SESSION['usuario_activo'])? $respuesta[$i]['puntos_a_propone'] : $respuesta[$i]['puntos_a_ofrece'];
		
	if($puntos_que_di==0){	
		$boton = "<button class=\"botonRecibi\" onClick='recibio({$respuesta[$i]['id_trueque']})' ><a> <i class=\"fa fa-thumbs-o-up\"></i> Recibí lo acordado</a></button>";		
	}

	$var['registros_tabla'] .= "<tr>
									<td>{$respuesta[$i]['url_producto']}</td>	
									<td>{$respuesta[$i]['ofrece']}</td>
									<td>{$minitabla}</td>
									<td>{$respuesta[$i]['propone']}</td>
									<td>{$respuesta[$i]['fecha_acuerdo_trueque']}</td>										

									<td>{$estado}</td>
									
									<td>{$boton}</td>
								</tr>
									";
	}

                                      
    // llamo a la vista Grilla ----------------------------------------
	importar("Cliente/Vistas/Usuario/mis-trueques.html");
	
?>