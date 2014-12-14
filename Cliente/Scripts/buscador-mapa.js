$(document).ready(function(){
	
	crearMapa("mapa");
	
	var etiquetasPredefinidas = etiquetas_disponibles;
	
	$("#txtEtiqueta").keypress(function(e) {
		if(e.which == 13){ //enter
			buscarProductos();
		}
	});
	
	//creo componentes de etiqueta
	$('#txtEtiqueta').tagit({
		availableTags: etiquetasPredefinidas,		
		singleField: true,
		singleFieldNode: $('#hidEtiqueta')
	});	
	
	//combos
	$("#combo-tipo").change(function(){		
		cargarComboCategorias("#combo-categoria", $("#combo-tipo").val(), "Elige una categoria para filtrar tu busqueda");
	});
		
	
	$("#btnBuscar").click(buscarProductos);
	

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
	else{
		$(selector).html("<option value='Seleccione'>Elige una categoria para filtrar tu busqueda</option>");
	}
}
//-------------------------------------------------------------------------------------
function buscarProductos(){
	var texto_buscado = $("#hidEtiqueta").val().trim()
	if(texto_buscado.length > 0){
	
		var paramentros = {}
		paramentros.texto_buscado = texto_buscado;
		paramentros.combo_tipo = $("#combo-tipo").val();
		paramentros.combo_categoria = $("#combo-categoria").val();
		
		consultarServidor("Ajax-buscar-productos", paramentros, ponerEnMapa);
		
	}
}
//-------------------------------------------------------------------------------------
function ponerEnMapa(respuesta){
	$("#panel").html(" Haga click en un producto o servicio del mapa.");
	var marcadores = [];
	//respuesta[1].titulo_producto: "matematica 3"
	$.each(respuesta, function(indice, elemento){
		var posiciones = elemento.ubicacion_producto.substring(6, elemento.ubicacion_producto.length-1).split(" ");
		var ubicacion = new google.maps.LatLng( parseFloat(posiciones[1]), parseFloat(posiciones[0]) );
		
		var data = { 'titulo': elemento.titulo_producto, 
					 'descripcion': elemento.descripcion_producto, 
					 'usuario': elemento.url_usuario,
					 'url': elemento.url_producto, 
					 'foto': "Cliente/Imagenes/Productos/"+elemento.foto+".png",
					 'prestigio': elemento.prestigio_perfil,
					 'es_servicio': elemento.es_servicio
			       }		
			
		var obj = {	'latLng': ubicacion, 
					'data': data,					
					'options':{'icon': "Cliente/Imagenes/Markers/"+elemento.icono+".png"}
				  }
		
		marcadores.push(obj);
	});
		
	agregarMarcadores("mapa", marcadores, mostrarDetalle, mostrarDetalleCluster);
	
	
}
//-------------------------------------------------------------------------------------
function mostrarDetalle(marker, event, context){
	a = context.data.foto;
	b = context.data.url;
	c = context.data.titulo;
	d = context.data.descripcion;
	e = context.data.usuario;
	f = context.data.prestigio;
	g = (parseInt(context.data.es_servicio))?"verdoso":"naranjado";
	h = (parseInt(context.data.es_servicio))?"servicio":"producto";
	$("#panel").html("<div class='resultado'><div class='res-foto'><img src='"+a+"' width='96px' height='96px' /><i title='"+h+"' class='fa fa-star "+g+"'></i>"+f+"</div><div class='res-cont'><b><a href='producto/"+b+"'>"+c+"</a></b> ("+e+")<br>"+d+"</div><div class='desvanece'></div></div>");
	//createEllipsis(".res-cont");
}
//-------------------------------------------------------------------------------------
function mostrarDetalleCluster(cluster, event, context){
	var data = "";
	$.each(context.data.markers, function(indice, elemento){
		a = elemento.data.foto;
		b = elemento.data.url;
		c = elemento.data.titulo;
		d = elemento.data.descripcion;
		e = elemento.data.usuario;
		f = elemento.data.prestigio;
		g = (parseInt(elemento.data.es_servicio))?"verdoso":"naranjado";
		h = (parseInt(elemento.data.es_servicio))?"servicio":"producto";
		data += "<div class='resultado'><div class='res-foto'><img src='"+a+"' width='96px' height='96px' /><i title='"+h+"' class='fa fa-star "+g+"'></i>"+f+"</div><div class='res-cont'><b><a href='producto/"+b+"'>"+c+"</a></b> ("+e+")<br>"+d+"</div><div class='desvanece'></div></div>";
	});
	//createEllipsis(".res-cont");
	$("#panel").html(data);
}
//-------------------------------------------------------------------------------------
