<?
	importar("Servidor/Modelos/catalogo.class.php");
	$valor = $_POST['valor'];
	$texto = $_POST['texto'];
	
	//buscar categias de producto o servicio (valor)
	$catalogo = new Catalogo();
	$opciones = $catalogo->obtenerCategorias($valor);
	
	$respuesta = "<option value='Seleccione'>{$texto}</option> 
				  <option disabled>. . . . . . . . . . . . . . . . . . . . . . . . . . . . </option>";
	//echo "<pre>".print_r($opciones,true)."</pre>";die;
	foreach($opciones as $opt){
		$respuesta .= "<option value='{$opt['id_categoria']}'>{$opt['descripcion_categoria']}</option>"; 
	}
	
	echo $respuesta;
?>