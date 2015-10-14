<?php
//require_once('gerencia_login.php');
require_once('../models/bootstrap.php');
require_once('../libs/fpdf/fpdf.php');

if(isset($_GET['id'])){
	$c = new Curso();
	$c->setIdCurso($_GET['id']);
	$curso = $c->retornarCursoPorId();
	$alunos = $curso->retornarAlunosOrdenados();
	
	//Iniciando PDF
	$pdf = new FPDF('P','mm','A4');
	$pdf->Open();
	$pdf->AddPage();
	$pdf->Image('images/easycad.png',30,10,30);
	$pdf->Image('images/eambjr.png',150,10,30);
	$pdf->SetMargins(10, 10, 10);
	$pdf->SetFont('Arial','B',20);
	$pdf->Cell(190,10,utf8_decode("Lista de Presença"),"",1,"C");
	$pdf->SetFont('Arial','B',18);
	$pdf->Cell(190,10,utf8_decode($curso->getNomeCurso()),"B",1,"C");
	$pdf->Ln();
	
	//cabeçalho
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,10,"Aluno","B",0,"L");
	$pdf->Cell(30,10,"CPF","B",0,"R");
	$pdf->Cell(80,10,"Assinatura","B",1,"R");
	
	$pdf->SetFont('Arial','',8);
	foreach($alunos as $a){
		$pdf->Cell(80,10,$a->getNomeEntidade(),"TB",0,"L");
		$pdf->Cell(30,10,$a->getCnpjCpf(),"TB",0,"R");
		$pdf->Cell(80,10,"","TB",1,"R");
	}
	
	$pdf->Output();
} else {
	header('Location: inicio.php');
}