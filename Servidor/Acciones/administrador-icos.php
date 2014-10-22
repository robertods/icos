<?	
	importar("Servidor/Modelos/seguridad.class.php");
	Seguridad::CheckAdmin();
	
	
	
	importar("Cliente/Vistas/Admin/admin.html");
	
?>