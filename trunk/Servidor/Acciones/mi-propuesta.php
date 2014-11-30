<?
    importar("Servidor/Modelos/producto.class.php");
	importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::Check();
	
	$producto = new Producto();
	$propuesta = new Propuesta();
	
	global $dato;	
	if($dato){
		$datos = explode( ':', $dato );	
		switch($datos[0]){
			//-------------------------------------
			case 'nueva':
				
				$mis_productos = $producto->obtenerMisProductos($_SESSION['id_usuario_activo']);
				
				//echo "<pre>".print_r($mis_productos, true)."</pre>";die;
				
				$var['disponibles'] = "";
				$var['elegidos'] = "";
				$var['accion'] = "guardar";
				$id_producto_ofrecido = $datos[1];
				
				//genero los productos disponibles
				$cantidad= count($mis_productos);				
				for($i=0;$i<$cantidad;$i++){
					$dir = "Cliente/Imagenes/Productos/";
					$imagen = (file_exists($dir.$mis_productos[$i]['url_producto'].'_'.$mis_productos[$i]['foto_principal'].".png"))? $mis_productos[$i]['url_producto'].'_'.$mis_productos[$i]['foto_principal'] : "default_producto";
				
					$var['disponibles'] .=
					"<div class='prodx' id='{$mis_productos[$i]['id_producto']}'>
						<img src='Cliente/Imagenes/Productos/{$imagen}.png' width='55px' height='55px' />
						<div class='nombreProducto'>{$mis_productos[$i]['titulo_producto']}<i class='fa fa-plus-circle'></i></div> 
						<input type='hidden' name='hidProducto' value='{$mis_productos[$i]['id_producto']}' />
					</div>";
				}
				
			break;
			//-------------------------------------
			case 'editar':
				
				$mis_productos = $producto->obtenerMisProductos($_SESSION['id_usuario_activo']);
				
				//echo "<pre>".print_r($mis_productos, true)."</pre>";die;
				
				$mis_elegidos = $propuesta->obtenerProductosPropuesta($datos[1]);
				$mis_elegidos_ids = array();
				
				foreach($mis_elegidos as $indice){
					$mis_elegidos_ids[] = $indice['id_producto'];
				}
				
				//echo "<pre>".print_r($mis_elegidos_ids, true)."</pre>";die;
				
				//genero los productos disponibles
				$var['disponibles'] = "";
				$var['elegidos'] = "";
				$var['accion'] = "guardar_edicion";
				$id_producto_ofrecido = $producto->obtenerIdProductoDeLaPropuesta($datos[1]);
				
				//genero los productos disponibles/elegidos
				$cantidad= count($mis_productos);				
				for($i=0;$i<$cantidad;$i++){
					$dir = "Cliente/Imagenes/Productos/";
					$imagen = (file_exists($dir.$mis_productos[$i]['url_producto'].'_'.$mis_productos[$i]['foto_principal'].".png"))? $mis_productos[$i]['url_producto'].'_'.$mis_productos[$i]['foto_principal'] : "default_producto";
					
					if(in_array($mis_productos[$i]['id_producto'], $mis_elegidos_ids)){	
						$var['elegidos'] .=
							"<div class='prodx negativo' id='{$mis_productos[$i]['id_producto']}'>
								<img src='Cliente/Imagenes/Productos/{$imagen}.png' width='55px' height='55px' />
								<div class='nombreProducto'>{$mis_productos[$i]['titulo_producto']}<i class='fa fa-minus-circle'></i></div> 
								<input type='hidden' name='hidProducto' value='{$mis_productos[$i]['id_producto']}' />
							</div>";
						
					}
					else{
						$var['disponibles'] .=
							"<div class='prodx' id='{$mis_productos[$i]['id_producto']}'>
								<img src='Cliente/Imagenes/Productos/{$imagen}.png' width='55px' height='55px' />
								<div class='nombreProducto'>{$mis_productos[$i]['titulo_producto']}<i class='fa fa-plus-circle'></i></div> 
								<input type='hidden' name='hidProducto' value='{$mis_productos[$i]['id_producto']}' />
							</div>";
					}
					
				}
				
				
			break;
			//-------------------------------------
			case 'guardar_edicion':				
				$mis_productos_propuestos = substr($_POST['hidPropuestos'], 0, strlen($_POST['hidPropuestos']) -1 );
				$mis_productos_propuestos = explode(",", $mis_productos_propuestos);
				
				$propuesta->editarListaPropuesta($_POST['hidProducto'], $_SESSION['id_usuario_activo'], $mis_productos_propuestos);
				
				header("location: ../Producto/".$_POST['hidUrlProducto']); die;
			break;
			//-------------------------------------
			case 'borrar':	
				$propuesta->eliminarPropuesta($datos[1]);
				header("location: ../Producto/".$datos[2]); die;
			break;
			//-------------------------------------
			case 'guardar':				
				//guardar aqui la propuesta y enviar a pagina del producto
				$mis_productos_propuestos = substr($_POST['hidPropuestos'], 0, strlen($_POST['hidPropuestos']) -1 );
				$mis_productos_propuestos = explode(",", $mis_productos_propuestos);
				
				$propuesta->guardarPropuesta($_POST['hidProducto'], $_SESSION['id_usuario_activo'], $mis_productos_propuestos);
				
				header("location: ../Producto/".$_POST['hidUrlProducto']); die;
			break;
			//-------------------------------------
		}
				
		//echo "<pre>".print_r($id_producto_ofrecido, true)."</pre>";die;
		
		$var['base_modificada'] = '<base href="../"/>';
		$var['enlace_modificado'] = 'mi-propuesta/'.$datos[0].':'.$id_producto_ofrecido;
		
		$producto_ofrecido = $producto->obtenerProducto($id_producto_ofrecido);
		
		//echo "<pre>".print_r($producto_ofrecido, true)."</pre>";die;
		
		$var['url_producto'] = $producto_ofrecido[0]['url_producto'];
		$dir = "Cliente/Imagenes/Productos/";
		$var['imagen'] = (file_exists($dir.$producto_ofrecido[0]['url_producto'].'_'.$producto_ofrecido[0]['foto_principal'].".png"))? $producto_ofrecido[0]['url_producto'].'_'.$producto_ofrecido[0]['foto_principal'] : "default_producto";
		$var['id_producto'] = $id_producto_ofrecido;
						
		//Vista
		importar("Cliente/Vistas/Usuario/mi-propuesta.html");
		die;
	}
	
	header("location: inicio");

?>