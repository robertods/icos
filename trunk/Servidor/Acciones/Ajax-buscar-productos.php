<?php
	importar("Servidor/Modelos/producto.class.php");
	
	$producto = new Producto();
	
	$filtro_tipo = ($_POST['combo_tipo']!="Seleccione")? "AND p.es_servicio = ".$_POST['combo_tipo'] : "";
	$filtro_categoria = ($_POST['combo_categoria']!="Seleccione")? " AND p.id_categoria = ".$_POST['combo_categoria'] : "";
	
	$etiquetas = explode(',', $_POST["texto_buscado"] );
	
	$etiquetas_validas = array();
	$cantidad = count($etiquetas);
	for($i=0;$i<$cantidad;$i++){
		if(strlen(trim($etiquetas[$i]))>0){
			$etiquetas_validas[] = $etiquetas[$i];
		}
	}
	
	$etiquetas = implode('|', $etiquetas_validas );
	
	$productos = $producto->buscarProductosPorEtiquetas($etiquetas, $filtro_tipo, $filtro_categoria);

	$dir1 = "Cliente/Imagenes/Markers/";
	$dir2 = "Cliente/Imagenes/Productos/";
	foreach($productos as $k => $elem ){
		$productos[$k]['icono'] = (file_exists($dir1.$elem['url_producto'].".png"))? $elem['url_producto'] : "default_marker";
		$productos[$k]['foto'] = (file_exists($dir2.$elem['url_producto'].$elem['foto_principal'].".png"))? $elem['url_producto'] : "default_producto";
	}
	
	echo json_encode($productos);
?>