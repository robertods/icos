<?
	// voy a usar este modelo -----------------------------------------------------
	
	importar("Servidor/Modelos/usuario.class.php");
	$usuario = new Usuario();

	// obtengo los datos para edicion y borrado si los hay ------------------------
	
	global $dato;
	$var['mensaje_tarea'] = "";
	$var['base_modificada'] = "";
	
	if($dato){
			$datos = explode( ':', $dato );
			
							/* NOTA: $dato es un parametro que se pasa en los link, para que la accion haga algo distinto. Si en el link no se pasa un dato, este es null.
								por ejemplo un dato puede traer un id, y la accion ser mostrar_perfil... entonces se mostrará el perfil de aquel id.
								
								$datos esto trae 'tarea;id' o 'null' en este caso. $datos[0] es la tarea (edicion o borrado) y $datos[1] es el id a borrar o editar.
							*/
			

			/* NOTA: esto es necesario cuando se usa $dato porque la url el navegador la usa para buscar los css, y los datos "editar:1" los toma como carpeta, 
			   y no encuentra los css, para eso hay que "volver" una carpeta atras:
			*/
			$var['base_modificada'] = '<base href="../"/>';

			
			switch($datos[0]){
				case 'editar':
					//a partir del id, obtengo los demas datos para cargarlos en el formulario:
					$informacion = $usuario->obtenerUsuario($datos[1]);
					
					//echo "<pre>".print_r($informacion, true)."</pre>";die;
					
					//preparo la informacion obtenida, para que la vista pueda usarla:					
					$var['avatar'] 	  = $informacion[0]['avatar_perfil'];
					$var['url'] 	  = $informacion[0]['url_usuario'];
					$var['nombre'] 	  = $informacion[0]['nombre_perfil'];
					$var['email'] 	  = $informacion[0]['email_usuario'];
					$var['prestigio'] = $informacion[0]['prestigio_perfil'];
					$var['id'] = $datos[1];
					
					//mando a la vista de formulario de edicion y con die, mato el php para que no ejecute lo que sigue despues este case.
					importar("Cliente/Vistas/Admin/form-edicion-usuario.html");
					die;			
				break;
				case 'procesar-edicion':
					//Aqui vienen los datos por post y se los doy al metodo para que los guarde en la base, luego informo el resultado en la grilla, ya que dejo que siga (no corto con die).
					Class Aux{}
					$datos_post = new Aux();
					//echo "<pre>".print_r($_POST, true)."</pre>";die;
					$datos_post->avatar_perfil = ($_POST['avatar']=="null") ? 'NULL' : $_POST['avatar'];
					
					$datos_post->url_usuario = $_POST['txtUrl'];
					$datos_post->nombre_perfil = $_POST['txtNombre'];
					$datos_post->email_usuario = $_POST['txtEmail'];
					$datos_post->prestigio_perfil = $_POST['txtPrestigio'];
					$datos_post->id_usuario = $_POST['hidIdUsuario'];
										
					$resultado = $usuario->actualizarUsuario($datos_post);
					
					if($resultado){						
						header("location: ../mensaje/edicion-ok: {$_POST['id_usuario']}");
					}else{
						header("location: ../mensaje/edicion-error: {$_POST['id_usuario']}");
					}	
					
					//mando a la vista que confirma la operacion y con die, mato el php para que no ejecute lo que sigue despues este case.
					
					//importar("Cliente/Vistas/Comunes/mensaje.html");
					die;
				break;
				case 'eliminar':
					//hago borrado logico en la base, pero no hago die, para que continue ejecutando, y me muestre la grilla... (pero defino el mensaje de borrado)
					$resultado = $usuario->borrarUsuario($datos[1]);
					
					if($resultado){
						header("location: mensaje/borrado-ok:{$datos[1]}");
					}else{
						header("location: mensaje/borrado-error:{$datos[1]}");
					}	
					
					//mando a la vista que confirma la operacion y con die, mato el php para que no ejecute lo que sigue despues este case.
								
					die;
				break;		
			}			 
			
	}
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $usuario->obtenerUsuarios();
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	
					/* NOTA: $var es el unico array que puede ser accedido en una vista, 
						por eso todas las variables que necesitemos mostrar en 
						una vista van dentro de ese array.
					*/
		
	$var['registros_tabla'] = "";
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
		$var['registros_tabla'] .= "<tr>
										<td><img src='Clientes/Imagenes/{$respuesta[$i]['avatar_perfil']}.png'/></td>
										<td><a href='admin-usuarios/editar:{$respuesta[$i]['id_usuario']}'>{$respuesta[$i]['url_usuario']}</a></td>
										<td>{$respuesta[$i]['nombre_perfil']}</td>
										<td>{$respuesta[$i]['email_usuario']}</td>										
										<td>{$respuesta[$i]['prestigio_perfil']}</td>
										<td><a href='admin-usuarios/eliminar:{$respuesta[$i]['id_usuario']}'>Eliminar {$respuesta[$i]['id_usuario']}</a></td>
									</tr>
									";
	}

	// llamo a la vista Grilla ----------------------------------------
	
	importar("Cliente/Vistas/Admin/bm-usuarios.html");
	
?>