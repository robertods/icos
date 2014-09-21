<?php
	class Cookie{
				
		// METODOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		
				
		public static function actualizarCookie($id_usuario, $cookie, $valor, $vencimiento){
			global $miBD;			
			$resultado = $miBD->ejecutarSimple("UPDATE usuario SET cookie_usuario=? , vence_cookie=DATE_ADD(now(),INTERVAL ? DAY) WHERE id_usuario=?",array($valor,$vencimiento,$id_usuario));
			if($resultado){
				setCookie($cookie, $valor, time()+($vencimiento*24*60*60), '/');
				return true;
			}
			return false;
		}
		//----------------------------------------------------------------------------------------
		public static function borrarCookie($cookie, $valor, $enBase=1){
			
			if($enBase){
				global $miBD;
				$resultado = $miBD->ejecutarSimple("UPDATE usuario SET cookie_usuario='', vence_cookie=DATE_SUB(now(),INTERVAL ? DAY) WHERE cookie_usuario=?",array(365,$valor));				
			}	
			else{
				$resultado = 1;
			}

			if($resultado){
				if(isset($_COOKIE[$cookie])){
					setCookie($cookie, 'deleted', time()-(365*24*60*60), '/');
				}
				return true;
			}				
			return false;
		}
		//----------------------------------------------------------------------------------------
		public static function prepararValor($cadena){
			global $saltCookie;
			return sha1($saltCookie.md5($cadena.date("Y-d-m h:i:s")));
		}
		
	}
	
?>