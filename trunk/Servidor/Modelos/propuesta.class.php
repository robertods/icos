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
						id_lista_producto_propuesto lista_propuestos       
						FROM propuesta ppt
						INNER JOIN producto p ON(p.id_producto = ppt.id_producto_ofrecido)
						INNER JOIN usuario u1 ON(u1.id_usuario = p.id_usuario)
						INNER JOIN usuario u2 ON(u2.id_usuario = ppt.id_usuario_propone)
						WHERE ppt.debaja = 0
						AND p.debaja = 0
						ORDER BY ppt.id_usuario_propone				
					 ";
			$resultado = $miBD->ejecutar($query, null, true);
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerListaPropuesta($id_lista){
			global $miBD;
			$query = "	SELECT lpp.id_lista_producto_propuesto lista, p.titulo_producto
						FROM lista_producto_propuesto lpp
						INNER JOIN producto p ON (p.id_producto = lpp.id_producto)
						WHERE lpp.id_lista_producto_propuesto = ?			
					 ";
			$resultado = $miBD->ejecutar($query, array($id_lista), true);
			
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
						ppt.id_lista_producto_propuesto lista_propuestos,     
						u2.url_usuario id_usuario_propone,
						ppt.id_propuesta
						FROM propuesta ppt
						INNER JOIN producto p ON(p.id_producto = ppt.id_producto_ofrecido)
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
						ppt.id_lista_producto_propuesto lista_propuestos,     
						u1.url_usuario usuario_ofrece, 
						ppt.id_propuesta
						FROM propuesta ppt
						INNER JOIN producto p ON(p.id_producto = ppt.id_producto_ofrecido)
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
			
			/*$query = "UPDATE propuesta SET debaja=1 WHERE id_propuesta = ?";
			$resultado1 = $miBD->ejecutarSimple($query, array($id));
			*/
			
	     	$resultado2 = $miBD->ejecutarSimple("INSERT INTO trueque (
													t.fecha_acuerdo_trueque,
													t.fecha_finalizado_trueque) 
												
												VALUES (?,?) ",array($datos[0][0], $datos[0][1]));
			
			if($resultado1 && $resultado2){ return true; }
			return false;
			
			
			
		}		
		
			
		
    }
	
?>