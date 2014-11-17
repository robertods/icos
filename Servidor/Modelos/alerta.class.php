<?php
	class Alerta{
		public function obtenerAlertas($id_usuario){
			global $miBD;
			$query = "SELECT p.url_producto, a.mensaje_alerta 
			          FROM alerta a
					  INNER JOIN producto p ON(a.id_producto = p.id_producto)
			          WHERE a.debaja=0 AND p.debaja=0 AND a.visto=0 AND a.id_usuario like ?";
			return $miBD->ejecutar($query, array($id_usuario));
		}
		/*public function actualizaRecibido($id_usuario){
			global $miBD;
			$query = "update chat set recd = 1 where chat.toUser = ? and recd = 0";
			return $miBD->ejecutarSimple($query, array($id_usuario));
		}
		public function enviarAlerta($from, $to, $menssage){
			global $miBD;
			$query = "insert into chat (chat.fromUser,chat.toUser,message,sent) values (?, ?,?,NOW())";
			return $miBD->ejecutarSimple($query, array($from, $to, $menssage));
		}*/
		//-----------------------------------------------------------------------
		public function obtenerCantidadAlertasSinVer($usuario_destino){
			global $miBD;
			$query = "SELECT count(*) FROM alerta WHERE debaja=0 AND visto=0 AND id_usuario like ?";
			return $miBD->ejecutarSimple($query, array($usuario_destino));
		}
		//-----------------------------------------------------------------------
		//generar alertas
		//-----------------------------------------------------------------------
		public function enviarAlertasParaInteresados($id_nuevo_producto, $categoria_producto, $usuario){
			global $miBD;
			$query =" Select distinct 
						p.id_producto, 
						p.id_usuario,
						u.url_usuario
						From deseado_etiqueta de
						Inner join producto_deseado pd on (pd.id_producto_deseado = de.id_producto)
						inner join producto p on (p.id_producto = pd.id_producto)
						Inner join usuario u on (u.id_usuario = p.id_usuario)
						Where de.id_etiqueta in(
												 Select id_etiqueta
												 From producto_etiqueta
												 Where id_producto = ?						 
						)
						And pd.id_categoria = ? 
						and u.id_usuario <> ?";
			$resultado = $miBD->ejecutar($query, array($id_nuevo_producto, $categoria_producto, $usuario ), true);
			$cantidad = count ($resultado);
			if ($cantidad  > 0){
				for($i=0; $i<$cantidad; $i++){
					$query = "Insert into alerta (mensaje_alerta,id_usuario, id_producto) Values(?,?,?)";
								
					$mensaje = $resultado[$i]['url_usuario']." desea un producto que quizás podrías tener...".$resultado[$i]['id_producto'] ;
					$miBD ->ejecutar($query, array( $mensaje, $usuario, $resultado[$i]['id_producto'] ));			
				}
			}
		}
		
		//-----------------------------------------------------------------------
		public function enviarmeAlertasDeMisIntereses($id_nuevo_producto){
		
		
		}
	}
?>