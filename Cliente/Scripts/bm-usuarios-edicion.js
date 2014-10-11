$(document).ready(function(){
	
	$("#btnGuardarEdicion").click(guardarCambios);

	
});
//------------------------------------------------------------------------------------------
function guardarCambios(){

	if($("chkAvatar").is(":checked")){
		$('hidAvatar').disabled = true;
	}

	$("#frmEdicion").submit();
}