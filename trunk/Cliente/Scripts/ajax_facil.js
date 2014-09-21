function consultarServidor(url, parametros, manejar_respuesta, tipo_dato_respuesta, tipo_envio, hacer_antes_enviar ){
	
	if(typeof(tipo_dato_respuesta) == "undefined"){ tipo_dato_respuesta = "json"; }
	if(typeof(tipo_envio) == "undefined"){ tipo_envio = "POST"; }
	
	$.ajax({
		url: url,
		data: parametros,
		type: tipo_envio,
		dataType: tipo_dato_respuesta,
		beforeSend: function( xhr ) {			
			if(typeof(hacer_antes_enviar) == "function"){ hacer_antes_enviar( xhr ); }
		},
		success: function(data){
			if(typeof(manejar_respuesta) == "function"){ manejar_respuesta( data ); }
		}
	});
	
}