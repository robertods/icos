<?php
importar("Servidor/Modelos/chat.class.php");

global $dato;
if ($dato == "chatheartbeat") { chatHeartbeat(); } 
if ($dato == "sendchat") { sendChat(); } 
if ($dato == "closechat") { closeChat(); } 
if ($dato == "startchatsession") { startChatSession(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

//----------------------------------------------------------------------------------------------------

function chatHeartbeat() {
	$objChat = new Chat();
		
	$chats = $objChat->obtenerChat($_SESSION['usuario_activo']);
			
	$items = '';
	$chatBoxes = array();

	foreach($chats as $chat) {

		if (!isset($_SESSION['openChatBoxes'][$chat['fromUser']]) && isset($_SESSION['chatHistory'][$chat['fromUser']])) {
			$items = $_SESSION['chatHistory'][$chat['fromUser']];
		}

		$chat['message'] = sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['fromUser']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['fromUser']])) {
		$_SESSION['chatHistory'][$chat['fromUser']] = '';
	}

	$_SESSION['chatHistory'][$chat['fromUser']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['fromUser']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['fromUser']]);
		$_SESSION['openChatBoxes'][$chat['fromUser']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Enviado a las $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}
	
	$objChat->actualizaRecibido($_SESSION['usuario_activo']);

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

function chatBoxSession($chatbox) {
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

//----------------------------------------------------------------------------------------------------

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
?>
{
		"username": "<?php echo $_SESSION['usuario_activo'];?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
}

//----------------------------------------------------------------------------------------------------

function sendChat() {
	$objChat = new Chat();
	$from = $_SESSION['usuario_activo'];
	$to = $_POST['toUser'];
	$message = $_POST['message'];

	$_SESSION['openChatBoxes'][$_POST['toUser']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['toUser']])) {
		$_SESSION['chatHistory'][$_POST['toUser']] = '';
	}

	$_SESSION['chatHistory'][$_POST['toUser']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['toUser']]);
	
	$objChat->enviarChat($from, $to, $message);
	
	echo "1";
	exit(0);
}

//----------------------------------------------------------------------------------------------------

function closeChat() {
	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
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