<?
    
    class Usuario{
        private $id_usuario;

        public function get($dato){ 			
            switch($dato){
                case 'id_usuario': $dato = $this->id_usuario; break;

            }			
            return $dato; 		
        }

        public function set($dato,$valor){ 			
            switch($dato){
                case 'id_usuario': $this->id_usuario = $valor; break;
            }							
        }

        // METODOS ------------------------------------------------------------------------------

        public function loguearse($email, $clave){			
            global $miBD;
            $query = "SELECT id_usuario FROM usuario WHERE email_usuario=? AND clave_usuario=? AND debaja='N'";
            $resultado = $miBD->ejecutar($query, array($email,md5($clave)));

            if($resultado){
                $this->id_usuario = $resultado[0]["id_usuario"];
                return true;
            }
            return false;
        }
		//----------------------------------------------------------------------------------------
		public function autoLogin($cookie){			
			global $miBD;
			$query = "SELECT id_usuario FROM usuario WHERE cookie_usuario=? AND vence_cookie>now() AND debaja=0";
			$resultado = $miBD->ejecutar($query, array($cookie));
	
			if($resultado){
				$this->id_usuario = $resultado[0]["id_usuario"];
				return true;
			}
			return false;			
		}
		//----------------------------------------------------------------------------------------
		public function cerrarSesion(){				
			Cookie::borrarCookie(session_name(), '', 0);
			Cookie::borrarCookie('icos_login', $_COOKIE['icos_login']);
			unset($_SESSION['usuario_activo']);	
			session_destroy();
			return true;
		}		
		//----------------------------------------------------------------------------------------
		public function comprobarExistenciaNombre($nombre_usuario){
			global $miBD;
			$resultado = $miBD->ejecutarSimple("SELECT 1 FROM usuario WHERE id_usuario=?",array($nombre_usuario));			
			$resultado2 = $miBD->ejecutarSimple("SELECT 1 FROM usuario_tmp WHERE id_usuario=?",array($nombre_usuario));			
				
			if($resultado || $resultado2){				
				return true;
			}
			else{
				return false;
			}
		}
		//----------------------------------------------------------------------------------------
		public function comprobarExistenciaEmail($email_usuario){			
			global $miBD;
			$resultado = $miBD->ejecutarSimple("SELECT 1 FROM usuario WHERE email_usuario=?",array($email_usuario));
			$resultado2 = $miBD->ejecutarSimple("SELECT 1 FROM usuario_tmp WHERE email_usuario=?",array($email_usuario));
			
			if($resultado || $resultado2){				
				return true;
			}
			else{
				return false;
			}
		}
		//----------------------------------------------------------------------------------------
		public function registrar($nombre, $clave, $email, $codigo_autorizacion){
			global $miBD;
			$query = "INSERT INTO usuario_tmp (id_usuario, nombre_usuario, clave_usuario, email_usuario, autorizacion) VALUES (?,?,?,?,?) ";
			$resultado = $miBD->ejecutarSimple($query, array($nombre, strtolower($nombre), md5($clave), $email, $codigo_autorizacion));
					
			if($resultado){
				return $resultado;
			}	
			return false;
		}
		//----------------------------------------------------------------------------------------
		public function activar($id, $autorizacion){
			global $miBD;
			$resultado = false;
			$datos = $miBD->ejecutar("SELECT id_usuario, clave_usuario, email_usuario 
									  FROM usuario_tmp 
									  WHERE id_usuario=? AND autorizacion=?",array($id, $autorizacion));
					
			if($datos){		
			$resultado = $miBD->ejecutarSimple("INSERT INTO usuario (id_usuario, nombre_usuario, clave_usuario, email_usuario) 
			                                    VALUES (?,?,?,?) ",array($datos[0][0], $datos[0][0], $datos[0][1], $datos[0][2]));
			
						 $miBD->ejecutarSimple("DELETE FROM usuario_tmp WHERE id_usuario = ? ",array($datos[0][0]));
			}		
			if($resultado){
				return $resultado;
			}	
			return false;
		}
		//----------------------------------------------------------------------------------------
		
    }
?>