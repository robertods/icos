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
            $resultado = $miBD->ejecutar($query, array($etiquetas));

            return $resultado;            
        }				
		//----------------------------------------------------------------------------------------
		// 		METODOS A B M
		//----------------------------------------------------------------------------------------
		
		//----------------------------------------------------------------------------------------
		
    }
?>