<?
    //---------------------------------------------------
    //      Aplicacion
    //---------------------------------------------------
		
		importar('Servidor/Modelos/application.class.php');
        global $APP;        
        $APP = new appConfig;
        
        $APP->modoDebug = true;
        $APP->urlApp = 'localhost/icostrueque'; //'http://www.icosweb.tk';
        $APP->tokenApp = 'TAMicos';
        $APP->saltCookie = 'icosXcookie';
        $APP->saltMail = 'icosXmail';
        $APP->accionDefecto = 'home';
        $APP->header_publico = 'Cliente/Vistas/Comunes/header_publico.html';
        $APP->footer_publico = 'Cliente/Vistas/Comunes/footer_publico.html';
        $APP->header = 'Cliente/Vistas/Comunes/header_privado.html';
        $APP->footer = 'Cliente/Vistas/Comunes/footer_privado.html';
		
    //---------------------------------------------------
    //      Conexion a Base de Datos
    //---------------------------------------------------
        
        importar('Servidor/Datos/Connection.class.php');
        global $CONNECTION;        
        $CONNECTION = new dbConnection;
        
        $CONNECTION->HOST = 'localhost';            
        $CONNECTION->DBUSER = 'root'; 	
        $CONNECTION->DBPASS = '';       
        $CONNECTION->DBNAME = 'menta';
        $CONNECTION->PORT = '3306';
        $CONNECTION->PROVIDER = 'MySql';

    //---------------------------------------------------
    //      Cuenta E-Mail
    //---------------------------------------------------
        
		importar('Servidor/Modelos/emailConnection.class.php');
        global $EMAIL;
        $EMAIL = new emailConnection;

		$EMAIL->MAILER = "smtp";        
        $EMAIL->SMTPAUTH = true;
		$EMAIL->SMTPSECURE = 'ssl';
		$EMAIL->HOST = "plus.smtp.mail.yahoo.com";
		$EMAIL->PORT = 465;
		$EMAIL->ISHTML = true;
        $EMAIL->USERNAME = "naviimailer@yahoo.com.ar"; 
        $EMAIL->PASSWORD = "TAMicos2014";
        $EMAIL->FROM = "naviimailer@yahoo.com.ar";
        $EMAIL->FROMNAME = "Administrador de ICOS";
        $EMAIL->TIMEOUT = 30;
			
    //---------------------------------------------------