$(document).ready(function (){
	
	$(".prodx").click(function(){						
		if($("#Listado-productos-disponibles").find($(this)).length > 0){
			$("#Listado-productos-propuestos").append($(this));
			$(this).find("i").addClass("fa-minus-circle");
			$(this).find("i").removeClass("fa-plus-circle");
			$(this).addClass("negativo");
		}
		else{
			$("#Listado-productos-disponibles").append($(this));
			$(this).find("i").addClass("fa-plus-circle");
			$(this).find("i").removeClass("fa-minus-circle");
			$(this).removeClass("negativo");
		}
	});
	
	$("#btnEnviar").click(function(){
		//llena el hidden con los productos seleccionados
		var productos = $("#Listado-productos-propuestos").find("input:hidden");
		$("#hidPropuestos").val("");
		if(productos.length > 0){
			$.each(productos, function(key, hid ){
				var actual = $("#hidPropuestos").val();
				$("#hidPropuestos").val(actual + hid.value + ',');
			});
		}
		//aqui el hidden deberia estar lleno
		if($("#hidPropuestos").val()!=""){		
			$("#frmPropuesta").submit();
		}
		else{
			alert("Haga click en los productos disponibles para armar su propuesta.");
		}
	});
							
});