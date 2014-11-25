<?	
    importar("Servidor/Modelos/producto.class.php");
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/view.class.php");
	importar("Servidor/Modelos/alerta.class.php");
	
	Seguridad::Check();
	
	$producto = new  Producto();	
	$usuario = new Usuario();
	$alerta = new Alerta();
		
	global $dato;
	if($dato){	

		//Carga de la pagina del producto
		$informacion = $producto->obtenerPaginaProducto($dato);
		$var['base_modificada'] = '<base href="../"/>';
		$var['enlace_modificado'] = 'producto/'.$dato;
					
		$var['titulo'] = $informacion[0]['titulo_producto'];
		$var['descripcion'] = $informacion[0]['descripcion_producto'];
		$var['nombre'] = $informacion[0]['nombre_perfil'];
		$var['prestigio'] = $informacion[0]['prestigio_perfil'];
		$var['id_usuario_ofrece'] = $informacion[0]['id_usuario'];
		$var['url_usuario_ofrece'] = $informacion[0]['url_usuario'];
		$var['url_producto'] = $informacion[0]['url_producto'];
		$var['id_producto'] = $informacion[0]['id_producto'];
				
		$var['es_mi_producto'] = ($var['id_usuario_ofrece'] == $_SESSION['id_usuario_activo'])? true : false;
		
		//Al ver esta pagina, elimina las alertas que tengas por este producto.
		$alerta->eliminarAlertaDeEsteProducto($var['id_producto'], $_SESSION['id_usuario_activo']);
		
		$dir = "Cliente/Imagenes/Usuarios/";		
		$var['foto_usuario_ofrece'] = (file_exists($dir.$var['url_usuario_ofrece'].".png"))? $var['url_usuario_ofrece'] : 'default';		
		
		$dirProd = "Cliente/Imagenes/Productos/";
		$var['foto1'] = (file_exists($dirProd.$var['url_producto']."_1.png"))? $var['url_producto']."_1" : 'default_producto';			
		$var['foto2'] = (file_exists($dirProd.$var['url_producto']."_2.png"))? $var['url_producto']."_2" : 'default_producto';
		$var['foto3'] = (file_exists($dirProd.$var['url_producto']."_3.png"))? $var['url_producto']."_3" : 'default_producto';			
		
		// Propuestas
		$var['mi_propuesta'] = 0;
		$propuestas = $producto->obtenerPropuestas($var['id_producto']);
		$var['propuestas'] = "";			
		$cantidad = count($propuestas);	
		for($i=0;$i<$cantidad;$i++){		
			$plantilla = View::template('propuesta.html');
			
			$var['mi_propuesta'] += ($propuestas[$i]['url_usuario']==$_SESSION['usuario_activo'])? (int)$propuestas[$i]['id_propuesta'] : 0;
			
			$diccionario1 = array(	'{URL-USER}' => $propuestas[$i]['url_usuario'],
									'{ID-PROPUESTA}' => $propuestas[$i]['id_propuesta']
								);
			$plantilla = View::render($plantilla, $diccionario1);
			
			$productosPropuestos = $producto->obtenerProductosPropuesta($propuestas[$i]['id_propuesta']);
			
			$trama = View::block($plantilla, 'PRODUCTO-OFRECIDO');
			$terminos = array(	'{URL}', '{PRINCIPAL}', '{TITULO}' );			
			$block = View::renderBlock( $trama, $terminos, $productosPropuestos );
			
			$var['propuestas'] .= View::render($plantilla, $block, $trama);				
		}
		
		$var['propuestas'] = ($var['propuestas']!="")? $var['propuestas'] : "</br></br>No hay propuestas por èste producto,";
		
		// Vista
		importar("Cliente/Vistas/pagina-producto.html");
		die;
	}
			
	header("location: inicio");
	
?>