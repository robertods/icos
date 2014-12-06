function aceptarTrueque(id_propuesta){
	location = "trueque-aceptado/"+id_propuesta;
}

function pedirMejora(id_propuesta){
	$.ajax({
		url: "Ajax-pedir-mejora",
		data: { id_propuesta: id_propuesta },
		type: "POST",
		dataType: "text",		
		success: function(respuesta){ 
			if(respuesta=="mejora_pedida"){
				alert("Se ha pedido una mejora de la propuesta al usuario.");
			}
			else{
				alert("Hubo un error, no pudo pedirse la mejora");
			}
		}
	});
}