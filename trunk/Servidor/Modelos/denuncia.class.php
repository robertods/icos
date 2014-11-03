<?php
	class Denuncia{
		private $id_tipo_denuncia;
		

		// GETTERS Y SETTERS --------------------------------------------------------------------
        public function get($dato){ 			
            switch($dato){
                case 'id_tipo_denuncia':  $dato = $this->id_tipo_denuncia; break;
			
				
            }			
            return $dato; 		
        }
		
		// metodos--------------------------------------------------------------------
			public function obtenerTiposDenuncia(){
			global $miBD;
			$query = "	SELECT 
							nombre_tipo_denuncia,
							id_tipo_denuncia
						FROM tipo_denuncia
						
						
					 ";
			$resultado = $miBD->ejecutar($query);
			
			return $resultado;
		}	
		
		public function guardarDenuncia($tipo, $detalle, $demandado, $demandante, $producto, $propuesta){
		global $miBD;
		$query = "
				INSERT INTO	 denuncia (tipo_denuncia, detalle_denuncia, id_usuario_demandado, id_usuario_demandante, id_producto, id_propuesta)
				values (?,?,?,?,?,?)
				";
		$resultado = $miBD->ejecutarSimple($query, array( $tipo, $detalle, $demandado, $demandante, $producto, $propuesta ));
			
		return $resultado;
		
		}
		
		
		
		
	}
?>