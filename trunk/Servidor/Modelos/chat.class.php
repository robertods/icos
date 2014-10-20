<?php
	class Chat{
		public function obtenerChat($id_usuario){
			global $miBD;
			$query = "select * from chat where (chat.toUser = ? AND recd = 0) order by id ASC";
			return $miBD->ejecutar($query, array($id_usuario));
		}
		public function actualizaRecibido($id_usuario){
			global $miBD;
			$query = "update chat set recd = 1 where chat.toUser = ? and recd = 0";
			return $miBD->ejecutarSimple($query, array($id_usuario));
		}
		public function enviarChat($from, $to, $menssage){
			global $miBD;
			$query = "insert into chat (chat.fromUser,chat.toUser,message,sent) values (?, ?,?,NOW())";
			return $miBD->ejecutarSimple($query, array($from, $to, $menssage));
		}
		//-----------------------------------------------------------------------
		public function obtenerCantidadMensajesSinLeer($usuario_destino){
			global $miBD;
			$query = "SELECT count(*) FROM chat WHERE chat.recd=0 AND chat.toUser like ?";
			return $miBD->ejecutarSimple($query, array($usuario_destino));
		}
	}
?>