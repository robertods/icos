<?
	importar("Servidor/Modelos/trueque.class.php");
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::Check();
	
	$trueque = new Trueque();
	
	global $dato;
		
	$partes = $trueque->obtenerPartes($dato);
	$parte_puntuar = ($partes[0]['ofertante']==$_SESSION['usuario_activo'])? $partes[0]['demandante'] : $partes[0]['ofertante'];
		
	$var['url_usuario'] = $parte_puntuar;	
	$var['id_trueque'] = $dato;
			
	$dir = "Cliente/Imagenes/Usuarios/";
	$var['foto'] = (file_exists($dir.$var['url_usuario'].".png")) ? $var['url_usuario'] : "default";
	$var['base_modificada'] = '<base href="../"/>';
	
	importar("Cliente/Vistas/puntuacion.html");
	
?>