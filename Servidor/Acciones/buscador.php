<?
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::CheckAdmin();
	importar("Cliente/Vistas/buscador-mapa.html");
	
?>