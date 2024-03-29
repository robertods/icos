<?
// voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/producto.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	$producto = new Producto();
	
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
				case 'editar':					
					$informacion = $producto->obtenerProducto($datos[1]);
					
					//$var['fotos'] 	  = $informacion[0]['fotos_producto'];
					$var['url'] 	  = $informacion[0]['url_producto'];
					$var['titulo'] 	  = utf8_encode($informacion[0]['titulo_producto']);
					$var['tipo'] 	  = $informacion[0]['es_servicio'];
					$var['descripcion'] = utf8_encode($informacion[0]['descripcion_producto']);
					$var['disponible'] = $informacion[0]['disponible_producto'];
					$var['id'] = $datos[1];
					
					importar("Cliente/Vistas/Usuario/edicion-producto.html");
					die;			
				break;
				//------------------------------------------------
				case 'procesar-edicion':
				
					Class Aux{}
					$datos_post = new Aux();
					
					$datos_post->url_producto = $_POST['txtUrl'];
					$datos_post->titulo_producto = $_POST['txtTitulo'];
					$datos_post->es_servicio = $_POST['txtTipo'];
					$datos_post->descripcion_producto = $_POST['txtDescripcion'];
					$datos_post->disponible_producto = $_POST['txtDisponible']; 
					$datos_post->id_producto = $_POST['hidIdProducto'];	
				
					$resultado = $producto->actualizarProducto($datos_post);
					
					if($resultado){						
						header("location: ../mensaje/edicion-producto-ok:{$_POST['txtUrl']}");
					}else{
						header("location: ../mensaje/edicion-producto-error:{$_POST['txtUrl']}");
					}					
					die;
				break;
				//-----------------------------------------------
				case 'eliminar':
					$resultado = $producto->borrarProducto($datos[1]);
					
					if($resultado){
						header("location: ../mensaje/borrado-mi-producto-ok:{$datos[2]}");
					}else{
						header("location: ../mensaje/borrado-mi-producto-error:{$datos[2]}");
					}							
					die;
				break;
				//-------------------------------------
				
			}			 
			
	}
	
	
	
	//consulto la base de datos ---------------------------------------
	$respuesta = $producto->obtenerMisProductos($_SESSION['id_usuario_activo']);
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	$var['registros_tabla'] = "";
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
		
		$dir_imagen = 'Cliente/Imagenes/Productos/';
		$imagen1 = (file_exists($dir_imagen.$respuesta[$i]['url_producto'].'_'.$respuesta[$i]['foto_principal'].'.png')) ? $respuesta[$i]['url_producto'].'_'.$respuesta[$i]['foto_principal'] : 'default_producto';
	/*	$imagen2 = (file_exists($dir_imagen.$respuesta[$i]['url_producto'].'_2.png')) ? $respuesta[$i]['url_producto'].'_2' : 'default_producto';
		$imagen3 = (file_exists($dir_imagen.$respuesta[$i]['url_producto'].'_3.png')) ? $respuesta[$i]['url_producto'].'_3' : 'default_producto';*/
		$disponible = ($respuesta[$i]['disponible_producto']) ? 'Si' : 'No';
		$tipo = ($respuesta[$i]['es_servicio']) ? 'Servicio' : 'Producto';
						
		$var['registros_tabla'] .= "<tr>
										<td><img width='48px' height='48px' src='Cliente/Imagenes/Productos/{$imagen1}.png' /></td>
										<td><a href='producto/{$respuesta[$i]['url_producto']}'>{$respuesta[$i]['url_producto']}</a></td>
										<td>{$respuesta[$i]['titulo_producto']}</td>
										<td>{$tipo}</td>										
										<td>{$respuesta[$i]['descripcion_producto']}</td>
										<td>{$disponible}</td>
										<td>
											<a href='mis-productos/editar:{$respuesta[$i]['id_producto']}'>Editar</a>
											|
											<a href='javascript:borrarProducto({$respuesta[$i]['id_producto']},\"{$respuesta[$i]['url_producto']}\")'>Eliminar</a>
										</td>
									</tr>
									";
	}
/*<td><img src='Cliente/Imagenes/{$imagen1}.png' width='32px' height='32px' />
										    <img src='Cliente/Imagenes/{$imagen2}.png' width='32px' height='32px' />
											<img src='Cliente/Imagenes/{$imagen3}.png' width='32px' height='32px' />
										</td>*/

	// llamo a la vista Grilla ----------------------------------------
	
	importar("Cliente/Vistas/Usuario/abm-productos.html");
	

?>