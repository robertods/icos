<?
 
	importar("Servidor/Modelos/usuario.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::Check();
	
	
	importar("Cliente/Vistas/puntuacion.html");
	
?>