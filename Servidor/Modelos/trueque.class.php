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
					t.id_trueque,
					t.puntos_a_ofrece,
					t.puntos_a_propone
					
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
				$miBD->ejecutarSimple( $query, array((int)$resultado + 1, $id) );
			}
			
			return (int)$resultado + 1;
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
		public function guardarPuntosProvisorios($trueque, $parte, $puntos){
			global $miBD;
			if($parte=="ofertante"){
				$query = "UPDATE trueque SET puntos_a_ofrece = ? WHERE id_trueque = ?";
			}
			else{
				$query = "UPDATE trueque SET puntos_a_propone = ? WHERE id_trueque = ?";
			}
			$resultado = $miBD->ejecutarSimple($query, array($puntos, $trueque));
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function asignarPuntos( $trueque, $parte, $url_otro, $mi_url ){
			global $miBD;
			$query = "SELECT p.id_usuario, p.prestigio_perfil 
			          FROM perfil p
					  INNER JOIN usuario u ON(u.id_usuario = p.id_usuario)
					  WHERE u.url_usuario = ?
					 ";
			$prestigio1 = $miBD->ejecutar($query, array($url_otro),true);
			$prestigio2 = $miBD->ejecutar($query, array($mi_url),true);
			
			$prestigio_actual_suyo = $prestigio1[0]['prestigio_perfil'];			
			$id_usuario_suyo = $prestigio1[0]['id_usuario'];
			
			$prestigio_actual_mio = $prestigio2[0]['prestigio_perfil'];
			$id_usuario_mio = $prestigio2[0]['id_usuario'];
			
			$query = "SELECT puntos_a_ofrece, puntos_a_propone 
			          FROM trueque 
					  WHERE id_trueque = ?
					 ";
			$puntaje = $miBD->ejecutar($query, array($trueque),true);
			
			if($parte=="ofertante"){
				$nuevos_puntos_suyo = $puntaje[0]['puntos_a_ofrece'];
				$nuevos_puntos_mio = $puntaje[0]['puntos_a_propone'];
			}
			else{
				$nuevos_puntos_suyo = $puntaje[0]['puntos_a_propone'];
				$nuevos_puntos_mio = $puntaje[0]['puntos_a_ofrece'];
			}
			
			$query = "UPDATE perfil
					  SET prestigio_perfil = ?
					  WHERE id_usuario = ?
					 ";
			$prestigio_actual_suyo = $miBD->ejecutarSimple($query, array( (int)$prestigio_actual_suyo + (int)$nuevos_puntos_suyo, $id_usuario_suyo ),true);			
			$prestigio_actual_mio = $miBD->ejecutarSimple($query, array( (int)$prestigio_actual_mio + (int)$nuevos_puntos_mio, $id_usuario_mio ),true);
						
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
			
			//marcar como trocado los productos involucrados (servicio nunca)
			$query = "UPDATE producto 
					  SET fue_trocado = 1
					  WHERE id_producto IN ( 
											  SELECT id_producto_ofrecido as id
											  FROM propuesta p
											  WHERE p.id_propuesta = ?
											 UNION
											  SELECT id_producto as id
											  FROM lista_producto_propuesto
											  WHERE id_propuesta = ?
										   ) 
					  AND es_servicio = 0
			         ";
			$miBD->ejecutarSimple($query, array($id_propuesta, $id_propuesta));
			
			return true;
		}
		
			
    }
?>