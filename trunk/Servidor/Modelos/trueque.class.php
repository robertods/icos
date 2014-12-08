<?
    class Trueque{
       private $id_trueque;
		 
		// GETTERS Y SETTERS --------------------------------------------------------------------
        public function get($dato){ 			
            switch($dato){
            
			   case 'id_trueque':  $dato = $this->id_trueque; break;
			 
            }			
            return $dato; 		
        }
     

        // METODOS ------------------------------------------------------------------------------
		public function obtenerMisTrueques($id){
		global $miBD;
		$query = "	SELECT  
			        pro.url_producto,
					t.fecha_acuerdo_trueque,
					t.fecha_finalizado_trueque,
					t.estado_trueque,
					u.url_usuario as ofrece, 
					u2.url_usuario as propone,
					p.id_propuesta,
					t.id_trueque
						
					FROM trueque t
					inner join propuesta p on (t.id_propuesta = p.id_propuesta) 
					inner join producto pro on (p.id_producto_ofrecido = pro.id_producto) 
					LEFT JOIN usuario u ON(t.id_usuario_ofrece = u.id_usuario) 
					LEFT JOIN usuario u2 ON(t.id_usuario_propone = u2.id_usuario) 
					
					where t.id_usuario_ofrece or t.id_usuario_propone=? 
				";
				
		$resultado = $miBD->ejecutar($query, array($id));
		return $resultado;	
		
		}
		
		//----------------------------------------------------------------------------------------
		public function recibio($id){
			global $miBD;
			$query = "SELECT estado_trueque FROM trueque WHERE id_trueque=?";
			$resultado = $miBD->ejecutarSimple($query, array($id),true);
			
			if(isset($resultado)){
				$query = "UPDATE trueque SET estado_trueque= ?, fecha_finalizado_trueque = now() WHERE id_trueque=?";
				$resultado = $miBD->ejecutarSimple( $query, array((int)$resultado + 1, $id) );
			}
			
			return $resultado;
		}		
		
		//----------------------------------------------------------------------------------------
		public function obtenerPartes($id){
			global $miBD;
			$query = "SELECT u.url_usuario ofertante,  u2.url_usuario demandante
			          FROM trueque t
					  INNER JOIN usuario u ON(u.id_usuario = t.id_usuario_ofrece)
					  INNER JOIN usuario u2 ON(u2.id_usuario = t.id_usuario_propone)
					  WHERE t.id_trueque = ? ";
			$resultado = $miBD->ejecutar($query, array($id), true);
			
			return $resultado;
		}
		
		//----------------------------------------------------------------------------------------
		public function obtenerCantidad($id){
			global $miBD;
			$query = "select count(*) as cantidad from trueque where id_usuario_ofrece= ? or id_usuario_propone=?";
			$resultado = $miBD->ejecutarSimple($query, array($id, $id));
			
			return $resultado;
		}	
		//----------------------------------------------------------------------------------------
		public function obtenerCantidadFinalizados($id){
			global $miBD;
			$query = "select count(*) as cantidad from trueque where (id_usuario_ofrece= ? or id_usuario_propone=?) and estado_trueque = 2 ";
			$resultado = $miBD->ejecutarSimple($query, array($id, $id));
			
			return $resultado;
		}	
		//----------------------------------------------------------------------------------------
		public function aceptarTrueque($id_propuesta){
			global $miBD;
			$query = "INSERT INTO trueque ( estado_trueque, fecha_finalizado_trueque, fecha_acuerdo_trueque, id_usuario_propone, id_usuario_ofrece, id_propuesta )
					  SELECT 0, NULL, NOW(), p.id_usuario_propone, x.id_usuario, p.id_propuesta
					  FROM propuesta p
					  INNER JOIN producto x ON(x.id_producto = p.id_producto_ofrecido)
					  WHERE p.id_propuesta = ?
			         ";
			$miBD->ejecutarSimple($query, array($id_propuesta));
			
			//falta negar el uso de los productos involucrados
			/*$query = "UPDATE producto 
					  SET debaja = 0
					  WHERE id_producto = (SELECT id_producto)
			         ";
			$miBD->ejecutarSimple($query, array($id, $id));*/
			
			return true;
		}
		
			
    }
?>