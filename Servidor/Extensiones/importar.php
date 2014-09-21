<?

function importar($ruta, $mensaje=null){
	global $var;
	global $APP;
	
    if(is_null($mensaje)){ $mensaje="No se encuentra el archivo <b>".$ruta."</b>"; }
            
    if(file_exists($ruta)){
        require_once $ruta;
    }
    else{			
        throw new Exception($mensaje);
        die;
    }

}