<?php
require_once 'gerencia_login.php';

$idEvento = $_GET['id'];

$e = new Evento();
$e->setIdEvento($idEvento);
$evento = $e->retornaEventoPorId();
$array = array();
$i = 0;
foreach($evento->getCurso() as $c){
	$array[$i]['id'] = $c->getIdCurso();
	$array[$i]['nome'] = $c->getNomeCurso();
	$i++;
}

echo json_encode($array);