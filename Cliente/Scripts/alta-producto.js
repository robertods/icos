var validacion = {}
validacion.tipo = false;
validacion.nombre = false;
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
	
	//validaciones paso 2
	$("#combo-categoria").change(function(){
		validarComboCat();		
	});
	$("#txtEtiqueta").focusout(function(){
		validarEtiqueta();
	});
	$("#txtDescripcion").focusout(function(){
		validarDescripcion();
	});
	
	//paso 3
	$("#combo-tipo-deseo").change(function(){
		cargarComboCategorias("#combo-categoria-deseo", $("#combo-tipo-deseo").val(), "Elige una categoria para el producto o servicio deseado");
	});
	
	//validacion de cajas
	$("#btnSiguiente1").click(validarCaja1);
	$("#btnSiguiente2").click(validarCaja2);
	$("#btnSiguiente3").click(validarCaja3);
	$("#btnSiguiente4").click(validarCaja4);
	
	$("#btnAnterior1").click(volverCaja1);
	$("#btnAnterior2").click(volverCaja2);
	$("#btnAnterior3").click(volverCaja3);
	$("#btnAnterior4").click(volverCaja4);
	
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
      	$("#combo-tipo-validar").html("Eligí una opción.");		
      	validacion.tipo = false;
		return false;		
   	} 
	$("#combo-tipo-validar").html("");
	validacion.tipo = true;
}

//------------------------------------------------------------------------------------------
function validarNombre(){  
var expresion = new RegExp("[a-zA-Z0-9]{3,30}");

	if( !expresion.test($("#txtNombre").val()) ){		
		$("#nombre-validar").html("Ingresá el nombre de tu producto/servicio");		
		validacion.nombre = false;
		return false;	
	}
	$("#nombre-validar").html("");
	validacion.nombre = true;
}
//------------------------------------------------------------------------------------------
function validarDescripcion(){ 

if ($("#txtDescripcion").val()==""){ 
	$("#descripcion-validar").html("Ingresá una descripción del producto/servicio.");		
      	validacion.descripcion = false;
		return false;		
   	} 
	$("#descripcion-validar").html("");
	validacion.descripcion = true;
}
//------------------------------------------------------------------------------------------
function validarComboCat(){ 
	
  if ($("#combo-categoria").val()=='Seleccione'){ 
      	$("#combo-categoria-validar").html("Eligí una opción.");		
      	validacion.categoria = false;
		return false;		
   	} 
	$("#combo-categoria-validar").html("");
	validacion.categoria = true;
}
//------------------------------------------------------------------------------------------
function validarEtiqueta(){ 

if ($("#hidEtiqueta").val()==""){ 
	$("#etiqueta-validar").html("Ingresá al menos una etiqueta.");		
      	validacion.etiqueta = false;
		return false;		
   	} 
	$("#etiqueta-validar").html("");
	validacion.etiqueta = true;
}
//------------------------------------------------------------------------------------------
function validarUbicacion(){
	if ($("#hidUbicacion").val()==""){ 
		$("#ubicacion-validar").html("Para seguir falta agregar la ubicación.");		
			validacion.ubicacion = false;
			return false;		
   	} 
	$("#ubicacion-validar").html("");
	validacion.ubicacion = true;
}
//------------------------------------------------------------------------------------------
function validarCaja1(){	
	validarComboTipo();
	validarComboCat();
	validarNombre();
	
	
	if(validacion.tipo && validacion.categoria && validacion.nombre){	
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
		
}
//------------------------------------------------------------------------------------------
function validarCaja3(){	
	validarDescripcion();
	validarEtiqueta();
	
	if(validacion.descripcion && validacion.etiqueta){
		$(".cajaWizard").hide();
		$("#caja4").show();
		
		$("#mapa_ubicacion").gmap3({trigger:"resize"});
		geolocalizame();
		
		return true;
	}
	return false;
}
//------------------------------------------------------------------------------------------
function validarCaja4(){	
	validarUbicacion();
	
	
		
	if(validacion.ubicacion){
		$(".cajaWizard").hide();
		$("#caja5").show();
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

function volverCaja4(){	
		$(".cajaWizard").hide();
		$("#caja4").show();	
}
//------------------------------------------------------------------------------------------
function guardarCambios(){
	$("#frmCrear").submit();
}