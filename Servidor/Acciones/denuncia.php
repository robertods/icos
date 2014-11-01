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
					$var['demandado'] = $datos[1];
					$var['producto'] = $datos[2];
					$var['propuesta'] = $datos[3];
				break;
				
				case "propuesta": 
					$var['demandado'] = $datos[1];
					$var['producto'] = $datos[2];
					$var['propuesta'] = $datos[3];	
				break;
				
			    case "procesar": 
					
					$resultado = $denuncia->guardarDenuncia($_POST['comboTipoDenuncia'], $_POST['txtDetalle'], $_POST['demandado'],$_SESSION['id_usuario_activo'], $_POST['producto'],$_POST['propuesta'] );
					
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