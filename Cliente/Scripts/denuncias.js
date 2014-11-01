var validacion = {}
validacion.seleccion = false;
validacion.detalle = false;


$(document).ready(function(){

	$("#comboTipoDenuncia").focusout(function(){
		validarCombo();
	});
	
	$("#txtDetalle").focusout(function(){
		validarDetalle();
	});
	
	
$("#btnEnviar").click(function(){
		if(validarFormulario()){  //si devuelve verdadero entra al if
			guardarCambios();
		}		
	});
	
});


//------------------------------------------------------------------------------------------
function validarCombo(){ 
	
  if ($("#comboTipoDenuncia").val()=='Seleccione'){ 
      	$("#combo-validar").html("Elija una opción.");		
      	validacion.seleccion = false;
		return false;		
   	} 
	$("#combo-validar").html("");
	validacion.seleccion = true;
}
//------------------------------------------------------------------------------------------
function validarDetalle(){ 

if ($("#txtDetalle").val()==""){ 
	$("#detalle-validar").html("Ingrese detalle de la denuncia.");		
      	validacion.detalle = false;
		return false;		
   	} 
	$("#detalle-validar").html("");
	validacion.detalle = true;
}
//------------------------------------------------------------------------------------------
function validarFormulario(){
	validarCombo();
	validarDetalle();
	
	if(validacion.seleccion && validacion.detalle){
		return true;
	}
	return false;
}
//------------------------------------------------------------------------------------------
function guardarCambios(){
	$("#frmDenuncia").submit();
}