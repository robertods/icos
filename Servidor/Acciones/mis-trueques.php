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
					$resultado = $trueque->recibio($datos[1]);
					
					if($resultado){
						header("location: ../mensaje/recibio-producto-ok");
					}else{
						header("location: ../mensaje/recibio-producto-error");
					}							
					die;
				}	
	}
	
	
	
	//consulto la base de datos ---------------------------------------
	$respuesta = $trueque->obtenerMisTrueques($_SESSION['id_usuario_activo']);
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	$var['registros_tabla'] = "";
	
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
	
	    //hacer aqui la segunda consulta 
        $array_productos_propuestos = $propuesta->obtenerListaPropuesta( $respuesta[$i]['id_lista_producto_propuesto'] );
						
		$minitabla = "";
		$cantidad_prod = count($array_productos_propuestos);
		for($j=0;$j<$cantidad_prod;$j++){
			$minitabla .= $array_productos_propuestos[$j]['titulo_producto'] . "</br>";
		}
	
	$estado = ($respuesta[$i]['estado_trueque']) ? 'Finalizado' : 'Pendiente';	
	$boton =  ($respuesta[$i]['estado_trueque']) ? $respuesta[$i]['fecha_finalizado_trueque'] : "<button class=\"botonRecibi\"> <a href='javascript:recibio({$respuesta[$i]['id_trueque']})'> <i class=\"fa fa-thumbs-o-up\"></i> Recibí lo acordado</a></button>";	
	

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