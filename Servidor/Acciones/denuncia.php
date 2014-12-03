<?
   // voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/denuncia.class.php");
	
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::Check();
	
	$denuncia = new Denuncia();
	
	//----------------------------------
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
		$datos = explode( ':', $dato );			
			$var['base_modificada'] = '<base href="../"/>';
			switch($datos[0]){
				case "usuario": 
					$var['demandado'] = $datos[1];
					$var['producto'] = "";
					$var['propuesta'] = "";
				break;
				
				case "producto": 
					$var['demandado'] = $datos[2];
					$var['producto'] = $datos[1];
					$var['propuesta'] = "";
				break;
				
				case "propuesta": 
					$var['demandado'] = $datos[2];
					$var['producto'] = "";
					$var['propuesta'] = $datos[1];	
				break;
				
			    case "procesar": 
					$tipo_denuncia = $_POST['comboTipoDenuncia'];
					$detalle = $_POST['txtDetalle'];
					$demandado = $_POST['demandado'];
					$demandante = $_SESSION['id_usuario_activo'];
					$producto = ($_POST['producto']=="")? NULL : $_POST['producto'];
					$propuesta = ($_POST['propuesta']=="")? NULL : $_POST['propuesta'];
					
					$resultado = $denuncia->guardarDenuncia($tipo_denuncia, $detalle , $demandado, $demandante, $producto, $propuesta );
					
					if($resultado){
						header("location: ../mensaje/procesar-denuncia-ok");
					}else{
						header("location: ../mensaje/procesar-denuncia-error");
					}							
					die;
				break;
			
			}
	}
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $denuncia->obtenerTiposDenuncia();
	$var['tipo'] = "";
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	
	
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
	
		$var['tipo'] .= "	
						<option value='{$respuesta[$i]['id_tipo_denuncia']}'>{$respuesta[$i]['nombre_tipo_denuncia']}</option>				
									
						";
	}

	
	// llamo a la vista Grilla ----------------------------------------
	
	importar("Cliente/Vistas/denunciar.html");
	
?>