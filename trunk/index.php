<?
//-----------------------------------------------------------------------------------------------
//		Controlador Frontal
//-----------------------------------------------------------------------------------------------
// 		Trabajo Practico Integrador 
//		Alumnos: Diaz Schwab, Roberto
//		         Panasia, Marcela
//		Fecha: 2014-08-31
//		Email: diazschwab@yahoo.com.ar
//             marcelapanasia@gmail.com
//-----------------------------------------------------------------------------------------------

session_start();
require_once 'Servidor/Extensiones/importar.php';

try{
    //-----------------------------------------------------------------------------------------------	
	//		Carga la configuracion
	//-----------------------------------------------------------------------------------------------
                                                
			importar("config.php");
			importar("Servidor/Datos/CrearConexion.inc.php");
			global $APP;
			
    //-----------------------------------------------------------------------------------------------
	// 		Defino accion
	//-----------------------------------------------------------------------------------------------		
                     
			if(isset($_GET['accion'])){
				$accion = $_GET['accion'];
				unset($_GET['accion']);				
			}
			else{
				$accion = $APP->accionDefecto;
			}
	//-----------------------------------------------------------------------------------------------
	// 		Defino el dato
	//-----------------------------------------------------------------------------------------------			
			global $dato;
			if(isset($_GET['dato'])){
				$dato = $_GET['dato'];
				unset($_GET['dato']);				
			}
			else{
				$dato = null;
			}
	//-----------------------------------------------------------------------------------------------
	//		Incluimos la accion
	//-----------------------------------------------------------------------------------------------		
	    
            $accion = 'Servidor/Acciones/' . $accion . '.php';		
            importar($accion, "No existe la accion <b>".$accion."</b>");
			
	//-----------------------------------------------------------------------------------------------			
}
catch(Exception $e){
    
        //-----------------------------------------------------------------------------------------------
        //              Disparo la accion de Error capturado
        //-----------------------------------------------------------------------------------------------
            			
            importar('Servidor/Modelos/error.class.php');
                        
            if($APP->modoDebug){                
                $error = new naviiError;
                $error->mensaje = $e->getMessage();
                $error->archivo = $e->getFile();
                $error->linea = $e->getLine();
                $error->fecha = date("Y-m-d H:i:s");
                $error->pila = $e->getTraceAsString();
            }
			
			importar('Servidor/Acciones/error.php');
            die;
        
        //-----------------------------------------------------------------------------------------------        
}
?>