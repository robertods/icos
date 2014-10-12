<?
	importar("Cliente/Vistas/Usuario/inicio.html");
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::CheckAdmin();
?>