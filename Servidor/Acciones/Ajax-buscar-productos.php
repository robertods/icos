<?php
	importar("Servidor/Modelos/producto.class.php");
	
	$producto = new Producto();
	
	$etiquetas = explode(' ', $_POST["texto_buscado"] );
	
	$etiquetas_validas = array();
	$cantidad = count($etiquetas);
	for($i=0;$i<$cantidad;$i++){
		if(strlen(trim($etiquetas[$i]))>0){
			$etiquetas_validas[] = $etiquetas[$i];
		}
	}
	
	$etiquetas = implode('|', $etiquetas_validas );
	
	$productos = $producto->buscarProductosPorEtiquetas($etiquetas);

	echo json_encode($productos);
?>