<?
	// voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	$usuario = new Usuario();
	
	Seguridad::Check();

	
	global $dato;
	$var['base_modificada'] = "";
	
	
	
	$datos = explode( ':', $dato );			
	$var['base_modificada'] = '<base href="../"/>';
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $usuario->obtenerPerfilUsuario($datos[1]);
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	
	$var['registros_tabla'] = "";
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
		$imagen = (is_null($respuesta[$i]['avatar_perfil'])) ? 'default' : $respuesta[$i]['avatar_perfil']; 
		$var['registros_tabla'] .= "<tr>
										<td><img src='Cliente/Imagenes/{$imagen}.png' width='32px' height='32px' /></td>
										<td>{$respuesta[$i]['nombre_perfil']}</td>
										<td>{$respuesta[$i]['email_usuario']}</td>	
										<td>{$respuesta[$i]['clave_usuario']}</td>	
										<td>{$respuesta[$i]['prestigio_perfil']}</td>
										
									</tr>
									";
	}
	// llamo a la vista Grilla ----------------------------------------
	
	importar("Cliente/Vistas/Usuario/mi-perfil.html");
	
?>