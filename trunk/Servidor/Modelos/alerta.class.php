<?php
	class Alerta{
		public function obtenerAlertas($id_usuario){
			global $miBD;
			$query = "SELECT p.url_producto, a.mensaje_alerta, p.foto_principal 
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
		public function eliminarAlertaDeEsteProducto($producto, $usuario){
			global $miBD;
			$query = "UPDATE alerta SET visto=1 WHERE debaja=0 AND visto=0 AND id_usuario like ? AND id_producto = ?";
			return $miBD->ejecutarSimple($query, array($usuario, $producto));
		}
		//-----------------------------------------------------------------------
		//generar alertas
		//-----------------------------------------------------------------------
		public function enviarAlertasParaInteresados($id_nuevo_producto, $categoria_producto, $id_usuario, $url_usuario){
			global $miBD;
			// busco si mi producto nuevo es deseado por alguien...
			$query =" Select distinct 
						p.id_producto, 
						p.id_usuario,
						u.id_usuario
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
						and u.id_usuario <> ?
						and u.debaja = 0
						and p.debaja = 0
						";
			$resultado = $miBD->ejecutar($query, array($id_nuevo_producto, $categoria_producto, $id_usuario ), true);
			$cantidad = count ($resultado);
			// ...y les aviso a cada uno de ellos.
			if ($cantidad  > 0){
				for($i=0; $i<$cantidad; $i++){
					$query = "Insert into alerta (mensaje_alerta, id_usuario, id_producto) Values(?,?,?)";								
					$mensaje = $url_usuario." posee un producto que quizás podría interesarte...";
					$miBD->ejecutar($query, array( $mensaje, $resultado[$i]['id_usuario'], $id_nuevo_producto )); //promuevo mi producto al usuario interesado	
				}
			}
		}
		
		//-----------------------------------------------------------------------
		public function enviarmeAlertasDeMisIntereses($id_nuevo_producto, $categoria_producto_deseado, $id_usuario){
			global $miBD;
			// busco si mi deseo nuevo es parecido a productos ofrecidos por otros usuarios...		
			$query =" Select distinct 
						p.id_producto, 
						p.id_usuario,
						u.url_usuario
						From producto_etiqueta pe						
						Inner join producto p on (p.id_producto = pe.id_producto)
						Inner join usuario u on (u.id_usuario = p.id_usuario)
						Where pe.id_etiqueta in(
												 Select id_etiqueta
												 From deseado_etiqueta de
												 inner join producto_deseado pd on (pd.id_producto_deseado = de.id_producto) 
												 Where pd.id_producto = ?						 
						)
						And p.id_categoria = ? 
						and u.id_usuario <> ?
						and u.debaja = 0
						and p.debaja = 0
						";
			$resultado = $miBD->ejecutar($query, array($id_nuevo_producto, $categoria_producto_deseado, $id_usuario ), true);
			$cantidad = count ($resultado);
			// ...que me avise de esos productos.	
			if ($cantidad  > 0){
				for($i=0; $i<$cantidad; $i++){
					$query = "Insert into alerta (mensaje_alerta, id_usuario, id_producto) Values(?,?,?)";
					$mensaje = $resultado[$i]['url_usuario']." posee un producto que quizás podría interesarte...";
					$miBD->ejecutar($query, array( $mensaje, $id_usuario, $resultado[$i]['id_producto'] )); //avisarme a mi de productos interesantes	
				}
			}		
		}
	}
?>