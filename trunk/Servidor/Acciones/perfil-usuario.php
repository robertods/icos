<?	
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/producto.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::Check();
	
	$usuario = new Usuario();
	$producto = new Producto();
	
	global $dato;
	if($dato){
		
			$perfil = $usuario ->obtenerPerfilUsuario($dato);
			$var['base_modificada'] = '<base href="../"/>';
			$var['enlace_modificado'] = 'perfil-usuario/'.$dato;
			
			$var['id_usuario'] = $perfil[0]['id_usuario'];
			$var['nombre'] = $perfil[0]['nombre_perfil'];
			$var['prestigio'] = $perfil[0]['prestigio_perfil'];
			$var['url_usuario'] = $perfil[0]['url_usuario'];
			$dir = 'Cliente/Imagenes/Usuarios/';
			$var['foto_usuario'] = (file_exists($dir.$var['url_usuario'].'.png')) ? $var['url_usuario'] : 'default';
			

			$productos = $producto -> obtenerProductosPerfil($dato);
			$var['disponibles'] = "";
			$cantidad= count($productos);				
				for($i=0;$i<$cantidad;$i++){
					$dir = "Cliente/Imagenes/Productos/";
					$imagen = (file_exists($dir.$productos[$i]['url_producto'].'_'.$productos[$i]['foto_principal'].".png"))? $productos[$i]['url_producto'].'_'.$productos[$i]['foto_principal'] : "default_producto";
				
					$var['disponibles'] .=
					"
					<a class='Ntooltip' href='producto/{$productos[$i]['url_producto']}'>
					<div class='prodisponible' id='{$productos[$i]['id_producto']}'>
						<img src='Cliente/Imagenes/Productos/{$imagen}.png' width='70px' height='70px' /><span>{$productos[$i]['titulo_producto']}</span>
					<input type='hidden' name='hidProducto' value='{$productos[$i]['id_producto']}' />
					</div>
					</a>
						
					";
				}
			
			/*<div class='nombreProducto'>{$productos[$i]['titulo_producto']}</div> */
			
			
			importar("Cliente/Vistas/perfil-usuario.html");
			die;
	}
	
	
	header("location: inicio");
	
?>