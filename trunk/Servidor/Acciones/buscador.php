<?
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::Check();
	importar("Cliente/Vistas/buscador-mapa.html");
	
?>