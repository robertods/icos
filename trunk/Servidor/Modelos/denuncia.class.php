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
		
		//---------------------------------------------------------------------------------
		public function guardarDenuncia($tipo, $detalle, $demandado, $demandante, $producto, $propuesta){
		global $miBD;
		$query = "
				INSERT INTO	 denuncia (tipo_denuncia, detalle_denuncia, id_usuario_demandado, id_usuario_demandante, id_producto, id_propuesta)
				values (?,?,?,?,?,?)
				";
		$resultado = $miBD->ejecutarSimple($query, array( $tipo, $detalle, $demandado, $demandante, $producto, $propuesta ));
			
		return $resultado;
		
		}
		
		//---------------------------------------------------------------------------------
		public function obtenerTodasDenuncias(){
			global $miBD;
			$query = "	SELECT 
							d.id_denuncia,
							d.fecha_denuncia,
							td.nombre_tipo_denuncia,
							p.url_producto,
							ppt.id_lista_producto_propuesto, 
							u.url_usuario demandado,
							d.detalle_denuncia,
							u2.url_usuario demandante
						FROM denuncia d
						left join tipo_denuncia td ON(d.tipo_denuncia = td.id_tipo_denuncia)
						left join producto p ON(d.id_producto = p.id_producto)
						left join propuesta ppt ON (d.id_propuesta = ppt.id_lista_producto_propuesto)
						left join usuario u ON(d.id_usuario_demandado = u.id_usuario)
						left join usuario u2 ON(d.id_usuario_demandante = u2.id_usuario)
						order by d.fecha_denuncia DESC
						
					 ";
			$resultado = $miBD->ejecutar($query);
			
			return $resultado;
		}	
		
		
	}
?>