<?		
	importar("Servidor/Extensiones/phpMailer/PHPMailerAutoload.php");
	
	class RespuestaEnvio{
		public $enviado;
		public $error;
	}
			
	class Email{

		// METODOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::		
				
		public static function enviar($destinatario, $asunto, $cuerpoHTML, $cuerpoText){
			
			global $EMAIL;			
			$mail = new PHPMailer();
								
			$mail->IsSMTP(); 		// enable SMTP
			//$mail->SMTPDebug  = 0;  // debugging: 1 = errors and messages, 2 = messages only
			$mail->Mailer     = $EMAIL->MAILER;			
			$mail->SMTPAuth   = $EMAIL->SMTPAUTH;
			$mail->SMTPSecure = $EMAIL->SMTPSECURE;			
			$mail->Host       = $EMAIL->HOST;
			$mail->Port       = $EMAIL->PORT;
			$mail->IsHTML($EMAIL->ISHTML);
			$mail->Username   = $EMAIL->USERNAME; 
			$mail->Password   = $EMAIL->PASSWORD;
			$mail->SetFrom($EMAIL->FROM);
			$mail->FromName   = $EMAIL->FROMNAME;
			$mail->Timeout    = $EMAIL->TIMEOUT;
		  		  
			$mail->AddAddress($destinatario);
			$mail->Subject = $asunto;
			$mail->Body    = $cuerpoHTML;
			$mail->AltBody = $cuerpoText;
			$exito = $mail->Send();
			
			$intentos=1; 
			while ((!$exito) && ($intentos < 5)){
				sleep(5);
				$exito = $mail->Send();
				$intentos=$intentos+1;	
			} 
			
			$respuesta = new RespuestaEnvio;
						
			if(!$exito){
				$respuesta->enviado = false;
				$respuesta->error = $mail->ErrorInfo;
				return $respuesta;
			}
			else{
				$respuesta->enviado = true;
				return $respuesta;
			} 
	
		}
		//----------------------------------------------------------------------------------------
				
	}
	
?>