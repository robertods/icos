<?php		
    global $miBD;
    importar("Servidor/Datos/Proveedores/ProveedorMySql.class.php");  //archivo del proveedor implementado
    importar("Servidor/Datos/CapaDeDatos.class.php");	    //controlador de la capa de base de datos 
    global $CONNECTION; 
    $miBD = CapaDeDatos::crearConexion($CONNECTION);   	//crea la unica instancia de conexion a db con el proveedor implementado
?>