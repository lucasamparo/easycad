<?php
require_once 'gerencia_login.php';

$idCurso = $_GET['id'];

$c = new Curso();
$c->setIdCurso($idCurso);
$curso = $c->retornarCursoPorId();
$array = array();
$array['id'] = $curso->getIdCurso();
$array['nome'] = utf8_encode($curso->getNomeCurso());
$array['idEvento'] = $curso->getEvento()->getIdEvento();
$array['local'] = utf8_encode($curso->getLocal());
$array['conteudo'] = utf8_encode($curso->getConteudo());
$array['valor'] = $curso->getValor();
$array['ch'] = $curso->getCargaHoraria();
$array['dataInicio'] = $curso->getDataInicio();
$array['dataFim'] = $curso->getDataFim();

echo json_encode($array);