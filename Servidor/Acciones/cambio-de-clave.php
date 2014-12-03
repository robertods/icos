<?
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::Check();
	
	$usuario = new Usuario();
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
			$datos = explode( ':', $dato );			
			$var['base_modificada'] = '<base href="../"/>';
			
			switch($datos[0]){
				//-------------------------------------
				case 'procesar-edicion':
			
				Class Aux{}
					
					$datos_post = new Aux();
					 
					$datos_post-> clave_usuario = $_POST['txtClaveNueva'];
					$datos_post-> id_usuario = $_POST['hidIdUsuario'];
										
					$resultado = $usuario->actualizarClave($datos_post);
					
					if($resultado){						
						header("location: ../mensaje/edicion-mi-perfil-ok");
					}else{
						header("location: ../mensaje/edicion-mi-perfil-error");
					}					
					die;
				break;
				
				
			}			 
			
	}	
	
	$info= $usuario ->obtenerMiPerfil($_SESSION['id_usuario_activo']);
					
	$var['id_usuario'] =  $info[0]['id_usuario'];
	
	importar("Cliente/Vistas/Usuario/cambiar-clave.html");

?>