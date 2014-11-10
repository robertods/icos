<?
class Catalogo{
	public function obtenerCategorias($tipo){
		global $miBD;
		$query="SELECT id_categoria, descripcion_categoria FROM categoria WHERE tipo=? AND debaja=0";
		$respuesta = $miBD->ejecutar($query, array($tipo), true);
		return $respuesta;
	}
}
?>