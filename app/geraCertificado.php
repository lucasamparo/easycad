<?php
	require_once('../models/bootstrap.php');
	require_once('../libs/fpdf/fpdf.php');
	
	function constroiPdf(Matricula $m){
		$url = "";
		//Iniciado o PDF
		$pdf = new FPDF('L','mm','A4');
		$pdf->Open();
		$pdf->SetMargins(0, 0, 0);
		$cor = $m->getCurso()->getCorTexto();
		$cor = str_replace("#","",$cor);
		$r = hexdec($cor[0].$cor[1]);
		$g = hexdec($cor[2].$cor[3]);
		$b = hexdec($cor[4].$cor[5]);
		$pdf->SetTextColor($r,$g,$b);
		//Colocando o fundo
		$imgFrente = "imgCert/c_".$m->getCurso()->getIdCurso().md5($m->getCurso()->getNomeCurso())."_frente.png";
		if(file_exists($imgFrente)){
			$pdf->Image($imgFrente,null,null,297,210);
		} else {
			Util::alert('Falha na configuração do certificado do curso '.$m->getCurso()->getNomeCurso());
			return null;
		}
		/*if(is_null($m->getCurso()->getDataFim())){
			//trabalha com data simples
			//Inserindo data
			$pdf -> SetFont('Arial','',20);
			$d = $m->getCurso()->getDataInicio();
			$data = explode("-",$d);
			$pdf->Text(220, 171, $data[2]." de ".Util::retornaMes(intval($data[1]))." de ".$data[0]);
		} else {
			//trabalha com data dupla
			$pdf -> SetFont('Arial','',20);
			$d = $m->getCurso()->getDataInicio();
			$data1 = explode("-",$d);
			$d = $m->getCurso()->getDataFim();
			$data2 = explode("-",$d);
			$txt = $data1[2]." de ".Util::retornaMes(intval($data1[1]))." de ".$data1[0].utf8_decode(" até ").$data2[2]." de ".Util::retornaMes(intval($data2[1]))." de ".$data2[0];
			$pdf->Text(130, 171, $txt);
		}*/
		//Carregando o layout
		if($m->getCurso()->getLayout() == '1'){
			
			//Inserindo nome do Participante
			$nome = utf8_decode($m->getEntidade()->getNomeEntidade());
			$pdf->SetFont('Arial','B',25);
			$pdf->SetXY(0, 92);
			$pdf->Cell(0,0,$nome,0,1,'C');
		}
		//Inserindo codificação
		$c = new Certificado();
		$count = $c->contarCertificadosPorIdCurso($m->getCurso()->getIdCurso());
		//print_r($count->toArray());
		switch(strlen($count[0])){
			case 1:
				$ct = "000".($count[0]->COUNT);
				break;
			case 2:
				$ct = "00".($count[0]->COUNT);
				break;
			case 3:
				$ct = "0".($count[0]->COUNT);
				break;
			case 4:
				$ct = intVal($count[0]->COUNT);
				break;
		}
		switch(strlen($m->getCurso()->getIdCurso())){
			case 1:
				$idc = "00".$m->getCurso()->getIdCurso();
				break;
			case 2:
				$idc = "0".$m->getCurso()->getIdCurso();
				break;
			case 3:
				$idc = $m->getCurso()->getIdCurso();
				break;
		}
		$cod = date('Y')."-".$idc.$ct;
		$pdf -> SetFont('Arial','',10);
		$pdf->Text(9, 198, $cod);
		
		$pdf -> SetFont('Arial','',8);
		$pdf -> Text(245,208,'Gerado eletronicamente por EasyCad');
		
		//Inserindo o verso
		if($m->getCurso()->getVerso() == 'S'){			
			$imgFundo = "imgCert/c_".$m->getCurso()->getIdCurso().md5($m->getCurso()->getNomeCurso())."_fundo.png";
			if(file_exists($imgFundo)){
				$pdf->Image($imgFundo,null,null,297,210);
			} else {
				Util::alert('Falha na configuração do certificado do curso '.$m->getCurso()->getNomeCurso());
				return null;
			}
			
			//Inserindo código
			$cod = date('Y')."-".$idc.$ct;
			$pdf -> SetFont('Arial','',10);
			$pdf->Text(9, 198, $cod);
			
			//Inserindo o conteúdo programático
			$cont = explode(";",$m->getCurso()->getConteudo());
			$i = 0;
			
			foreach($cont as $c){
				if(($i % 2) == 0){
					$pdf->Text(25, 80+($i*3), utf8_decode(trim($c)));
				} else {
					$pdf->Text(149, 80+(($i-1)*3), utf8_decode(trim($c)));
				}
				$i++;				
			}

			$pdf -> SetFont('Arial','',8);
			$pdf -> Text(245,208,'Gerado eletronicamente por EasyCad');
		}
		
				
		$url = "cert/".$m->getCurso()->getIdCurso()."_".$m->getEntidade()->getIdEntidade().".pdf";
		//$pdf->Output();
		$pdf->Output($url);
		$c1 = new Certificado();
		$c1->setIdMatricula($m->getIdMatricula());
		$c1->excluirCertificado();
		$c = new Certificado();
		$c->setIdMatricula($m->getIdMatricula());
		$c->setCodigo($cod);
		$c->setDataEmissao(date('Y-m-d'));
		$c->inserirCertificado();
		return $url;
	}

	echo '	<link href="css/locastyle.css" rel="stylesheet" type="text/css">
			<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
			
			<script type="text/javascript" language="JScript">
		      	$(document).ready(function (){
		        			
					$("#cpf").mask("999.999.999-99");
				});
		    </script>

		    <script src="js/locastyle.js" type="text/javascript"></script>';

	echo'<div class="col-lg-12 col-xs-12 ls-txt-center">
			<img src="images/easycad.png" width="150" height="60" style="margin-right:20px;">
			<img src="images/eambjr.png" width="150" height="60" style="margin-left:20px;">
		</div>';
	
	if(!isset($_POST['cpf'])){
		echo'<div class="col-lg-12 col-xs-12">';
		echo '<form method="post" class="ls-form ls-form-horizontal row" action="geraCertificado.php">';

		echo '<label class="ls-label col-lg-12 col-xs-12">
                <b class="ls-label-text">CPF:</b>
                <input type="text" name="cpf" id="cpf" class="ls-field" placeholder="CPF" required>
            </label>';

			echo '
			<input type="submit" value="Gerar Certificado" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">';
		echo '</form>';
		echo '</div>';
	} else {
		//Carregando dados para o certificado
		//Precisa layout, cor da fonte, imagem de fundo, nome do curso, nome do aluno
		$m = new Matricula();
		$u = new Entidade();
		$u->setCnpjCpf($_POST['cpf']);
		$ent = $u->retornarEntidadePorCnpjCpf();
	if($ent){
			//print_r($ent->toArray());
			$m->setIdEntidade($ent->getIdEntidade());
			$mat = $m->retornarMatriculaPorIdParticipante();
			echo count($mat);
			if(count($mat) > 0){
				//print_r($mat->toArray());
				$retido = true;
				foreach($mat as $m){
					if($m->getCurso()->getLiberarCertificado() == 'S'){
						$retido = false;
						if($m->getPresenca() == 'P'){
							$r = constroiPdf($m);								
							echo '<div class="ls-txt-center">';
								echo '<p>'.$m->getCurso()->getNomeCurso().' | <a href="'.$r.'" target="_blank">Certificado</a><br></p>';
							echo '</div>';
						} else {
							echo '<div class="ls-txt-center">';
								echo '<p>Participante Ausente!</p>';
							echo '</div>';
						}
					}
				}
				if($retido){
					echo '<div class="ls-txt-center">';
						echo '<p>Certificados ainda não liberados</p>';
					echo '</div>';
				}
			} else {
				echo '<div class="ls-txt-center">';
					echo '<p>Nenhuma Matrícula efetuada para esse participante!</p>';
				echo '</div>';
			}
		} else {
			echo '<div class="ls-txt-center">';
					echo '<p>Participante Não Cadastrado!!</p>';
				echo '</div>';
		}		
	}
?>