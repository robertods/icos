<?php
	class Chat{
		public function obtenerChat($id_usuario){
			global $miBD;
			$query = "select * from chat where (chat.to = ? AND recd = 0) order by id ASC";
			return $miBD->ejecutar($query, array($id_usuario));
		}
		public function actualizaRecibido($id_usuario){
			global $miBD;
			$query = "update chat set recd = 1 where chat.to = ? and recd = 0";
			return $miBD->ejecutarSimple($query, array($id_usuario));
		}
		public function enviarChat($from, $to, $menssage){
			global $miBD;
			$query = "insert into chat (chat.from,chat.to,message,sent) values (?, ?,?,NOW())";
			return $miBD->ejecutarSimple($query, array($from, $to, $menssage));
		}
	}
?>