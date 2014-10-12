var validacion = {}
validacion.email = false;
validacion.prestigio = false;

$(document).ready(function(){
	//$("#btnGuardarEdicion").click(guardarCambios);
	
	$("#txtEmail").focusout(function(){
		validarEmail();
	});
	
	$("#txtPrestigio").focusout(function(){
		validarPrestigio();
	});
	
	$("#btnGuardarEdicion").click(function(){
		if(validarFormularioRegistro()){  //si devuelve verdadero entra al if
			guardarCambios();
		}		
	});
	
});
//--------------------------------------------------------------------------------------------
function validarEmail(){
	var exp_reg_email = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$");
	
	if( !exp_reg_email.test($("#txtEmail").val()) ){
		$("#email-validar").html("Formato de e-mail inválido.");		
		validacion.email = false;
		return false;		
	}
	validacion.email = true;
}
//--------------------------------------------------------------------------------------------
function validarPrestigio(){
	var exp_reg_prestigio = new RegExp("^[0-9]+$");
	                                   //Validar un número entero
	if( !exp_reg_prestigio.test($("#txtPrestigio").val()) ){
		$("#prestigio-validar").html("Ingrese solo números para el prestigio.");		
		validacion.prestigio = false;
		return false;		
	}
	validacion.prestigio = true;
}
//--------------------------------------------------------------------------------------------
function validarFormularioRegistro(){
	validarEmail();
	validarPrestigio();
	
	if(validacion.email && validacion.prestigio){
		return true;
	}
	return false;
}
//------------------------------------------------------------------------------------------
function guardarCambios(){
	$("#frmEdicion").submit();
	
}