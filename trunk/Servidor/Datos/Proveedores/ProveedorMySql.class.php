<?php	
	importar("Servidor/Datos/BaseDeDatos.class.php");

	class ProveedorMySql extends BaseDeDatos{
	
		public function conectar($obj){			
			$this->recurso = @new mysqli($obj->HOST, $obj->DBUSER, $obj->DBPASS, $obj->DBNAME, $obj->PORT);			
			if ($this->recurso->connect_error) {
				$this->recurso = null;
			}
			return  $this->recurso;
		}
		
		public function obtenerNroError(){
			return mysqli_errno($this->recurso);			
		}
		
		public function obtenerError(){
			return mysqli_error($this->recurso);
		}
		
		public function consultar($query){
			return mysqli_query($this->recurso,$query);
		}
		
		public function fetchArray($result, $asociativo){
			if($asociativo){ return mysqli_fetch_array($result, MYSQLI_ASSOC); }
			return mysqli_fetch_array($result);			
		}
		
		public function verificarConectado(){
			if($this->recurso){
				return 1;
			}
			return 0;
		}
		
		public function escaparParametros($var){
			return mysqli_real_escape_string($this->recurso,$var);
		}
		
		public function cantidadFilas($result){
			return mysqli_num_rows($result);
		}
		
		public function cantidadFilasAfectadas(){
			return mysqli_affected_rows($this->recurso);
		}
						
		public function obtenerUltimoId(){
			return $this->recurso->insert_id;
		}
		
		public function desconectar(){
			return $this->recurso->close();
		}
		
	}
?>