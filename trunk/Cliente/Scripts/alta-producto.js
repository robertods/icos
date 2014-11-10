var validacion = {}
validacion.tipo = false;
validacion.nombre = false;
validacion.url = false;
validacion.descripcion = false;
validacion.categoria = false;
validacion.etiqueta = false;
validacion.ubicacion = false;

$(document).ready(function(){

	var etiquetasPredefinidas = ['alfa', 'omega'];

	//replico lo escrito en el campo url
	$("#txtUrl").keyup(function(){
		var valor = $(this).val();
		$("#urlDisplay").html(valor);
	});
		  
	//creo componentes de etiqueta
	$('#txtEtiqueta').tagit({
		availableTags: etiquetasPredefinidas,		
		singleField: true,
		singleFieldNode: $('#hidEtiqueta')
	});	
	$('#txtEtiqueta-deseo').tagit({
		availableTags: etiquetasPredefinidas,		
		singleField: true,
		singleFieldNode: $('#hidEtiqueta-deseo')
	});
	
	//creo cajas de carga de fotos
	$("#fileFoto1").change(function(){
		return ShowImagePreview( this.files, 1 );
	});
	$("#fileFoto2").change(function(){
		return ShowImagePreview( this.files, 2 );
	});
	$("#fileFoto3").change(function(){
		return ShowImagePreview( this.files, 3 );
	});	
	$("#btnBorrarFoto1").click(function(){
		borrarCanvas( 1 );
	});
	$("#btnBorrarFoto2").click(function(){
		borrarCanvas( 2 );
	});
	$("#btnBorrarFoto3").click(function(){
		borrarCanvas( 3 );
	});
	
	//muestro solo el primer paso	
	$(".cajaWizard").hide();
	$("#caja1").show();
	
	//validaciones paso 1
	$("#combo-tipo").change(function(){
		validarComboTipo();
		cargarComboCategorias("#combo-categoria", $("#combo-tipo").val(), "Elige una categoria para tu producto o servicio");
	});
	$("#txtNombre").focusout(function(){
		validarNombre();
	});
	$("#txtUrl").focusout(function(){
		validarUrl();
	});
	$("#txtDescripcion").focusout(function(){
		validarDescripcion();
	});
	
	//validaciones paso 2
	$("#combo-categoria").change(function(){
		validarComboCat();		
	});
	$("#txtEtiqueta").focusout(function(){
		validarEtiqueta();
	});
	//paso 3
	$("#combo-tipo-deseo").change(function(){
		cargarComboCategorias("#combo-categoria-deseo", $("#combo-tipo-deseo").val(), "Elige una categoria para el producto o servicio deseado");
	});
	
	//validacion de cajas
	$("#btnSiguiente1").click(validarCaja1);
	$("#btnSiguiente2").click(validarCaja2);
	$("#btnSiguiente3").click(validarCaja3);
	
	$("#btnAnterior1").click(volverCaja1);
	$("#btnAnterior2").click(volverCaja2);
	$("#btnAnterior3").click(volverCaja3);
	
	$("#btnGuardar").click(guardarCambios);
	
	crearMapa("mapa_ubicacion", determinarUbicacion, "#hidUbicacion");
		
});

//------------------------------------------------------------------------------------------
function cargarComboCategorias(selector, valor, texto){
	if(valor!="Seleccione"){
		$.ajax({
			url: "Ajax-combo-categorias",
			data: {'valor': valor, 'texto': texto},
			type: 'POST',
			dataType: 'text',		
			success: function(data){
				$(selector).html(data);
			}
		});
	}
}
//------------------------------------------------------------------------------------------
function validarComboTipo(){ 
	
  if ($("#combo-tipo").val()=='Seleccione'){ 
      	$("#combo-tipo-validar").html("Elija una opción.");		
      	validacion.tipo = false;
		return false;		
   	} 
	$("#combo-tipo-validar").html("");
	validacion.tipo = true;
}
//------------------------------------------------------------------------------------------
function validarUrl(){  
var expresion = new RegExp("[a-zA-Z0-9\-]{3,30}");

	if( !expresion.test($("#txtUrl").val()) ){		
		$("#url-validar").html("Ingrese una Url válida.");		
		validacion.url = false;
		return false;	
	}
	$("#url-validar").html("");
	validacion.url = true;	
}
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
function validarComboCat(){ 
	
  if ($("#combo-categoria").val()=='Seleccione'){ 
      	$("#combo-categoria-validar").html("Elija una opción.");		
      	validacion.categoria = false;
		return false;		
   	} 
	$("#combo-categoria-validar").html("");
	validacion.categoria = true;
}
//------------------------------------------------------------------------------------------
function validarEtiqueta(){ 

if ($("#hidEtiqueta").val()==""){ 
	$("#etiqueta-validar").html("Debe ingresar al menos una etiqueta.");		
      	validacion.etiqueta = false;
		return false;		
   	} 
	$("#etiqueta-validar").html("");
	validacion.etiqueta = true;
}
//------------------------------------------------------------------------------------------
function validarUbicacion(){
	if ($("#hidUbicacion").val()==""){ 
		$("#ubicacion-validar").html("falta una ubicación aproximada.");		
			validacion.ubicacion = false;
			return false;		
   	} 
	$("#ubicacion-validar").html("");
	validacion.ubicacion = true;
}
//------------------------------------------------------------------------------------------
function validarCaja1(){	
	validarComboTipo();
	validarNombre();
	validarUrl();
	validarDescripcion();
	
	if(validacion.tipo && validacion.nombre && validacion.url && validacion.descripcion){	
		$(".cajaWizard").hide();
		$("#caja2").show();
		return true;
	}
	return false;
}
//------------------------------------------------------------------------------------------
function validarCaja2(){	
	    $(".cajaWizard").hide();
		$("#caja3").show();
		$("#mapa_ubicacion").gmap3({trigger:"resize"});
		geolocalizame();
}
//------------------------------------------------------------------------------------------
function validarCaja3(){	
	validarEtiqueta();
	validarUbicacion();
	
	if(validacion.etiqueta && validacion.ubicacion){
		$(".cajaWizard").hide();
		$("#caja4").show();
		return true;
	}
	return false;
}
//------------------------------------------------------------------------------------------
// botones volver
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
		$("#mapa_ubicacion").gmap3({trigger:"resize"});
		geolocalizame();
}
//------------------------------------------------------------------------------------------
function guardarCambios(){
	$("#frmCrear").submit();
}