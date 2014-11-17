 <?
 class Etiqueta{
        private $id_etiqueta;
		
		// GETTERS Y SETTERS --------------------------------------------------------------------
        public function get($dato){ 			
            switch($dato){
                case 'id_etiqueta':  $dato = $this->id_etiqueta; break;
				
            }			
            return $dato; 		
        }

		//----------------------------------------------------------------------------------------
		// 		METODOS A B M
		//----------------------------------------------------------------------------------------
		public function obtenerEtiquetas(){
			global $miBD;
			$query = "	SELECT 	
							 descripcion_etiqueta,
							 id_etiqueta				 
						FROM etiqueta e
                     
						WHERE e.debaja = 0					
					 ";
			$resultado = $miBD->ejecutar($query);
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerEtiquetasSolas(){
			global $miBD;
			$query = "	SELECT 	
							 descripcion_etiqueta				 
						FROM etiqueta e                     
						WHERE e.debaja = 0					
					 ";
			$resultado = $miBD->ejecutar($query, null, true);
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------	    
		public function obtenerEtiquetaPorDescripcion($desc_etiqueta){
			global $miBD;
			$query = "	SELECT id_etiqueta 
						FROM etiqueta
						WHERE descripcion_etiqueta like ?
					 ";
			$resultado = $miBD->ejecutar($query, array($desc_etiqueta));
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------	    
		public function obtenerEtiqueta($id_etiqueta){
			global $miBD;
			$query = "	SELECT 	
							 descripcion_etiqueta
							 	
						FROM etiqueta
						WHERE id_etiqueta = ?
					 ";
			$resultado = $miBD->ejecutar($query, array($id_etiqueta));
			
			return $resultado;
		}			
		//----------------------------------------------------------------------------------------
		public function guardarEtiqueta($desc_etiqueta){
			global $miBD;
			$query = "INSERT INTO etiqueta (descripcion_etiqueta) VALUES (?)";
			$resultado = $miBD->ejecutarSimple($query, array($desc_etiqueta));
					
			if($resultado){ return $miBD->obtenerUltimoId(); } //devuelvo el id
			return false;
		}
		//----------------------------------------------------------------------------------------
		public function actualizarEtiqueta($datos){
			global $miBD;
			$query = "	UPDATE etiqueta
						SET	descripcion_etiqueta = ?
							
						WHERE id_etiqueta = ?
					 ";
			$resultado = $miBD->ejecutarSimple($query, array($datos->descripcion_etiqueta,$datos->id_etiqueta));
			
			if($resultado){ return true; }
			return false;
		}			
		//----------------------------------------------------------------------------------------
		public function borrarEtiqueta($id){
			global $miBD;
			$query = "UPDATE etiqueta SET debaja=1 WHERE id_etiqueta=?";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}		
		//----------------------------------------------------------------------------------------
		
		
		
		
    }
	
?>