<? 
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/etiqueta.class.php");	
	Seguridad::Check();
	$etiqueta = new Etiqueta();
	
	// accion guardar producto
	
	if(isset($_POST['MAX_FILE_SIZE'])){
	
		importar("Servidor/Modelos/producto.class.php");
	
		importar("Servidor/Modelos/alerta.class.php"); 
		importar("Servidor/Extensiones/imgUploader.class.php");
		//echo "<pre>".print_r($_POST, true)."</pre>";die;
						
		//guardar etiquetas nuevas
		
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
		
		//guardar etiquetas nuevas (deseo)
		$id_etiquetas_deseo = array();
		$etiquetas_deseo = explode(",", $_POST['hidEtiqueta-deseo']);
		foreach($etiquetas_deseo as $desc_etiqueta){
			$id_etiqueta_deseo = null;
			$id_etiqueta_deseo = $etiqueta->obtenerEtiquetaPorDescripcion($desc_etiqueta);
			$id_etiqueta_deseo = (isset($id_etiqueta_deseo[0]['id_etiqueta']))? $id_etiqueta_deseo[0]['id_etiqueta'] : $id_etiqueta_deseo;			
			if($id_etiqueta_deseo == null){
				$id_etiqueta_deseo = $etiqueta->guardarEtiqueta($desc_etiqueta);				
			}
			
			$id_etiquetas_deseo[] = $id_etiqueta_deseo;
		} 
		$etiquetas_deseo = implode(",", $id_etiquetas_deseo);
		

		// creo obj para manipular productos
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
		
		// guardar producto deseado si lo ingreso
		/*[combo-tipo-deseo] => 1
			[combo-categoria-deseo] => 31
			[hidEtiqueta-deseo] => uno,dos,tres
			
			[combo-tipo-deseo] => Seleccione
			[combo-categoria-deseo] => Seleccione
			[hidEtiqueta-deseo] => 
			*/
		if ($_POST['combo-tipo-deseo'] != 'Seleccione' &&  $_POST['combo-categoria-deseo'] != 'Seleccione' && !empty ($_POST['hidEtiqueta-deseo'])){
		
			//genero un objeto
			class Aux2{}
			$datos2 = new Aux2();			
			$datos2->id_categoria = $_POST['combo-categoria-deseo'];
			$datos2->etiquetas = $etiquetas_deseo;
			$datos2->es_servicio = $_POST['combo-tipo-deseo'];
			$datos2->id_producto = $id_nuevo_producto;
			
			$id_nuevo_producto_deseado = $producto -> guardarProductoDeseado( $datos2 );
			
			//GENERACION DE ALERTAS INTELIGENTES
		
			if(!empty($id_nuevo_producto_deseado)){
				$alerta = new Alerta();
				//$alerta->enviarAlertasParaInteresados($id_nuevo_producto, $datos->id_categoria, $_SESSION['id_usuario_activo'], $_SESSION['usuario_activo']);
				$alerta->enviarmeAlertasDeMisIntereses($id_nuevo_producto, $datos2->id_categoria, $_SESSION['id_usuario_activo']);				
			}
			
			
			
			
		}
			
		
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
	
	//busco las opciones disponibles para "etiquetas prefedinidas"
	$todas_etiquetas = $etiqueta -> obtenerEtiquetasSolas(); 
	$cant_etiquetas = count($todas_etiquetas);
	for($i=0;$i<$cant_etiquetas;$i++){
		$etiquetas_disponibles[$i] = "'".$todas_etiquetas[$i]['descripcion_etiqueta']."'";
	}
	//aqui armo un array js
	$var['etiquetas_disponibles'] = "[".implode(", ", $etiquetas_disponibles )."]";
	
	// presentacion del formulario de carga
	importar("Cliente/Vistas/Usuario/crear-producto.html");
	
?>