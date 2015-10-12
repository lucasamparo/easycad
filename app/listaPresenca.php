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
	$pdf->SetMargins(10, 10, 10);
	$pdf->SetFont('Arial','B',20);
	$pdf->Cell(190,10,utf8_decode("Lista de Presença- ".$curso->getNomeCurso()),"B",1,"C");
	$pdf->Ln();
	
	//cabeçalho
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(60,8,"Aluno","B",0,"L");
	$pdf->Cell(30,8,"CPF","LB",0,"L");
	$pdf->Cell(100,8,"Assinatura","LB",1,"L");
	
	$pdf->SetFont('Arial','',12);
	foreach($alunos as $a){
		$pdf->Cell(60,8,$a->getNomeEntidade(),0,0,"L");
		$pdf->Cell(30,8,$a->getCnpjCpf(),0,0,"L");
		$pdf->Cell(100,8,"","B",1,"L");
	}
	
	$pdf->Output();
} else {
	header('Location: inicio.php');
}