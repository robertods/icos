<?
	importar("Servidor/Modelos/alerta.class.php");
	$alerta = new Alerta();
	
	$mis_alertas = $alerta->obtenerAlertas($_SESSION['id_usuario_activo']);
	
	$alertas_html = '';
	$cantidad = count($mis_alertas);
	
	for($i=0;$i<$cantidad;$i++){
		
		$dirProd = "Cliente/Imagenes/Productos/";	
		$imagen = (file_exists($dirProd.$mis_alertas[$i]['url_producto'].'_'.$mis_alertas[$i]['foto_principal'].".png"))? $mis_alertas[$i]['url_producto'].'_'.$mis_alertas[$i]['foto_principal'] : 'default_producto';
		
		$alertas_html .= "<a href='producto/{$mis_alertas[$i]['url_producto']}' title='{$mis_alertas[$i]['mensaje_alerta']}'>
							<div class='alertabox'>
								<div><img src='Cliente/Imagenes/Productos/{$imagen}.png' width='48px' height='48px' ></div>
								<div class='alertaTexto'>{$mis_alertas[$i]['mensaje_alerta']}<br><b>{$mis_alertas[$i]['url_producto']}</b></div>
							</div>
						  </a>
						 ";
	}
		
	echo ($alertas_html!='')? $alertas_html : '<div style="margin:80px;font-size:18px;">No hay alertas para mostrar.</div>';
?>