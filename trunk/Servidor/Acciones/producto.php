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
			$dir = "Cliente/Imagenes/Usuarios/";
			$foto_usuario = (file_exists($dir.$propuestas[$i]['url_usuario'].".png"))? $propuestas[$i]['url_usuario'] : "default";
			
			if($var['es_mi_producto']){
				$opciones = "<div class='botonesOfertante col-md-3 col-sm-3'>
								<button type='submit' id='btnAceptar' class='botonAceptar'><a href='zzzzzzzz/{$propuestas[$i]['id_propuesta']}'> <i class='fa fa-thumbs-o-up'></i> Aceptar la propuesta</a> </button>	 
								<button type='submit' id='btnMejora' class='botonMejora'><a href='zzzzzzzzz/{$propuestas[$i]['id_propuesta']}'> <i class='fa fa fa-arrow-circle-o-up'></i> Pedir una mejora</a></button>	
								<a href='denuncia/propuesta:{$propuestas[$i]['id_propuesta']}'>Denunciar </a>
							</div>";			
			}
			else{
				$opciones = "";
			}
			
			$diccionario1 = array(	'{URL-USER}' => $propuestas[$i]['url_usuario'],
									'{FOTO-USER}' => $foto_usuario,
									'{ID-PROPUESTA}' => $propuestas[$i]['id_propuesta'],
									'{OPCIONES}' => $opciones
								);
			$plantilla = View::render($plantilla, $diccionario1);
						
			$productosPropuestos = $producto->obtenerProductosPropuesta($propuestas[$i]['id_propuesta']);
							
			$cantidad_productos = count($productosPropuestos);
			$bloques="";
			for($j=0;$j<$cantidad_productos;$j++){
				$dir= "Cliente/Imagenes/Productos/";
				$imagen_prod = (file_exists($dir.$productosPropuestos[$j]['url_producto'].'_'.$productosPropuestos[$j]['foto_principal'].'.png'))? $productosPropuestos[$j]['url_producto'].'_'.$productosPropuestos[$j]['foto_principal'] : "default_producto";
				$bloques .= "<div><a  class='Ntooltip' href='producto/{$productosPropuestos[$j]['url_producto']}'>
							  <img src='Cliente/Imagenes/Productos/{$imagen_prod}.png'/> <span>{$productosPropuestos[$j]['titulo_producto']}</span></a>
						    </div>
							";								 
			}		
								
			$diccionario2 = array(	'{PRODUCTO-OFRECIDO}' => $bloques  );
			$var['propuestas'] .= View::render($plantilla, $diccionario2);	
		}
		
		$var['propuestas'] = ($var['propuestas']!="")? $var['propuestas'] : "</br></br>No hay propuestas por èste producto,";
		
		// Vista
		importar("Cliente/Vistas/pagina-producto.html");
		die;
	}
			
	header("location: inicio");
	
?>