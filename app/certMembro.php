<?php
	require_once('../models/bootstrap.php');
	require_once('../libs/fpdf/fpdf.php');
	
	$m = new Membros();
	$m->setCodMembro($_GET['id']);
	$membro = $m->retornarMembroPorId();
	//Iniciado o PDF
	$pdf = new FPDF('L','mm','A4');
	$pdf->Open();
	$pdf->SetMargins(0, 0, 0);
	//Colocando o BG
	$imgFrente = "imgCert/frente_membro.png";
	if(file_exists($imgFrente)){
		$pdf->Image($imgFrente,null,null,297,210);
	} else {
		Util::alert('Falha na configuração do certificado de Membros');
		return null;
	}
	
	//Inserindo o nome
	$nome = $membro->getNomeMembro();
	$pdf->SetFont('Arial','B',25);
	$pdf->SetXY(0, 92);
	$pdf->Cell(0,0,$nome,0,1,'C');
	
	$pdf->SetFont('Arial','B',16);
	//Inserindo data de Admissão
	$data = explode("-",$membro->getAdmissao());
	$pdf->Text(54,123, $data[2]);
	$pdf->Text(68,123, $data[1]);
	$pdf->Text(84,123, $data[0]);
	$inicio = mktime(0,0,0, $data[1],$data[2],$data[0]);
	
	//Inserindo data de Demissão
	$data = explode("-",$membro->getDemissao());
	$pdf->Text(111,123, $data[2]);
	$pdf->Text(126,123, $data[1]);
	$pdf->Text(142,123, $data[0]);
	$final = mktime(0,0,0, $data[1],$data[2],$data[0]);
	
	//Data de Emissão
	$data = explode("-",date('Y-m-d'));
	$pdf->Text(141,152, $data[2]);
	$pdf->Text(165,152, Util::retornaMes($data[1]));
	$pdf->Text(220,152, $data[0]);
	
	//Calculando dias trabalhados
	$diff = $final - $inicio;
	$dias = (int)floor( $diff / (60 * 60 * 24));
	$fator = $dias / 180;
	$horas = floor(60 * $fator);
	$pdf->Text(233,123, $horas);
	
	//Código de Validação
	switch(strlen($membro->getCodMembro())){
		case 1:
			$id = "000".$membro->getCodMembro();
			break;
		case 2:
			$id = "00".$membro->getCodMembro();
			break;
		case 3:
			$id = "0".$membro->getCodMembro();
			break;
	}
	$cod = date('Y').$id;
	$pdf->SetFont('Arial','',16);
	$pdf->Text(35,197, $cod);
	
	//Marca D'água
	$pdf -> SetFont('Arial','',8);
	$pdf -> Text(245,208,'Gerado eletronicamente por EasyCad');
	
	//Fundo
	$imgFrente = "imgCert/fundo_membro.png";
	if(file_exists($imgFrente)){
		$pdf->Image($imgFrente,null,null,297,210);
	} else {
		Util::alert('Falha na configuração do certificado de Membros');
		return null;
	}
	
	$vinculos = $membro->getVinculo();
	$i = 0;
	foreach($vinculos as $v){
		$pdf -> SetFont('Arial','',20);
		$pdf->Text(25,76+($i*8), $v->getFuncao()." - Entre ".Util::arrumaData($v->getDataAdmissao())." e ".Util::arrumaData($v->getDataDemissao()));
		$i++;
	}
	
	//Código no fundo
	$pdf->SetFont('Arial','',16);
	$pdf->Text(35,197, $cod);
	
	//Marca D'água
	$pdf -> SetFont('Arial','',8);
	$pdf -> Text(245,208,'Gerado eletronicamente por EasyCad');
	
	//Atualizando no BD
	$membro->setValidacaoCert($cod);
	$membro->setEmissaoCert(date('Y-m-d'));
	if($membro->emitirCert()){
		$pdf->Output();
	}	
?>