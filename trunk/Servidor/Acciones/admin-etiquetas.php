<? 
// voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/etiqueta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	$etiqueta = new Etiqueta();
	
	Seguridad::CheckAdmin();
	
	// obtengo los datos para edicion y borrado si los hay ------------------------
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
			$datos = explode( ':', $dato );			
			$var['base_modificada'] = '<base href="../"/>';
			
			switch($datos[0]){
				//-------------------------------------
				case 'editar':					
					$informacion = $etiqueta->obtenerEtiqueta($datos[1]);
					
					
					$var['descripcion'] = $informacion[0]['descripcion_etiqueta'];
					$var['id'] = $datos[1];
					
					importar("Cliente/Vistas/Admin/form-edicion-etiqueta.html");
					die;			
				break;
				//------------------------------------------------
				case 'procesar-edicion':
				
					Class Aux{}
					$datos_post = new Aux();
					
					
					$datos_post->descripcion_etiqueta = $_POST['txtDescripcion'];
					$datos_post->id_etiqueta = $_POST['hidIdEtiqueta'];	
				
					$resultado = $etiqueta->actualizarEtiqueta($datos_post);
					
					if($resultado){						
						header("location: ../mensaje/edicion-etiqueta-ok:{$_POST['txtDescripcion']}");
					}else{
						header("location: ../mensaje/edicion-etiqueta-error:{$_POST['txtDescripcion']}");
					}					
					die;
				break;
				//-----------------------------------------------
				case 'eliminar':
					$resultado = $etiqueta->borrarEtiqueta($datos[1]);
					
					if($resultado){
						header("location: ../mensaje/borrado-etiqueta-ok:{$datos[2]}");
					}else{
						header("location: ../mensaje/borrado-etiqueta-error:{$datos[2]}");
					}							
					die;
				break;
				//-------------------------------------
				
			}			 
			
	}
	
	
	
	//consulto la base de datos ---------------------------------------
	$respuesta = $etiqueta->obtenerEtiquetas();
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	$var['registros_tabla'] = "";
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
	
		$var['registros_tabla'] .= "<tr>																		
										<td>{$respuesta[$i]['descripcion_etiqueta']}</td>									
										<td>
											<a href='admin-etiquetas/editar:{$respuesta[$i]['id_etiqueta']}'>Editar</a>
											|
											<a href='javascript:borrarEtiqueta({$respuesta[$i]['id_etiqueta']},\"{$respuesta[$i]['descripcion_etiqueta']}\")'>Eliminar</a>
										</td>
									</tr>
									";
	}

	// llamo a la vista Grilla ----------------------------------------
	
	importar("Cliente/Vistas/Admin/bm-etiquetas.html");
	
?>