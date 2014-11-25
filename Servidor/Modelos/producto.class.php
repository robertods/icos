<?
    
    class Producto{
        private $id_producto;
		 private $id_usuario;
		 
		// GETTERS Y SETTERS --------------------------------------------------------------------
        public function get($dato){ 			
            switch($dato){
            
			   case 'id_producto':  $dato = $this->id_producto; break;
			   case 'id_usuario':  $dato = $this->id_usuario; break;
            }			
            return $dato; 		
        }

        /*public function set($dato,$valor){ 			
            switch($dato){
                case 'id_producto':  $this->id_producto  = $valor; break;
								
            }							
        }*/

        // METODOS ------------------------------------------------------------------------------

        public function buscarProductosPorEtiquetas($etiquetas){			
            global $miBD;
            $query = "SELECT DISTINCT p.id_producto, p.titulo_producto, p.descripcion_producto, p.ubicacion_producto, url_producto
					  FROM producto p
					  INNER JOIN producto_etiqueta x ON(x.id_producto = p.id_producto)
					  INNER JOIN etiqueta e ON(e.id_etiqueta = x.id_etiqueta)
					  WHERE p.debaja=0 AND e.debaja=0 AND x.debaja=0
					  AND e.descripcion_etiqueta REGEXP ?;"; //'etiq2|etiq3'
            $resultado = $miBD->ejecutar($query, array($etiquetas), true);

            return $resultado;            
        }				
		//----------------------------------------------------------------------------------------
		// 		METODOS A B M -Administrador
		//----------------------------------------------------------------------------------------
		public function obtenerProductos(){
			global $miBD;
			$query = "	SELECT 
							 pe.nombre_perfil,
							 url_producto,
							 titulo_producto,
							 es_servicio,
							 descripcion_producto,
							 disponible_producto,
							 id_producto				 
						FROM producto pr
                        LEFT JOIN perfil pe ON(pr.id_usuario = pe.id_usuario)
						WHERE pr.debaja = 0					
					 ";
			$resultado = $miBD->ejecutar($query);
			
			return $resultado;
		}
		
		//----------------------------------------------------------------------------------------
	    
		public function obtenerProducto($id_producto){
			global $miBD;
			$query = "	SELECT 
							
							 url_producto,
							 titulo_producto,
							 es_servicio,
							 descripcion_producto
							 	
						FROM producto 
						WHERE id_producto = ?
					 ";
			$resultado = $miBD->ejecutar($query, array($id_producto));
			
			return $resultado;
		}	
		
		//----------------------------------------------------------------------------------------
		public function crearProducto($datos){
			global $miBD;
			$query="INSERT INTO producto(
						titulo_producto,
						foto_principal,
						descripcion_producto,
						url_producto,
						ubicacion_producto,
						disponible_producto,
						id_categoria,
						es_servicio,
						id_usuario
					)
					VALUES(
						?, ?, ?, ?, PointFromText(?),
						?, ?, ?, ?
					)
				   ";
			
			$resultado = $miBD->ejecutarSimple($query, array(	$datos->titulo_producto,
																$datos->foto_principal,
																$datos->descripcion_producto,
																$datos->url_producto,
																$datos->ubicacion_producto,
																$datos->disponible_producto,
																$datos->id_categoria,
																$datos->es_servicio,
																$datos->id_usuario
															)
			);
			
			$id_producto_nuevo = $miBD->obtenerUltimoId();
			
			$query="INSERT INTO producto_etiqueta(id_producto, id_etiqueta) SELECT ?, id_etiqueta FROM etiqueta WHERE id_etiqueta IN($datos->etiquetas)";
			if($resultado){ $resultado = $miBD->ejecutarSimple($query, array($id_producto_nuevo)); }
						
			if($resultado){ return $id_producto_nuevo; }
			return false;
		}
		//----------------------------------------------------------------------------------------
		public function actualizarProducto($datos){
			global $miBD;
			$query = "	UPDATE producto
						SET	url_producto = ?,
							es_servicio = ?,
							titulo_producto = ?,
							descripcion_producto = ?
							
						WHERE id_producto = ?
					 ";
			$resultado = $miBD->ejecutarSimple($query, array($datos->url_producto,$datos->es_servicio,$datos->titulo_producto, $datos->descripcion_producto,$datos->id_producto));
			
			if($resultado){ return true; }
			return false;
		}			
		//----------------------------------------------------------------------------------------
		public function borrarProducto($id){
			global $miBD;
			$query = "UPDATE producto SET debaja=1 WHERE id_producto=?";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}		
		//----------------------------------------------------------------------------------------
		// 		METODOS A B M - usuario 
		//----------------------------------------------------------------------------------------
		public function obtenerMisProductos($id_usuario){
			global $miBD;
			$query = "	SELECT  
							 url_producto,
							 titulo_producto,
							 es_servicio,
							 descripcion_producto,
							 disponible_producto,
							 id_producto,
							 foto_principal
						FROM producto pr
                        LEFT JOIN perfil pe ON(pr.id_usuario = pe.id_usuario)
						WHERE pr.id_usuario = ? && pr.debaja = 0
					 ";
			$resultado = $miBD->ejecutar($query, array($id_usuario));
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerCantidad($id){
			global $miBD;
			$query = "select count(*) as cantidad from producto where id_usuario= ?";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}	
		
		//----------------------------------------------------------------------------------------
		public function obtenerUrl($nombre){
			global $miBD;
			
			$url_candidata = $this -> limpiarNombre($nombre);	
			
			$repetida = 1;
			$variante = '';
			
			while ($repetida == 1){
				$resultado = $miBD->ejecutarSimple("select count(*) from producto where url_producto like '$url_candidata$variante'");
				
				if ($resultado > 0) {
					$variante = '-'.rand(1,99);
				}
				else{
					$repetida = 0;
				
				}
			}
			return $url_candidata.$variante;
		}
		
		//----------------------------------------------------------------------------------------
		private function limpiarNombre($nombre){
			$caracteres = array (' ', '(', ')', '¿', '?','¡', '!');
			$resultado = str_replace($caracteres, '-', $nombre);
		    return $resultado ;
		}
		//----------------------------------------------------------------------------------------
		
		public function guardarProductoDeseado($datos){
			global $miBD;
			$query = 'insert into producto_deseado (es_servicio, id_categoria, id_producto ) values (?,?,?)';
			$resultado = $miBD->ejecutarSimple($query, array($datos->es_servicio, $datos->id_categoria, $datos->id_producto));
			
			$id_producto_nuevo = $miBD->obtenerUltimoId();
			
			$query="INSERT INTO deseado_etiqueta(id_producto, id_etiqueta) SELECT ?, id_etiqueta FROM etiqueta WHERE id_etiqueta IN($datos->etiquetas)";
			if($resultado){ $resultado = $miBD->ejecutarSimple($query, array($id_producto_nuevo)); }
						
			if($resultado){ return $id_producto_nuevo; }
			return false;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerPaginaProducto($direccion){
			global $miBD;
			$query = "	SELECT  
							 url_producto,
							 titulo_producto,
							 es_servicio,
							 descripcion_producto, 
							 id_producto,
							 foto_principal, 
							 pe.nombre_perfil,
							 pe.prestigio_perfil,
							 pr.id_usuario,
							 u.url_usuario
						FROM producto pr
                        INNER JOIN perfil pe ON(pr.id_usuario = pe.id_usuario)
						INNER JOIN usuario u ON(pr.id_usuario = u.id_usuario)
						WHERE pr.url_producto = ? 
					 ";
			$resultado = $miBD->ejecutar($query, array($direccion));
			
			return $resultado;
		
		}
		
		//----------------------------------------------------------------------------------------
		public function obtenerPropuestas($id_producto){
			global $miBD;
			$query = "SELECT P.id_propuesta, U.url_usuario 
			          FROM propuesta P
					  INNER JOIN usuario U ON (U.id_usuario = P.id_usuario_propone)
					  WHERE id_producto_ofrecido = ? 
					  AND U.debaja = 0
					  AND P.debaja = 0
					 ";
			$resultado = $miBD->ejecutar($query, array($id_producto), true);
			
			return $resultado;	 
		}
		//----------------------------------------------------------------------------------------
		public function obtenerProductosPropuesta($id_propuesta){
			global $miBD;
			$query = "SELECT P.url_producto, P.foto_principal, P.titulo_producto 
			          FROM lista_producto_propuesto L
					  INNER JOIN producto P ON (P.id_producto = L.id_producto)
					  WHERE L.id_producto = ?
				     ";
			$resultado = $miBD->ejecutar($query, array($id_propuesta), true);
			
			return $resultado;		 
		}
		//----------------------------------------------------------------------------------------
        /* public function nubeEtiquetas($minFontSize, $maxFontSize){
		 global $miBD;
		$query = "SELECT descripcion_etiqueta as tag, count(descripcion_etiqueta) as cant FROM etiqueta GROUP BY descripcion_etiqueta";			 
					
				
		$respuesta= $miBD->ejecutar($query, );
			
		return $respuesta;
		
		}*/
			 
		public function nubeEtiquetas(){
		 global $miBD;
			$query = "select  url_producto
						from producto 
						group by  url_producto ORDER BY RAND() 
						limit 50
					";
			
			$respuesta = $miBD->ejecutar($query);
			
			
		
			return $respuesta;
		}
		
			

			
			 
    }
?>