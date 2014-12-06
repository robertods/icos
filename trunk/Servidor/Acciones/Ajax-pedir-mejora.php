<?
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/alerta.class.php");
	
	Seguridad::Check();
	
	$respuesta = false;
	$id_propuesta = $_POST['id_propuesta'];
	
	if(!empty($id_propuesta)){
		$alerta = new Alerta();
		$respuesta = $alerta->enviarAlertasPedirMejora($id_propuesta, $_SESSION['usuario_activo']);			
	}

	if($respuesta){
		$respuesta = "mejora_pedida";
	}
	
	echo $respuesta;