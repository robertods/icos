<?
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::Check();
	importar("Cliente/Vistas/Usuario/crear-producto.html");
	
?>