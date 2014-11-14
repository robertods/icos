$(document).ready(function(){
	
	
	
});

//******************************************************************

function aceptar(id_propuesta){
	if(confirm("¿Confirma que acepta la propuesta para realizar el trueque?")){ 
		location = "mis-propuestas/aceptar:"+id_propuesta;
	}
	
}

function eliminar(id_propuesta){
	if(confirm("¿Confirma que quiere eliminar la propuesta ofrecida?")){ 
		location = "mis-propuestas/eliminar:"+id_propuesta;
	}
	
}