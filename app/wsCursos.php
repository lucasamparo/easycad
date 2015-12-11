<?php
require_once('../models/bootstrap.php');

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

ob_end_clean();
echo json_encode($array);