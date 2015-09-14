<?php
class Util{
	static function arrumaDataHora($dataHora){
		$tmp = explode(" ",$dataHora);
		$d = $tmp[0];
		$h = $tmp[1];
		$data = explode("-",$d);
		$hora = explode(':',$h);
		return $data[2]."/".$data[1]."/".$data[0]." ".$hora[0].":".$hora[1];
	}
	
	static function arrumaData($data){
		$dt = explode("-", $data);
		return $dt[2]."/".$dt[1]."/".$dt[0];
	}
	
	static function now(){
		return date('Y-m-d H:i:s');
	}
	
	static function arrumaPreco($preco, $bd = 0){
		$preco = $preco*100;
		$preco = floor($preco);
		$preco = $preco/100;
		$preco = str_replace(",", ".", $preco);
		$v = explode(".", $preco);
		if(!isset($v[1])){
			$v[1] = '00';
		}
		if(!isset($v[1][1])){
			$v[1][1] = '0';
		}
		if($bd == 0){
			return $v[0].",".$v[1];
		} else {
			return $v[0].".".$v[1];
		}
		
	}
	
	static function alert($texto){
		str_replace("'", "", $texto);
		str_replace('"', "", $texto);
		echo '<script>alert("'.$texto.'")</script>';
	}
}
?>