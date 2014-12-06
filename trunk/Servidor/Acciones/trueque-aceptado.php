<?
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/trueque.class.php");
	
	Seguridad::Check();
	$trueque = new Trueque();
	
	global $dato;
	$trueque->aceptarTrueque($dato);
	
	header("location: ../mensaje/trueque-aceptado");
	
	