var textoError = "Usuario o Email invalido.";

$(document).ready(function(){
			
	$("#cajaError").hide();
	
	$("#txtEmail").keypress(function(e) {
		if(e.which == 13){ //enter
			intentoDeLogueo();
		}
	});
	
	$("#txtClave").keypress(function(e) {
		if(e.which == 13){ //enter
			intentoDeLogueo();
		}
	});
	
	$("#btnEntrar").click(function(){
		intentoDeLogueo();		
	});

});
//------------------------------------------------------------------------------------
function intentoDeLogueo(){
	if(validarFormularioLogin()){
		//$("#frmLogin").submit(); // esto solo sirve para que despues se pueda autocompletar el email
		comprobarDatosLogin();
	}	
}
//------------------------------------------------------------------------------------
function cerrarCajaError(){	
	$("#cajaError").fadeOut();
}
//------------------------------------------------------------------------------------
function validarFormularioLogin(){
	var exp_reg_email = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$");
	var exp_reg_clave = new RegExp("(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,20})$");
							// Entre 8 y 20 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales
		
	if( !exp_reg_email.test($("#txtEmail").val()) ){
		$("#cajaError .mensaje").html(textoError);//("Formato de E-mail inválido.");
		$("#cajaError").fadeIn();
		return false;		
	}

	if( !exp_reg_clave.test($("#txtClave").val()) ){		
		$("#cajaError .mensaje").html(textoError);//("Clave poco segura<br>Utilice entre 8 y 20 caracteres<br>por lo menos un digito y un alfanumérico,<br> y no puede contener caracteres espaciales");
		$("#cajaError").fadeIn();
		return false;		
	}	
	
	return true;
}
//------------------------------------------------------------------------------------
function comprobarDatosLogin(){
	var paramentros = {}
	paramentros.email_usuario = $("#txtEmail").val();
	paramentros.clave_usuario = $("#txtClave").val();
	paramentros.recordar_usuario = $('#chkRecordarme:checked').length;
	
	consultarServidor("Ajax-comprobar-datos-login", paramentros, resolverLogin);
}
//------------------------------------------------------------------------------------
function resolverLogin(data){
	if(data.valido){
		location = "inicio";
	}
	else{
		$("#cajaError .mensaje").html(textoError);
		$("#cajaError").fadeIn();
	}
}
//------------------------------------------------------------------------------------