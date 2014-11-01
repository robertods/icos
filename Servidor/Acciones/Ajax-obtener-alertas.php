<?
	importar("Servidor/Modelos/alerta.class.php");
	$alerta = new Alerta();
	
	$mis_alertas = $alerta->obtenerAlertas($_SESSION['id_usuario_activo']);
	
	$alertas_html = '';
	$cantidad = count($mis_alertas);
	
	for($i=0;$i<$cantidad;$i++){
	$alertas_html .= "<a href='producto/{$mis_alertas[$i]['url_producto']}' title='{$mis_alertas[$i]['mensaje_alerta']}'>
						<div class='alertabox'>
							<div><img src='Cliente/Imagenes/Productos/{$mis_alertas[$i]['url_producto']}1.jpg' width='48px' height='48px' ></div>
							<div class='alertaTexto'>{$mis_alertas[$i]['mensaje_alerta']}</div>
						</div>
					  </a>
					 ";
	}
	
	echo $alertas_html;
?>