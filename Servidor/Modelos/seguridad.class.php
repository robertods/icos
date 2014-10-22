<?php
	class Seguridad {
		
		// METODOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		public static function Check(){
			if(!isset($_SESSION['usuario_activo'])){
				header("location: login");
				die;
			}			
		}
		public static function CheckAdmin(){
			if(!isset($_SESSION['usuario_activo'])){
				header("location: login");
				die;
			}
			$rol = Seguridad::getRol($_SESSION['id_usuario_activo']);
			if(!isset($_SESSION['usuario_activo']) || $rol != 2){
				header("location: login");
				die;
			}			
		}
		
		public static function getRol($id_usuario){
			global $miBD;
			$query = "SELECT id_rol FROM perfil WHERE id_usuario = ? ";
			$resultado = $miBD->ejecutarSimple($query, array($id_usuario));
			
			return $resultado;			
		}
		
	}
?>