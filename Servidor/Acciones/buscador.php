<?
	importar("Servidor/Modelos/seguridad.class.php");
	importar("Servidor/Modelos/etiqueta.class.php");
	Seguridad::Check();
	
	$etiqueta = new Etiqueta();
	
	//busco las opciones disponibles para "etiquetas prefedinidas"
	$todas_etiquetas = $etiqueta -> obtenerEtiquetasSolas(); 
	$cant_etiquetas = count($todas_etiquetas);
	for($i=0;$i<$cant_etiquetas;$i++){
		$etiquetas_disponibles[$i] = "'".$todas_etiquetas[$i]['descripcion_etiqueta']."'";
	}
	//aqui armo un array js
	$var['etiquetas_disponibles'] = "[".utf8_encode(implode(", ", $etiquetas_disponibles ))."]";
	
	
	
	importar("Cliente/Vistas/buscador-mapa.html");
	
?>