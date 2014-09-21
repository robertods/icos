<?php
	abstract class BaseDeDatos
	{		
		protected $recurso;
		public abstract function conectar($obj);
		public abstract function obtenerNroError();
		public abstract function obtenerError();
		public abstract function consultar($query);
		public abstract function fetchArray($recurso);
		public abstract function verificarConectado();
		public abstract function escaparParametros($var);
		public abstract function cantidadFilas($result);
		public abstract function cantidadFilasAfectadas();
		public abstract function desconectar();
		
	}
?>