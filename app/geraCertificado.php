<?php
	require_once('../models/bootstrap.php');
	require_once('../libs/fpdf/fpdf.php');
	
	function constroiPdf(Matricula $m){
		$url = "";
		//Iniciado o PDF
		$pdf = new FPDF('L','mm','A4');
		$pdf->Open();
		$pdf->SetMargins(0, 0, 0);
		$pdf->SetTextColor($m->getCurso()->getCorTexto());
		//Colocando o fundo
		$imgFrente = "imgCert/c_".$m->getCurso()->getIdCurso().md5($m->getCurso()->getNomeCurso())."_frente.png";
		if(file_exists($imgFrente)){
			$pdf->Image($imgFrente,null,null,297,210);
		} else {
			Util::alert('Falha na configuração do certificado do curso '.$m->getCurso()->getNomeCurso());
			return null;
		}
		//Carregando o layout
		if($m->getCurso()->getLayout() == '1'){
			//Trabalha com o layout1
			if($m->getCurso()->getDataFim() == '0000-00-00'){
				//trabalha com data simples
				//Inserindo data
				$pdf -> SetFont('Arial','',20);
				$d = $m->getCurso()->getDataInicio();
				$data = explode("-",$d);
				/*$pdf->Text(193, 171, $data[2]);
				$pdf->Text(215, 171, Util::retornaMes(intval($data[1])));
				$pdf->Text(270, 171, substr($data[0],2,2));*/
				$pdf->Text(193, 171, $data[2]." de ".Util::retornaMes(intval($data[1]))." de ".$data[0]);
			} else {
				//trabalha com data dupla
			}
			//Inserindo Nome do Evento
			$evento = $m->getCurso()->getEvento()->getNomeEvento();
			//Util::alert($evento);
			$pdf->SetFont('Arial','B',40);
			$pdf->SetXY(0, 40);
			$pdf->Cell(0,0,$evento,0,1,'C');
			
			//Inserindo nome do Participante
			$nome = $m->getEntidade()->getNomeEntidade();
			$pdf->SetFont('Arial','B',25);
			$pdf->SetXY(0, 65);
			$pdf->Cell(0,0,$nome,0,1,'C');
			
			//Inserindo codificação
			$c = new Certificado();
			$count = $c->contarCertificadosPorIdCuros($m->getCurso()->getIdCurso());
			switch(strlen($count[0])){
				case 1:
					$ct = "000".$count[0];
					break;
				case 2:
					$ct = "00".$count[0];
					break;
				case 3:
					$ct = "0".$count[0];
					break;
				case 4:
					$ct = $count[0];
					break;
			}
			$cod = date('Y').$m->getCurso()->getIdCurso()."-".$ct;
			$pdf -> SetFont('Arial','',8);
			$pdf->Text(200, 20, $cod);
			
			$pdf -> SetFont('Arial','',8);
			$pdf -> Text(235,196,'Gerado eletronicamente por EasyCad');
		} else {
			//Trabalha com o layout2
			if($m->getCurso()->getDataFim() == '0000-00-00'){
				//trabalha com data simples
			} else {
				//trabalha com data dupla
			}
		}
		
		
		
		$url = "cert/".$m->getCurso()->getIdCurso()."_".$m->getEntidade()->getIdEntidade().".pdf";
		$pdf->Output();
		//$pdf->Output($url);
		return $url;
	}
	
	if(!isset($_POST['cpf'])){
		echo '<form method="post" action="geraCertificado.php">';
			echo '<label>CPF:</label>';
			echo '<input type="text" name="cpf">';
			echo '<input type="submit" value="Gerar Certificado">';
		echo '</form>';
	} else {
		//Carregando dados para o certificado
		//Precisa layout, cor da fonte, imagem de fundo, nome do curso, nome do aluno
		$m = new Matricula();
		$u = new Entidade();
		$u->setCnpjCpf($_POST['cpf']);
		$ent = $u->retornarEntidadePorCnpjCpf();
		//print_r($ent->toArray());
		$m->setIdEntidade($ent->getIdEntidade());
		$mat = $m->retornarMatriculaPorIdParticipante();
		//print_r($mat->toArray());
		foreach($mat as $m){
			if($m->getCurso()->getLiberarCertificado() == 'S'){
				$r = constroiPdf($m);
				//echo $m->getCurso()->getNomeCurso().' -> <a href="'.$r.'" target="_blank">Certificado</a>';
			}			
		}
		
		//Início do PDF
	}
?>