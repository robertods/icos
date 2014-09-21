<?
Class View{

	static function template($archivo){
                $rutaTemplate = 'Cliente/Vistas/'.$archivo;
                if(is_file($rutaTemplate)){
                    return file_get_contents($rutaTemplate);
                }
                else{
                    throw new Exception("No existe el template <b>".$archivo."</b>");                   
                }
	}
	
	static function block($plantilla, $nombre){
		$regex = "/<!--$nombre-->(.|\n){1,}<!--$nombre-->/";
		preg_match($regex, $plantilla, $matches);
		return $matches[0];
	}
	
	static function renderBlock($trama, &$terminos, &$data){
		$block = "";		
		foreach($data as $array) {
			$diccionario = array();			
			for($i=0;$i<count($terminos);$i++){
				$diccionario[$terminos[$i]]=$array[$i];							
			}			
			$block .= View::render($trama, $diccionario);
		}		
		return $block;
	}
	        
        static function render($plantilla, $data=null, $trama=null){		
		
                if($data==null){
                        $render = $plantilla;
                }
                elseif($trama==null){
			$render = str_replace(array_keys($data), array_values($data), $plantilla);
		}
		else{
			$render = str_replace($trama, $data, $plantilla);		
		}
		return $render;
	}
        
	
}
?>