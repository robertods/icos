<?
    importar("Servidor/Modelos/producto.class.php");
	importar("Servidor/Modelos/seguridad.class.php");
	
	Seguridad::Check();
	
	$producto = new  Producto();
	
	global $dato;	
	if($dato){
		$datos = explode( ':', $dato );	
		switch($datos[0]){
			//-------------------------------------
			case 'nueva':
				//$datos[1]
			break;
			//-------------------------------------
			case 'editar':
				
			break;
			//-------------------------------------
			case 'borrar':
				
			break;
			//-------------------------------------
			case 'guardar':
				print_r($_POST); die;
				//guardar aqui la propuesta y enviar a pagina del producto
				
			break;
			//-------------------------------------
		}
		
		$var['base_modificada'] = '<base href="../"/>';
		$var['enlace_modificado'] = 'mi-propuesta/'.$datos[0].':'.$datos[1];
		
		$var['url_producto'] = 'producto hardcodeado';
		$var['imagen'] = "default_producto";
		$var['id_producto'] = 1;
		
		//genero los productos disponibles
		$var['disponibles'] = "";
		$cantidad= 5;
		for($i=0;$i<$cantidad;$i++){
			$var['disponibles'] .=
			"<div class='prodx' id='prod1' style='width:100%;height:80px;background:orange;border:1px solid red;margin-bottom:2px;'>
				<img src='Cliente/Imagenes/Productos/{$var['imagen']}.png' width='55px' height='55px' />
				nombre producto
				<input type='hidden' name='hidProducto' value='1' />
			</div>";
		}
		
		//Vista
		importar("Cliente/Vistas/Usuario/mi-propuesta.html");
		die;
	}
	
	header("location: inicio");

?>