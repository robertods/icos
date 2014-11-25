var validacion = {}
validacion.clave = false;
validacion.reclave = false;

$(document).ready(function(){
	
	$("#txtClaveActual").focusout(function(){
		validarClave();
	});
	
	$("#txtReClaveNueva").focusout(function(){
		validarClavesIguales();
	});
	
	

	$("#btnEditar").click(function(){
		if(validarFormulario()){  
			guardarCambios();
		}		
	});
});

//------------------------------------------------------------------------------------
function validarClave(){	
	var exp_reg_clave = new RegExp("(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,20})$");
							// Entre 8 y 20 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales
	if( !exp_reg_clave.test($("#txtClaveActual").val()) ){		
		$("#clave-valida").html("Utilice entre 8 y 20 caracteres, al menos un digito y un alfanumérico, sin caracteres especiales.");
		validacion.clave = false;
		return false;	
	}
	$("#clave-valida").html("");	
	validacion.clave = true;	
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
	
	validarClave();
	validarClavesIguales();
	if(validacion.clave && validacion.reclave){
		return true;
	}
	
	return false;
}
//------------------------------------------------------------------------------------------
function guardarCambios(){
	$("#btnEditar").submit();
	
}