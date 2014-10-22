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
						ppt.id_propuesta,
						p.url_producto, 
						p.titulo_producto, 
						u1.url_usuario usuario_ofrece, 
						u2.url_usuario usuario_propone,
						NULL lista_propuestos       
						FROM propuesta ppt
						INNER JOIN producto p ON(p.id_producto = ppt.id_producto_ofrecido)
						INNER JOIN usuario u1 ON(u1.id_usuario = p.id_usuario)
						INNER JOIN usuario u2 ON(u2.id_usuario = ppt.id_usuario_propone)
						WHERE ppt.debaja = 0
						AND p.debaja = 0
						ORDER BY ppt.id_usuario_propone				
					 ";
			$resultado1 = $miBD->ejecutar($query);
			
			$query = "	SELECT 
						p.titulo
						FROM lista_producto_propuesto lpp
						INNER JOIN producto p ON(p.id_producto = lpp.id_producto_propuesto)
						WHERE lpp.debaja = 0
						AND p.debaja = 0
						AND id_lista_producto_propuesto = ?		
					 ";
			$resultado2 = $miBD->ejecutar($query);
			
			
			
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