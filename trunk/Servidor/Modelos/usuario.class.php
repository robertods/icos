<?
    
    class Usuario{
        private $id_usuario;
		private $url_usuario;

		// GETTERS Y SETTERS --------------------------------------------------------------------
        public function get($dato){ 			
            switch($dato){
                case 'id_usuario':  $dato = $this->id_usuario; break;
				case 'url_usuario': $dato = $this->url_usuario; break;
				
            }			
            return $dato; 		
        }

        /*public function set($dato,$valor){ 			
            switch($dato){
                case 'id_usuario':  $this->id_usuario  = $valor; break;
				case 'url_usuario': $this->url_usuario = $valor; break;
				
            }							
        }*/

        // METODOS ------------------------------------------------------------------------------

        public function loguearse($email, $clave){			
            global $miBD;
            $query = "SELECT id_usuario, url_usuario FROM usuario WHERE email_usuario=? AND clave_usuario=? AND debaja=0";
            $resultado = $miBD->ejecutar($query, array($email,md5($clave)));

            if($resultado){
                $this->id_usuario = $resultado[0]["id_usuario"];
				$this->url_usuario = $resultado[0]["url_usuario"];
                return true;
            }
            return false;
        }
		//----------------------------------------------------------------------------------------
		public function autoLogin($cookie){			
			global $miBD;
			$query = "SELECT id_usuario, url_usuario FROM usuario WHERE cookie_usuario=? AND vence_cookie>now() AND debaja=0";
			$resultado = $miBD->ejecutar($query, array($cookie));
	
			if($resultado){
				$this->id_usuario = $resultado[0]["id_usuario"];
				$this->url_usuario = $resultado[0]["url_usuario"];
				return true;
			}
			return false;			
		}
		//----------------------------------------------------------------------------------------
		public function cerrarSesion(){				
			Cookie::borrarCookie(session_name(), '', 0);
			Cookie::borrarCookie('icos_login', $_COOKIE['icos_login']);
			unset($_SESSION['usuario_activo']);
			unset($_SESSION['id_usuario_activo']);			
			session_destroy();
			return true;
		}		
		//----------------------------------------------------------------------------------------
		public function comprobarExistenciaNombre($nombre_usuario){
			global $miBD;
			$resultado = $miBD->ejecutarSimple("SELECT 1 FROM usuario WHERE url_usuario=?",array($nombre_usuario));			
			$resultado2 = $miBD->ejecutarSimple("SELECT 1 FROM usuario_tmp WHERE url_usuario=?",array($nombre_usuario));			
				
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
			$query = "INSERT INTO usuario_tmp (url_usuario, clave_usuario, email_usuario, autorizacion) VALUES (?,?,?,?) ";
			$resultado = $miBD->ejecutarSimple($query, array(strtolower($nombre), md5($clave), $email, $codigo_autorizacion));
					
			if($resultado){
				return $resultado;
			}	
			return false;
		}
		//----------------------------------------------------------------------------------------
		public function activar($usuario, $autorizacion){
			global $miBD;
			$resultado = false;
			$datos = $miBD->ejecutar("SELECT url_usuario, clave_usuario, email_usuario 
									  FROM usuario_tmp 
									  WHERE url_usuario=? AND autorizacion=?",array($usuario, $autorizacion));
					
			if($datos){		
				$resultado = $miBD->ejecutarSimple("INSERT INTO usuario (url_usuario, clave_usuario, email_usuario) 
													VALUES (?,?,?) ",array($datos[0][0], $datos[0][1], $datos[0][2]));
								
							 $id_obtenido = $miBD->obtenerUltimoId();	
							 $miBD->ejecutarSimple("INSERT INTO perfil (nombre_perfil, id_usuario) 
													VALUES (?,?) ",array(ucfirst(strtolower($datos[0][0])), $id_obtenido));
													
							 $miBD->ejecutarSimple("DELETE FROM usuario_tmp WHERE url_usuario = ? ",array($datos[0][0]));
			}		
			if($resultado){
				return $resultado;
			}	
			return false;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerPerfilUsuario($url_usuario){
			global $miBD;
			$query = "	SELECT 
							avatar_perfil,			
							nombre_perfil,
							prestigio_perfil,
							u.id_usuario
						FROM usuario u
						LEFT JOIN perfil p ON(u.id_usuario = p.id_usuario)
						WHERE u.url_usuario = ?
					 ";
			$resultado = $miBD->ejecutar($query, array($url_usuario));
			
			return $resultado;
		}	
		
		//----------------------------------------------------------------------------------------
		public function obtenerMiPerfil($id){
			global $miBD;
			$query = "	SELECT 
							p.avatar_perfil,		
							p.nombre_perfil,
							p.prestigio_perfil,
							u.email_usuario,
							u.url_usuario,
							u.clave_usuario,
							u.id_usuario
						FROM usuario u
						LEFT JOIN perfil p ON(u.id_usuario = p.id_usuario)
						WHERE u.id_usuario = ?
					 ";
			$resultado = $miBD->ejecutar($query, array($id));
			
			return $resultado;
		}	
		
		//----------------------------------------------------------------------------------------
		// 		METODOS A B M
		//----------------------------------------------------------------------------------------
		public function obtenerUsuarios(){
			global $miBD;
			$query = "	SELECT 
							avatar_perfil,
							url_usuario,
							nombre_perfil,
							email_usuario,
							prestigio_perfil,
							u.id_usuario
						FROM usuario u
						LEFT JOIN perfil p ON(u.id_usuario = p.id_usuario)
						WHERE u.debaja = 0
					 ";
			$resultado = $miBD->ejecutar($query);
			
			return $resultado;
		}
		//----------------------------------------------------------------------------------------
		public function obtenerUsuario($id_usuario){
			global $miBD;
			$query = "	SELECT 
							avatar_perfil,
							url_usuario,
							nombre_perfil,
							email_usuario,
							prestigio_perfil
						FROM usuario u
						LEFT JOIN perfil p ON(u.id_usuario = p.id_usuario)
						WHERE u.debaja = 0 AND u.id_usuario = ?
					 ";
			$resultado = $miBD->ejecutar($query, array($id_usuario));
			
			return $resultado;
		}	
		//----------------------------------------------------------------------------------------
		public function actualizarUsuario($datos){
			global $miBD;
			$query = "	UPDATE usuario
						SET	url_usuario = ?,
							email_usuario =	?					
						WHERE id_usuario = ?
					 ";
			$resultado1 = $miBD->ejecutarSimple($query, array($datos->url_usuario, $datos->email_usuario, $datos->id_usuario));
			
			$query = "	UPDATE perfil
						SET	avatar_perfil = ?,							
							nombre_perfil = ?,							
							prestigio_perfil = ?						
						WHERE id_usuario = ?
					 ";
			$resultado2 = $miBD->ejecutarSimple($query, array($datos->avatar_perfil, $datos->nombre_perfil, $datos->prestigio_perfil, $datos->id_usuario));
			
			if($resultado1 && $resultado2){ return true; }
			return false;
		}			
		//----------------------------------------------------------------------------------------
		public function borrarUsuario($id){
			global $miBD;
			$query = "UPDATE usuario SET debaja=1 WHERE id_usuario=?";
			$resultado = $miBD->ejecutarSimple($query, array($id));
			
			return $resultado;
		}		
		//----------------------------------------------------------------------------------------
		
		
		
		
    }
?>