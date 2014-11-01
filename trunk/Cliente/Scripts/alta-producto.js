var validacion = {}
validacion.nombre = false;
validacion.seleccion = false;
validacion.descripcion = false;
validacion.etiqueta = false;

$(document).ready(function(){
	
	$(".cajaWizard").hide();
	$("#caja1").show();
	
	$("#txtNombre").focusout(function(){
		validarNombre();
	});
	
	$("#combo").focusout(function(){
		validarCombo();
	});
	
	$("#txtDescripcion").focusout(function(){
		validarDescripcion();
	});
	
	$("#txtEtiqueta").focusout(function(){
		validarEtiqueta();
	});
	
	/*
	$(function(){
    $(".custom-input-file input:file").change(function(){
        $(this).parent().find(".archivo").html($(this).val());
    }).css('border-width',function(){
        if(navigator.appName == "Microsoft Internet Explorer")
            return 0;
    });
	});*/
	
	$("#btnSiguiente1").click(validarCaja1);
	$("#btnSiguiente2").click(validarCaja2);
	$("#btnSiguiente3").click(validarCaja3);
	
	$("#btnAnterior1").click(volverCaja1);
	$("#btnAnterior2").click(volverCaja2);
	$("#btnAnterior3").click(volverCaja3);
	
	$("#btnGuardar").click(guardarCambios);
	
});

//------------------------------------------------------------------------------------------
function validarNombre(){  
var expresion = new RegExp("[a-zA-Z0-9]{3,30}");

	if( !expresion.test($("#txtNombre").val()) ){		
		$("#nombre-validar").html("Ingrese el nombre del producto.");		
		validacion.nombre = false;
		return false;	
	}
	$("#nombre-validar").html("");
	validacion.nombre = true;	
}
//------------------------------------------------------------------------------------------
function validarCombo(){ 
	
  if ($("#combo").val()=='Seleccione'){ 
      	$("#combo-validar").html("Elija una opción.");		
      	validacion.seleccion = false;
		return false;		
   	} 
	$("#combo-validar").html("");
	validacion.seleccion = true;
}
//------------------------------------------------------------------------------------------
function validarDescripcion(){ 

if ($("#txtDescripcion").val()==""){ 
	$("#descripcion-validar").html("Ingrese una descripción del producto.");		
      	validacion.descripcion = false;
		return false;		
   	} 
	$("#descripcion-validar").html("");
	validacion.descripcion = true;
}
//------------------------------------------------------------------------------------------
function validarEtiqueta(){ 

if ($("#txtEtiqueta").val()==""){ 
	$("#etiqueta-validar").html("Debe ingresar al menos una etiqueta.");		
      	validacion.etiqueta = false;
		return false;		
   	} 
	$("#etiqueta-validar").html("");
	validacion.etiqueta = true;
}
//------------------------------------------------------------------------------------------
function validarCaja1(){	
	validarNombre();
	validarCombo();
	validarDescripcion();
	
	if(validacion.nombre && validacion.seleccion && validacion.descripcion){
	
		$(".cajaWizard").hide();
		$("#caja2").show();
		return true;
	}
	return false;
}
//------------------------------------------------------------------------------------------
function validarCaja3(){	
	validarEtiqueta();
	
	if(validacion.etiqueta){
		$(".cajaWizard").hide();
		$("#caja4").show();
		return true;
	}
	return false;
}
//------------------------------------------------------------------------------------------
function validarCaja2(){	
	    $(".cajaWizard").hide();
		$("#caja3").show();
}

//------------------------------------------------------------------------------------------

function volverCaja1(){	
		$(".cajaWizard").hide();
		$("#caja1").show();
}
//------------------------------------------------------------------------------------------

function volverCaja2(){	
		$(".cajaWizard").hide();
		$("#caja2").show();
}
//------------------------------------------------------------------------------------------

function volverCaja3(){	
		$(".cajaWizard").hide();
		$("#caja3").show();
}
//------------------------------------------------------------------------------------------
function guardarCambios(){
	$("#frmCrear").submit();
}