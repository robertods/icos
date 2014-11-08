<?
   // voy a usar este modelo -----------------------------------------------------
	importar("Servidor/Modelos/denuncia.class.php");
	importar("Servidor/Modelos/propuesta.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::CheckAdmin();
	
	$denuncia = new Denuncia();
	$propuesta = new Propuesta();
	
	
	//consulto la base de datos ---------------------------------------
	
	$respuesta = $denuncia->obtenerTodasDenuncias();
	
	// armo los registros de la tabla con los datos obtenidos ---------	
	$var['registros_tabla'] = "";
	
	$cantidad = count($respuesta);
	for($i=0;$i<$cantidad;$i++){
	
	    //hacer aqui la segunda consulta 
        $array_productos_propuestos = $propuesta->obtenerListaPropuesta( $respuesta[$i]['id_lista_producto_propuesto'] );
						
		$minitabla = "";
		$cantidad_prod = count($array_productos_propuestos);
		for($j=0;$j<$cantidad_prod;$j++){
			$minitabla .= $array_productos_propuestos[$j]['titulo_producto'] . "</br>";
		}
		
		
		$var['registros_tabla'] .= "<tr>
										<td>{$respuesta[$i]['id_denuncia']}</td>
										<td>{$respuesta[$i]['fecha_denuncia']}</td>
										<td>{$respuesta[$i]['nombre_tipo_denuncia']}</td>
										<td>{$respuesta[$i]['url_producto']}</td>
										<td>{$minitabla}</td>
										<td>{$respuesta[$i]['demandado']}</td>
										<td>{$respuesta[$i]['detalle_denuncia']}</td>
										<td>{$respuesta[$i]['demandante']}</td>
									</tr>
									";
	}
	
	// llamo a la vista Grilla ----------------------------------------
	importar("Cliente/Vistas/Admin/denuncias.html");
	
?>