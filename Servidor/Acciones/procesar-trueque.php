<? 
    // voy a usar este modelo -----------------------------------------
	importar("Servidor/Modelos/trueque.class.php");
	//importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::Check();
	
	$trueque = new Trueque();
	//$propuesta = new Propuesta();
	//----------------------------------
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
		$datos = explode( ':', $dato );			
		$var['base_modificada'] = '<base href="../"/>';
			if($datos[0] == "confirmacion"){
		
		//tareas: un servicio nunca se vence, un producto deberia dejar de aparecer y productos involucrados: debaja2
					
				// cambia el estado del trueque
				$resultado = $trueque->recibio($datos[1]);
				
				// aqui puntua guarda en tabla trueque y si el estado es 2, se suma los puntos al perfil de ambos
				// determino a quien le sumo los puntos:
				$partes = $trueque->obtenerPartes($datos[1]);
				$url_otro = ($partes[0]['ofertante']==$_SESSION['usuario_activo'])? $partes[0]['demandante'] : $partes[0]['ofertante'];
				$parte_puntuar = ($partes[0]['ofertante']==$_SESSION['usuario_activo'])? 'demandante' : 'ofertante';
				
				// guardo los puntos que le doy
				$trueque->guardarPuntosProvisorios( $datos[1], $parte_puntuar, $datos[2] );
						
				if((int)$resultado == 2){
					$trueque->asignarPuntos( $datos[1], $parte_puntuar, $url_otro, $_SESSION['usuario_activo'] );
				}
								
				if($resultado){	
					header("location: ../mensaje/recibio-producto-ok");
				}else{
					header("location: ../mensaje/recibio-producto-error");
				}											
				die;
			}	
	}
		
	/*	
		
	//consulto la base de datos ---------------------------------------
	$respuesta = $trueque->obtenerMisTrueques($_SESSION['id_usuario_activo']);
	
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
	
	//$estado = ($respuesta[$i]['estado_trueque']) ? 'Finalizado' : 'Pendiente';	
	switch((int)$respuesta[$i]['estado_trueque']){
		case 0: $estado = 'Pendiente'; break;
		case 1: $estado = '1 confirmación'; break;
		case 2: $estado = 'Finalizado'; break;
	}
	
	
	$boton =  ($respuesta[$i]['estado_trueque']) ? $respuesta[$i]['fecha_finalizado_trueque'] : "<button class=\"botonRecibi\" onClick='recibio({$respuesta[$i]['id_trueque']})' ><a> <i class=\"fa fa-thumbs-o-up\"></i> Recibí lo acordado</a></button>";	
	

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
	*/
?>