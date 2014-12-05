<?
    importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Extensiones/imgUploader.class.php");
	
	$usuario = new Usuario();
	
	Seguridad::Check();
	
	
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
					$datos_post-> nombre_perfil = $_POST['txtNombre'];
					$datos_post-> id_usuario = $_POST['hidIdUsuario'];	
					$datos_post->url_usuario = $_SESSION['usuario_activo']; 
					$resultado = $usuario->actualizarMiPerfil($datos_post);
					
					
  			    if(isset($_POST['MAX_FILE_SIZE'])){
			
						//subo las imagenes al servidor
						$subir = new imgUploader();		
						$subir->__set('_dest', "Cliente/Imagenes/Usuarios/");
						
						$subir->__set('_name', $datos_post->url_usuario.".png");
						$subir->init($_FILES['fileFoto1']);
		
				}
				
					if($resultado){						
						header("location: ../mensaje/edicion-mi-perfil-ok");
					}else{
						header("location: ../mensaje/edicion-mi-perfil-error");
					}	
					die;
				break;
				//-------------------------------------
				case 'eliminar':
					$resultado = $usuario->borrarUsuario($datos[1]);
					
					if($resultado){
						header("location: ../cerrar-sesion");
						
					}else{
						header("location: ../mensaje/eliminarme-error");
					}
					
					die;
				break;
				//-------------------------------------
				
			}			 
			
	}	
	
		
	
	$perfil = $usuario ->obtenerMiPerfil($_SESSION['id_usuario_activo']);
					
	$var['id_usuario'] =  $perfil[0]['id_usuario'];
	$var['nombre'] = $perfil[0]['nombre_perfil'];
	$var['prestigio'] = $perfil[0]['prestigio_perfil'];
	$var['email'] = $perfil[0]['email_usuario'];
	$var['clave'] = $perfil[0]['clave_usuario'];
	$var['url'] = $perfil[0]['url_usuario'];	
	$dir = 'Cliente/Imagenes/Usuarios/';
	$var['avatar_actual'] = (file_exists($dir.$var['url'].'.png')) ? $var['url'] : 'default';	
	importar("Cliente/Vistas/Usuario/mi-perfil.html");
		
?>