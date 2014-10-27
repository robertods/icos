<?
    
    class Producto{
        private $id_producto;
		
		// GETTERS Y SETTERS --------------------------------------------------------------------
        public function get($dato){ 			
            switch($dato){
                case 'id_producto':  $dato = $this->id_producto; break;
				
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
		// 		METODOS A B M
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
		
    }
?>