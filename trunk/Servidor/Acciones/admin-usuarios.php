<?
	// voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	$usuario = new Usuario();
	
	Seguridad::CheckAdmin();

	// obtengo los datos para edicion y borrado si los hay ------------------------
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
			$datos = explode( ':', $dato );			
			$var['base_modificada'] = '<base href="../"/>';
			
			switch($datos[0]){
				//-------------------------------------
				case 'editar':					
					$informacion = $usuario->obtenerUsuario($datos[1]);
					
					$var['avatar'] 	  = $informacion[0]['avatar_perfil'];
					$var['url'] 	  = $informacion[0]['url_usuario'];
					$var['nombre'] 	  = $informacion[0]['nombre_perfil'];
					$var['email'] 	  = $informacion[0]['email_usuario'];
					$var['prestigio'] = $informacion[0]['prestigio_perfil'];
					$var['id'] = $datos[1];
					
					importar("Cliente/Vistas/Admin/form-edicion-usuario.html");
					die;			
				break;
				//-------------------------------------
				case 'procesar-edicion':
				
					Class Aux{}
					$datos_post = new Aux();
					$datos_post->avatar_perfil = ($_POST['avatar']=="null") ? 'NULL' : $_POST['avatar'];
					
					$datos_post->url_usuario = $_POST['txtUrl'];
					$datos_post->nombre_perfil = $_POST['txtNombre'];
					$datos_post->email_usuario = $_POST['txtEmail'];
					$datos_post->prestigio_perfil = $_POST['txtPrestigio'];
					$datos_post->id_usuario = $_POST['hidIdUsuario'];
										
					$resultado = $usuario->actualizarUsuario($datos_post);
					
					if($resultado){						
						header("location: ../mensaje/edicion-usuario-ok:{$_POST['txtUrl']}");
					}else{
						header("location: ../mensaje/edicion-usuario-error:{$_POST['txtUrl']}");
					}					
					die;
				break;
				//-------------------------------------
				case 'eliminar':
					$resultado = $usuario->borrarUsuario($datos[1]);
					
					if($resultado){
						header("location: ../mensaje/borrado-usuario-ok:{$datos[2]}");
					}else{
						header("location: ../mensaje/borrado-usuario-error:{$datos[2]}");
					}							
					die;
				break;
				//-------------------------------------
				
			}			 
			
	}
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $usuario->obtenerUsuarios();
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	
	$var['registros_tabla'] = "";
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
		$imagen = (is_null($respuesta[$i]['avatar_perfil'])) ? 'default' : $respuesta[$i]['avatar_perfil']; 
		$var['registros_tabla'] .= "<tr>
										<td><img src='Cliente/Imagenes/Usuarios/{$imagen}.png' width='32px' height='32px' /></td>
										<td>{$respuesta[$i]['url_usuario']}</td>
										<td>{$respuesta[$i]['nombre_perfil']}</td>
										<td>{$respuesta[$i]['email_usuario']}</td>										
										<td>{$respuesta[$i]['prestigio_perfil']}</td>
										<td>
											<a href='admin-usuarios/editar:{$respuesta[$i]['id_usuario']}'>Editar</a>
											|
											<a href='javascript:borrarUsuario({$respuesta[$i]['id_usuario']},\"{$respuesta[$i]['url_usuario']}\")'>Eliminar</a></td>
									</tr>
									";
	}

	// llamo a la vista Grilla ----------------------------------------
	
	importar("Cliente/Vistas/Admin/bm-usuarios.html");
	
?>