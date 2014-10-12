<?php
	// Roberto Diaz Schwab 2012-10-06
	// Modified: 2013-03-03
	
	class CapaDeDatos {
	
		private $proveedor;
		private $parametros;
		private static $_conexion;
		private $afectadas;
		private $cantidad;
		
	 //-----------------------------------------------------------------------------------
		private function __construct($objConexion){
			$claseProveedor = 'Proveedor'.$objConexion->PROVIDER;
			if(!class_exists($claseProveedor)){
				throw new Exception('El proveedor especificado no ha sido implementado.');
			}
			
			$this->proveedor = new $claseProveedor;						
			$this->proveedor->conectar($objConexion);

			if(!$this->proveedor->verificarConectado()){
				throw new Exception('No pudo conectarse a la base de datos configurada.');
			}
			
		}
	 //---------------------------------------------------
		
		public static function crearConexion($objConexion){
			if(self::$_conexion){
				return self::$_conexion;
			}
			else{
				$class = __CLASS__;
				self::$_conexion = new $class($objConexion);
				return self::$_conexion;
			}
		}
	 //-----------------------------------------------------------------------------------
	 //		P R I V A T E
	 //-----------------------------------------------------------------------------------
	
		private function reemplazarparametros($coincidencias){
			$b=current($this->parametros);			
			next($this->parametros); 
			return $b;
		}
		
		private function preparar($sql, $parametros){		
			for($i=0;$i<sizeof($parametros); $i++){
				if(is_bool($parametros[$i])){
					$parametros[$i] = $parametros[$i]? 1:0;
				}
				elseif(is_double($parametros[$i])){
					$parametros[$i] = str_replace(',', '.', $parametros[$i]);
				}	
				elseif(is_numeric($parametros[$i])){						
					//$parametros[$i] = $this->proveedor->escaparParametros($parametros[$i]);
				}
				elseif(is_null($parametros[$i])){
					$parametros[$i] = "NULL";
				}
				else{
					$parametros[$i] = "'".$this->proveedor->escaparParametros($parametros[$i])."'";
				}	
			}
			
			$this->parametros = $parametros;						
			$q = preg_replace_callback('/(\?)/i', array($this,'reemplazarparametros'), $sql);	

			return $q;
		}
		
		private function enviarQuery($q, $parametros){
			$query = $this->preparar($q, $parametros);	
			$result = $this->proveedor->consultar($query);			
			$this->afectadas = $this->proveedor->cantidadFilasAfectadas();
			if(is_object($result)){ $this->cantidad  = $this->proveedor->cantidadFilas($result); }
			
			
			if($this->proveedor->obtenerNroError()){				
				$descError = 'La consulta sql es invalida.';
				$descError .='<br/><br/>'.$query.'<br/><br/>'.$this->proveedor->obtenerError();
				
				throw new Exception($descError);
			}
			
			return $result;
		}
	 //-------------------------------------------------------------------------
	 //    P U B L I C
	 //-------------------------------------------------------------------------
		//devuelve la primer columna de la primera fila
		public function ejecutarSimple($q, $parametros=null){
			$result = $this->enviarQuery($q, $parametros);			
			if(!is_null($result)){
				if(!is_object($result)){
					return $result;
				}
				else{
					$row = $this->proveedor->fetchArray($result);
					return $row[0];
				}
			}			
			return null;
		}
		
		//devuelve array de filas completo
		public function ejecutar($q, $parametros=null){			
			$result = $this->enviarQuery($q, $parametros);			
			if(is_object($result)){
				$arr = array();
				while($row = $this->proveedor->fetchArray($result)){
					$arr[] = $row;
				}
				return $arr;
			}
			return $result;
			
		}
		
		public function cantidadRegistros(){
			return $this->cantidad;
		}
		
		public function obtenerRegistrosAfectados(){
			return $this->afectadas;
		}
		
		public function obtenerUltimoId(){
			return $this->proveedor->obtenerUltimoId();
		}
		
		public function cerrarConexion(){
			$this->proveedor->desconectar();
		}
	 //------------------------------------------------------------------------
	}
?>