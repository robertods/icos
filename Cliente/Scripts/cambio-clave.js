var validacion = {}
validacion.claveActual = false;
validacion.claveNueva = false;
validacion.reclave = false;

$(document).ready(function(){
	
	$("#txtClaveActual").focusout(function(){
		comprobarClaveVieja();
	});
	
	$("#txtClaveNueva").focusout(function(){
		validarClaveNueva();
	});
	
	$("#txtReClaveNueva").focusout(function(){
		validarClavesIguales();
	});
	
	

	$("#btnClave").click(function(){
		if(validarFormulario()){  
			guardarCambios();
		}		
	});
});

//------------------------------------------------------------------------------------
function comprobarClaveVieja(){
	var paramentros = {}
	paramentros.clave_usuario = $("#txtClaveActual").val();
	
	consultarServidor("Ajax-validar-clave", paramentros, claveComprobada);
}


function claveComprobada(respuesta){
	if(respuesta.valido){
		validacion.claveActual = true;
		$("#clave-valida").html("");	
	}
	
	else {
		validacion.claveActual = false;
		$("#clave-valida").html("Clave antigua inválida");	
	}
}


//------------------------------------------------------------------------------------
function validarClaveNueva(){	
	var exp_reg_clave = new RegExp("(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,20})$");
							// Entre 8 y 20 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres especiales
	if( !exp_reg_clave.test($("#txtClaveNueva").val()) ){		
		$("#clave-valida-nueva").html("Utilice entre 8 y 20 caracteres, al menos un digito y un alfanumérico, sin caracteres especiales.");
		validacion.claveNueva = false;
		return false;	
	}
	$("#clave-valida-nueva").html("");	
	validacion.claveNueva = true;	
}
//------------------------------------------------------------------------------------
function validarClavesIguales(){	
	if( $("#txtClaveNueva").val() != $("#txtReClaveNueva").val() ){		
		$("#clave-diferente").html("Las claves ingresadas no deben ser diferentes.");		
		validacion.reclave = false;
		return false;		
	}
	$("#clave-diferente").html("");
	validacion.reclave = true;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
function validarFormulario(){
	
	comprobarClaveVieja();
	validarClaveNueva();
	validarClavesIguales();
	if(validacion.claveActual && validacion.claveNueva && validacion.reclave){
		return true;
	}
	
	return false;
}
//------------------------------------------------------------------------------------------
function guardarCambios(){
	$("#formcambio").submit();
	
}