<?
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::Check();
	
	global $dato;
	if($dato){
			$datos = explode( ':', $dato );			
					
			if($datos[0]=="procesar"){
				Class Aux{}
				$datos_post = new Aux();
					
				$datos_post->url_producto = $_POST['txtUrl'];
				$datos_post->titulo_producto = $_POST['txtTitulo'];
				$datos_post->tipo_producto = $_POST['cmbTipo'];
									
				$resultado = $producto->crearProducto($datos_post);
				
				//genero alertas para los interesados en este tipo de producto
				$alerta->generarAlertaParaInteresados();
				
				//genero alertas para aquellos que tienen productos que este usuario desea a cambio
				$alerta->generarAlertaParaCandidatos();
				
				if($resultado){						
					header("location: ../mensaje/nuevo-producto-ok:{$_POST['txtUrl']}");
				}else{
					header("location: ../mensaje/nuevo-producto-error:{$_POST['txtUrl']}");
				}				
				die;
			}
	}
	
	importar("Cliente/Vistas/crear-producto.html");
	
?>