var validacion = {}
validacion.nombre = false;
validacion.email = false;
validacion.clave = false;
validacion.reclave = false;

$(document).ready(function(){
	
	$("#cajaError").hide();
		
	$("#txtNombre").focusout(function(){
		validarNombreUsuario();
	});
	
	$("#txtEmail").focusout(function(){
		validarEmail();
	});
	
	$("#txtClave").focusout(function(){
		validarClave();
	});
	
	$("#txtReClave").focusout(function(){
		validarClavesIguales();
	});
	
	$("#btnRegistrar").click(function(){
		if(validarFormularioRegistro()){
			realizarAltaUsuario();
		}		
	});

});
//------------------------------------------------------------------------------------
function cerrarCajaError(){	
	$("#cajaError").fadeOut();
	/* reinicio de formulario */
	$("#txtNombre").val("");
	$("#txtEmail").val("");
	$("#txtClave").val("");
	$("#txtReClave").val("");
	$("#email-existe").html("");
	$("#email-existe").removeClass("verificacionVerde");
	$("#nombre-existe").html("");
	$("#nombre-existe").removeClass("verificacionVerde");
	validacion.nombre = false;
	validacion.email = false;
	validacion.clave = false;
	validacion.reclave = false;
	$(".contact-form").fadeIn();
}
//---------------------------------------------------------------------------------------------------------------------------------------------
function validarNombreUsuario(){	
	var exp_reg_nombre = new RegExp("^[A-Za-z0-9]{4,15}$");
	
	if( !exp_reg_nombre.test($("#txtNombre").val()) ){
		$("#nombre-existe").html("Use sólo letras y números.");		
		validacion.nombre = false;
		return false;		
	}
	
	var paramentros = {}	
	paramentros.nombre_usuario = $("#txtNombre").val().toLowerCase();
	
	consultarServidor("Ajax-comprobar-usuario-existente", paramentros, cuadroErrorNombre, "text" );
}
//------------------------------------------------------------------------------------
function validarEmail(){	
	var paramentros = {}	
	paramentros.email_usuario = $("#txtEmail").val();
	consultarServidor("Ajax-comprobar-email-existente", paramentros, cuadroErrorEmail, "text" );
}
//------------------------------------------------------------------------------------
function validarClave(){	
	var exp_reg_clave = new RegExp("(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,20})$");
							// Entre 8 y 20 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres especiales
	if( !exp_reg_clave.test($("#txtClave").val()) ){		
		$("#clave-valida").html("Utilice entre 8 y 20 caracteres, al menos un digito y un alfanumérico, sin caracteres especiales.");
		validacion.clave = false;
		return false;	
	}
	$("#clave-valida").html("");	
	validacion.clave = true;	
}
//------------------------------------------------------------------------------------
function validarClavesIguales(){	
	if( $("#txtClave").val() != $("#txtReClave").val() ){		
		$("#clave-diferente").html("Las claves ingresadas no deben ser diferentes.");		
		validacion.reclave = false;
		return false;		
	}
	$("#clave-diferente").html("");
	validacion.reclave = true;
}
//--------------------------------------------------------------------------------------------------------------------------------------------
function cuadroErrorNombre(existe){
	existe = parseInt(existe);
	
	if(!existe){
		$("#nombre-existe").html("Nombre de usuario correcto");
		$("#nombre-existe").addClass("verificacionVerde");
		validacion.nombre = true;
	}
	else{		
		$("#nombre-existe").html("Ese nombre de usuario no está disponible.");
		$("#nombre-existe").removeClass("verificacionVerde");
		validacion.nombre = false;
	}
}
//------------------------------------------------------------------------------------
function cuadroErrorEmail(existe){
	existe = parseInt(existe);
	var exp_reg_email = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$");
	
	if( !exp_reg_email.test($("#txtEmail").val()) ){
		$("#email-existe").html("Formato de E-mail inválido.");		
		validacion.email = false;
		return false;		
	}
	
	if(!existe){
		$("#email-existe").html("Email correcto");
		$("#email-existe").addClass("verificacionVerde");
		validacion.email = true;
	}
	else{
		$("#email-existe").html("Ya existe una cuenta asociada a ese E-mail");
		$("#email-existe").removeClass("verificacionVerde");
		validacion.email = false;
	}
}
//--------------------------------------------------------------------------------------------------------------------------------------------
function validarFormularioRegistro(){
		
	validarNombreUsuario();
	validarEmail();
	validarClave();
	validarClavesIguales();
	if(validacion.nombre && validacion.email && validacion.clave && validacion.reclave){
		return true;
	}
	
	return false;
}
//------------------------------------------------------------------------------------
function realizarAltaUsuario(){
	var paramentros = {}
	paramentros.nombre_usuario = $("#txtNombre").val().toLowerCase();
	paramentros.email_usuario = $("#txtEmail").val();
	paramentros.clave_usuario = $("#txtClave").val();
		
	consultarServidor("Ajax-registrar-usuario", paramentros, accionRespuestaObtenida, "json", "POST", mostrarEnviando);
}
//------------------------------------------------------------------------------------
function mostrarEnviando(){
    $(".btnOk").hide();
    $(".contact-form").fadeOut();
	$("#cajaError .mensaje").html("Enviando.....");
	$("#cajaError").fadeIn();
}
//------------------------------------------------------------------------------------
function accionRespuestaObtenida(datos){
	 $(".btnOk").show();
	if(datos.usuario_creado){
		$("#cajaError .mensaje").html("Se ha enviado un email para que verifique la cuenta.");
		$("#cajaError").fadeIn();
	}
	else{
		$("#cajaError .mensaje").html("Ocurrio un problema, intente mas tarde.");
		$("#cajaError").fadeIn();
	}
}
//------------------------------------------------------------------------------------