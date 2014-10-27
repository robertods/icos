<?php
importar("Servidor/Modelos/alerta.class.php");

global $dato;
if ($dato == "alertaheartbeat") { alertaHeartbeat(); }

//----------------------------------------------------------------------------------------------------

function alertaHeartbeat() {
	$objAlerta = new Alerta();
		
	$alertas = $objAlerta->obtenerAlertas($_SESSION['usuario_activo']);
			
	$items = '';
	$chatBoxes = array();

	foreach($alertas as $alerta) {

		$chat['message'] = sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "icos",
			"m": "{$chat['message']}"
	   },
EOD;

	}
	
	$objAlerta->actualizaRecibido($_SESSION['usuario_activo']);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

//----------------------------------------------------------------------------------------------------

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}