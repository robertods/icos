<?
	importar("Servidor/Extensiones/escalarImagen.class.php");
	
	//redimensiono la imagen para que entre en el marker
	$imagen_producto = "Cliente/Imagenes/Markers/default_min.png";
	redimensionarConProporcion("Cliente/Imagenes/Markers/default.png", 64, 64, $imagen_producto );
			
	// Creo dos imagenes, una es el fondo y la otra la foto que le voy a superponer 
	$fondo = imagecreatefrompng("Cliente/Imagenes/Markers/base.png"); 
	//$foto = imagecreatefrompng($imagen_producto); 
	$foto = imagecreatefromstring(file_get_contents($imagen_producto));
	
	// Obtengo los tamaños de las imagenes 
	$fondoAncho = imagesx($fondo); 
	$fondoAlto = imagesy($fondo); 
	$fotoAncho = imagesx($foto); 
	$fotoAlto = imagesy($foto); 
	 
	//mantiene la transparencia del fondo
	imagealphablending($fondo, true); 
	imagesavealpha($fondo, true); 	
		
	// Copiamo la imágen de fondo a la imagen final  
	imagecopy($fondo,$foto,12 + (64-$fotoAncho)/2 ,11 + (64-$fotoAlto)/2 ,0,0,$fotoAncho,$fotoAlto); 
	 
	// Damos salida a la imagen final 
	$direccion = "Cliente/Imagenes/Markers/resultado.png";
	imagepng($fondo, $direccion); 
	 
	// Destruimos las imágenes 
	imagedestroy($fondo); 
	imagedestroy($foto); 
	
?>