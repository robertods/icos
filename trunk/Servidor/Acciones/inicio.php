<?	
	importar("Servidor/Modelos/trueque.class.php");
	importar("Servidor/Modelos/producto.class.php");
	importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	
	
	if(Seguridad::getRol($_SESSION["id_usuario_activo"]) == 2 ){
			header("location: administrador-icos");
			die;
	}
	
	Seguridad::Check();
	
	//traer cantidades
	$trueque = new Trueque();
    $producto = new Producto();
	$propuesta = new Propuesta(); 	 

	$var['cantidadTrueques'] = $trueque -> ObtenerCantidad($_SESSION['id_usuario_activo']);
	$var['cantidadProductos'] = $producto -> ObtenerCantidad($_SESSION['id_usuario_activo']);
	$realizadas = $propuesta -> ObtenerCantidadRealizadas($_SESSION['id_usuario_activo']);
	$recibidas = $propuesta -> ObtenerCantidadRecibidas($_SESSION['id_usuario_activo']);
	
	$var['cantidadPropuestas'] = $realizadas + $recibidas;
	
	
	importar("Cliente/Vistas/Usuario/inicio.html");
	
?>