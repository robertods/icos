<?
    // voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	$propuesta = new Propuesta();
	
	Seguridad::Check();
    // obtengo los datos para edicion y borrado si los hay ------------------------
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
			$datos = explode( ':', $dato );			
			$var['base_modificada'] = '<base href="../"/>';
			
			switch($datos[0]){
				//-------------------------------------
				case 'aceptar':					
	
				$resultado = $propuesta->aceptarPropuesta($datos[1]);
				
				if($resultado){
					header("location: ../mensaje/acepto-propuesta-ok");
				}else{
					header("location: ../mensaje/acepto-propuesta-error");
				}							
				die;
				break;
				//-------------------------------------
				case 'eliminar':
				$resultado = $usuario->borrarPropuesta($datos[1]);
					
					if($resultado){
						header("location: ../mensaje/eliminar-propuesta-ok");
					}else{
						header("location: ../mensaje/eliminar-propuesta-error");
					}							
					die;
				break;
				//-------------------------------------
			}
	}
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $propuesta->obtenerPropuestasRecibidas($_SESSION['id_usuario_activo']);
	
	
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
		 
	$var['registros_tabla'] .= "<tr>
									<td>{$minitabla}</td>						
									<td>{$respuesta[$i]['id_usuario_propone']}</td>
									<td>
									<button class=\"botonMejora\"> <a href='javascript:mejorar({$respuesta[$i]['id_propuesta']})'> <i class=\"fa fa-arrow-circle-o-up\"></i> Quiero una mejora</a></button>
									<button class=\"botonAceptar\"> <a href='javascript:aceptar({$respuesta[$i]['id_propuesta']})'> <i class=\"fa fa-thumbs-o-up\"></i> Aceptar la propuesta</a></button><br>
									<a href='javascript:denunciar({$respuesta[$i]['id_propuesta']})'> Denunciar</a>   
									</td>
								
								</tr>
							";
	}

    
	//consulto la base de datos ---------------------------------------
	
	$respuesta2 = $propuesta->obtenerPropuestasEnviadas($_SESSION['id_usuario_activo']);
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	
	$var['registros_tabla2'] = "";
	$cantidad2 = count($respuesta2);
	for($i=0;$i<$cantidad2;$i++){
	
	//hacer aqui la segunda consulta 
    $array_productos_propuestos2 = $propuesta->obtenerListaPropuesta( $respuesta[$i]['lista_propuestos'] );
						
	$minitabla2 = "";
	$cantidad_prod2 = count($array_productos_propuestos2);
	for($j=0;$j<$cantidad_prod2;$j++){
	$minitabla2 .= $array_productos_propuestos2[$j]['titulo_producto'] . "</br>";
	}
		 
	$var['registros_tabla2'] .= "<tr>
									<td>{$minitabla2}</td>						
									<td>{$respuesta2[$i]['usuario_ofrece']}</td>
									<td>
									<button class=\"botonMejora\"> <a href='javascript:mejorar({$respuesta2[$i]['id_propuesta']})'> <i class=\"fa fa-pencil\"></i> Editar la propuesta</a></button>
									<button class=\"botonElimina\"> <a href='javascript:eliminar({$respuesta2[$i]['id_propuesta']})'> <i class=\"fa fa-times\"></i> Eliminar la propuesta</a></button><br>
									
									</td>
								
								</tr>
							";
	}
	
	
	
	// llamo a la vista Grilla ----------------------------------------
	importar("Cliente/Vistas/Usuario/mis-propuestas.html");
	
?>