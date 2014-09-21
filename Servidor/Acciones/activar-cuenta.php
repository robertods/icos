<?
	global $dato;
	importar("Servidor/Modelos/usuario.class.php");
	
	$usuario = new Usuario();
	$datos = explode( ';', $dato );
	
	if($usuario->activar($datos[0],$datos[1])){
		echo "tu cuenta se activo!.... poner una vista en lugar de esto";
	}
	else{
		echo "error en activacion!.... poner una vista en lugar de esto";	
	}
	
?>