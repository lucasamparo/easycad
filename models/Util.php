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
		if($data == null){
			return null;
		}
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
	
	static function retornaMes($mes){
		switch($mes){
			case 1:
				return "Janeiro";
				break;
			case 2:
				return "Fevereiro";
				break;
			case 3:
				return "Mar�o";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Maio";
				break;
			case 6:
				return "Junho";
				break;
			case 7:
				return "Julho";
				break;
			case 8:
				return "Agosto";
				break;
			case 9:
				return "Setembro";
				break;
			case 10:
				return "Outubro";
				break;
			case 11:
				return "Novembro";
				break;
			case 12:
				return "Dezembro";
				break;
		}
	}
}
?>