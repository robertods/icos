<?	
	importar("Servidor/Modelos/trueque.class.php");
	importar("Servidor/Modelos/producto.class.php");
	importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/usuario.class.php");
	
	if(Seguridad::getRol($_SESSION["id_usuario_activo"]) == 2 ){
			header("location: administrador-icos");
			die;
	}
	
	Seguridad::Check();
	
	
	
	//traer cantidades----------------------------------------------
	$trueque = new Trueque();
    $producto = new Producto();
	$propuesta = new Propuesta(); 	 
    $usuario = new Usuario();
	$perfil =  $usuario ->obtenerPerfilUsuario($_SESSION['usuario_activo']);
	$var['nombre'] = $perfil[0]['nombre_perfil'];
	
	
	$var['cantidadTrueques'] = $trueque -> ObtenerCantidad($_SESSION['id_usuario_activo']);
	$var['cantidadProductos'] = $producto -> ObtenerCantidad($_SESSION['id_usuario_activo']);
	$realizadas = $propuesta -> ObtenerCantidadRealizadas($_SESSION['id_usuario_activo']);
	$recibidas = $propuesta -> ObtenerCantidadRecibidas($_SESSION['id_usuario_activo']);
	
	$var['cantidadPropuestas'] = $realizadas + $recibidas;
	//-----------------------------------------------------------------
		
	//tamaño mínimo y máximo de la fuente
	$font_min = 12;
	$font_max = 25;
	
	$respuesta = $producto->nubeEtiquetas($font_min , $font_max);
	
	$var['nube'] = "";
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
		
		$var['nube'] .= "<a style='font-size:".rand($font_min,$font_max)."px;' href='producto/{$respuesta[$i]['url_producto']}'>{$respuesta[$i]['url_producto']}</a> 
									";
	}
	
		
				
		
	
	
	importar("Cliente/Vistas/Usuario/inicio.html");
	
?>