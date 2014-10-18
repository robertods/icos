<?
 class Propuesta{
        private $id_propuesta;
		
		// GETTERS Y SETTERS --------------------------------------------------------------------
        public function get($dato){ 			
            switch($dato){
                case 'id_propuesta':  $dato = $this->id_propuesta; break;
				
            }			
            return $dato; 		
        }

		//----------------------------------------------------------------------------------------
		// 		METODOS A B M
		//----------------------------------------------------------------------------------------
		public function obtenerPropuestas(){
			global $miBD;
			$query = "	SELECT 	
										 
						FROM 
                     
						WHERE debaja = 0					
					 ";
			$resultado = $miBD->ejecutar($query);
			
			return $resultado;
		}
		
		//----------------------------------------------------------------------------------------
	    
		public function obtenerPropuesta($id_propuesta){
			global $miBD;
			$query = "	SELECT 	
							
							 	
						FROM 
						WHERE 
					 ";
			$resultado = $miBD->ejecutar($query, array($id_propuesta));
			
			return $resultado;
		}	
		
		//----------------------------------------------------------------------------------------
		public function actualizarPropuesta($datos){
			global $miBD;
			$query = "	UPDATE 
						SET	
							
						WHERE 
					 ";
			$resultado = $miBD->ejecutarSimple($query, array());
			
			if($resultado){ return true; }
			return false;
		}			
		//----------------------------------------------------------------------------------------
		public function borrarPropuesta($id){
			global $miBD;
			$query = "UPDATE  SET debaja=1 WHERE ";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}		
		//----------------------------------------------------------------------------------------
		
    }
	
?>