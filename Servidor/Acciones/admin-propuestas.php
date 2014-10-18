<?
// voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	$propuesta = new Propuesta();
	
	Seguridad::CheckAdmin();











	importar("Cliente/Vistas/Admin/bm-propuestas.html");
	
?>