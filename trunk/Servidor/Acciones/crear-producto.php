<? 
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::Check();
		
	// accion guardar producto
	if(isset($_POST['MAX_FILE_SIZE'])){
	
		importar("Servidor/Modelos/producto.class.php");
		importar("Servidor/Modelos/etiqueta.class.php");	
		importar("Servidor/Modelos/alerta.class.php"); 
		importar("Servidor/Extensiones/imgUploader.class.php");
		//echo "<pre>".print_r($_POST, true)."</pre>";die;
		/*    
		[combo-tipo] => 0
		[txtNombre] => eduasdasd
		[txtDescripcion] => asdasdasdadasd
		[MAX_FILE_SIZE] => 2000000
		[radFotos] => 1
		[combo-categoria] => 2
			[hidEtiqueta] => zxcxzc,fsdf,sdfs
		[chkDisponible] => on
		[hidUbicacion] => (-34.6052346379374, -58.386454582214355)
			[combo-tipo-deseo] => Seleccione
			[combo-categoria-deseo] => Seleccione
		[hidEtiqueta-deseo] => 
		*/
				
		//guardar etiquetas nuevas
		$etiqueta = new Etiqueta();
		$id_etiquetas = array();
		$etiquetas = explode(",", $_POST['hidEtiqueta']);
		foreach($etiquetas as $desc_etiqueta){
			$id_etiqueta = null;
			$id_etiqueta = $etiqueta->obtenerEtiquetaPorDescripcion($desc_etiqueta);
			$id_etiqueta = (isset($id_etiqueta[0]['id_etiqueta']))? $id_etiqueta[0]['id_etiqueta'] : $id_etiqueta;			
			if($id_etiqueta == null){
				$id_etiqueta = $etiqueta->guardarEtiqueta($desc_etiqueta);				
			}
			
			$id_etiquetas[] = $id_etiqueta;
		} 
		$etiquetas = implode(",", $id_etiquetas);
		
		$producto = new Producto();
		
		//genero un objeto
		class Aux{}
		$datos = new Aux();
		$datos->titulo_producto = $_POST['txtNombre'];
		$datos->foto_principal = $_POST['radFotos'];
		$datos->descripcion_producto = $_POST['txtDescripcion'];
		$datos->url_producto = $producto-> obtenerUrl($_POST['txtNombre']);
		$datos->ubicacion_producto = $_POST['hidUbicacion'];
		$datos->disponible_producto = (isset($_POST['chkDisponible']))?1:0;
		$datos->id_categoria = $_POST['combo-categoria'];
		$datos->etiquetas = $etiquetas;
		$datos->es_servicio = $_POST['combo-tipo'];
		$datos->id_usuario = $_SESSION['id_usuario_activo'];		
								
		//guardo en la base de datos el objeto	
		
		$id_nuevo_producto = $producto->crearProducto($datos);
		
		//GENERACION DE ALERTAS INTELIGENTES
		/*
		$alerta = new Alerta();
		$alerta->enviarAlertasParaInteresados($id_nuevo_producto);
		$alerta->enviarmeAlertasDeMisInteres($id_nuevo_producto);
		*/
		
		//subo las imagenes al servidor
		$subir = new imgUploader();		
		$subir->__set('_dest', "Cliente/Imagenes/Productos/");
		
		$subir->__set('_name', $datos->url_producto."_1.png");
		$subir->init($_FILES['fileFoto1']);
		
		$subir->__set('_name', $datos->url_producto."_2.png");
		$subir->init($_FILES['fileFoto2']);
		
		$subir->__set('_name', $datos->url_producto."_3.png");
		$subir->init($_FILES['fileFoto3']);
		
		$var['url_producto']= $datos->url_producto;
		importar("Cliente/Vistas/Usuario/producto-creado.html");
		exit;
	}
	
	// presentacion del formulario de carga
	importar("Cliente/Vistas/Usuario/crear-producto.html");
	
?>