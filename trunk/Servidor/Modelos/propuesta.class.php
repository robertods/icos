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
						u2.url_usuario usuario_propone
						/*id_lista_producto_propuesto lista_propuestos*/       
						FROM propuesta ppt
						INNER JOIN producto p ON(p.id_producto = ppt.id_producto_ofrecido)
						INNER JOIN usuario u1 ON(u1.id_usuario = p.id_usuario)
						INNER JOIN usuario u2 ON(u2.id_usuario = ppt.id_usuario_propone)
						WHERE ppt.debaja = 0
						AND p.debaja = 0
						AND p.fue_trocado = 0 
						ORDER BY ppt.id_usuario_propone				
					 ";
			$resultado = $miBD->ejecutar($query, null, true);
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerListaPropuesta($id_propuesta){
			global $miBD;
			$query = "	SELECT p.titulo_producto
						FROM lista_producto_propuesto lpp
						INNER JOIN producto p ON (p.id_producto = lpp.id_producto)
						WHERE lpp.id_propuesta = ?			
					 ";
			$resultado = $miBD->ejecutar($query, array($id_propuesta), true);
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerProductosPropuesta($id_propuesta){
			global $miBD;
			$query = "	SELECT lpp.id_producto
						FROM lista_producto_propuesto lpp
						INNER JOIN producto p ON (p.id_producto = lpp.id_producto AND p.debaja=0 AND p.fue_trocado=0)
						WHERE lpp.id_propuesta = ? 							
					 ";
			$resultado = $miBD->ejecutar($query, array($id_propuesta), true);
			
			return $resultado;
		}
		
		//----------------------------------------------------------------------------------------
		public function borrarPropuesta($id){
			global $miBD;
			$query = "UPDATE propuesta SET debaja=1 WHERE id_propuesta = ?";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}		
		//----------------------------------------------------------------------------------------
		public function obtenerPropuestasRecibidas($id){
			global $miBD;
			$query = "	SELECT 
						ppt.id_producto_ofrecido,     
						u2.url_usuario id_usuario_propone,
						ppt.id_propuesta
						FROM propuesta ppt
						INNER JOIN producto p ON(p.id_producto = ppt.id_producto_ofrecido AND p.debaja=0 AND p.fue_trocado=0)
						INNER JOIN usuario u2 ON(u2.id_usuario = ppt.id_usuario_propone)
						WHERE ppt.id_producto_ofrecido in (
								select id_producto from producto where id_usuario = ?
								)	
						&& ppt.debaja=0	
					 ";
			$resultado = $miBD->ejecutar($query, array($id));
			
			return $resultado;
		}
		
		//----------------------------------------------------------------------------------------
		public function obtenerPropuestasEnviadas($id){
			global $miBD;
			$query = "	SELECT 
						ppt.id_producto_ofrecido,     
						u1.url_usuario usuario_ofrece, 
						ppt.id_propuesta
						FROM propuesta ppt
						INNER JOIN producto p ON(p.id_producto = ppt.id_producto_ofrecido AND p.debaja=0)
						INNER JOIN usuario u1 ON(u1.id_usuario = p.id_usuario)
						WHERE ppt.id_usuario_propone = ? && ppt.debaja=0				
					 ";
			$resultado = $miBD->ejecutar($query, array($id));
			
			return $resultado;
		}
		
		//----------------------------------------------------------------------------------------
		public function obtenerCantidadRealizadas($id){
			global $miBD;
			$query = "select count(*) as cantidad from propuesta where id_usuario_propone=?";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}	
		//----------------------------------------------------------------------------------------
		public function obtenerCantidadRecibidas($id){
			global $miBD;
			$query = "select count(*) as cantidad from propuesta where id_producto_ofrecido in (
						select id_producto from producto where id_usuario = ?	
						)";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}	
		
		//----------------------------------------------------------------------------------------
		public function aceptarPropuesta($id){
			global $miBD;
		
		}
		//----------------------------------------------------------------------------------------
		public function guardarPropuesta($id_producto, $id_usuario, $id_productos){
			global $miBD;
			$query = "INSERT INTO propuesta(id_producto_ofrecido, id_usuario_propone) VALUES(?,?)";
			$resultado = $miBD->ejecutarSimple($query, array($id_producto, $id_usuario));
			
			if($resultado){
				$id_nueva_propuesta = $miBD->obtenerUltimoId();
				
				$cantidad = count($id_productos);
				for($i=0;$i<$cantidad;$i++){
					$query = "INSERT INTO lista_producto_propuesto(id_propuesta, id_producto) VALUES(?,?)";
					$resultado = $miBD->ejecutarSimple($query, array( $id_nueva_propuesta, $id_productos[$i] ));
				}
			}
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function editarListaPropuesta($id_producto, $id_usuario, $id_productos){
			global $miBD;
			//obtengo la propuesta			
			$query = "SELECT id_propuesta FROM propuesta WHERE id_producto_ofrecido = ? AND id_usuario_propone = ? AND debaja = 0 ";
			$id_nueva_propuesta = $miBD->ejecutarSimple($query, array($id_producto, $id_usuario));
			
			if($id_nueva_propuesta){
				//borro los productos elegidos anteriormente
				$query = "DELETE FROM lista_producto_propuesto WHERE id_propuesta = ?";
				$miBD->ejecutarSimple($query, array($id_nueva_propuesta));
			
				//agrego los nuevos productos elegidos										
				$cantidad = count($id_productos);
				for($i=0;$i<$cantidad;$i++){
					$query = "INSERT INTO lista_producto_propuesto(id_propuesta, id_producto) VALUES(?,?)";
					$resultado = $miBD->ejecutarSimple($query, array( $id_nueva_propuesta, $id_productos[$i] ));
				}
			}
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function eliminarPropuesta($id_propuesta){
			global $miBD;
			$query = "DELETE FROM lista_producto_propuesto WHERE id_propuesta = ?";
			$miBD->ejecutarSimple($query, array($id_propuesta));
			
			$query = "UPDATE propuesta SET debaja = 1 WHERE id_propuesta = ?";
			$miBD->ejecutarSimple($query, array($id_propuesta));			
		}
		//----------------------------------------------------------------------------------------
    }
	
?>