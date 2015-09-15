<?php
	require_once 'gerencia_login.php';
	
	$e = new Evento();
	$e->setIdEvento($_GET['id']);
	$evento = $e->retornaEventoPorId();
	
	$a = array();
	$a['idEvento'] = $evento->getIdEvento();
	$a['nome'] = utf8_encode($evento->getNomeEvento());
	$a['inicio'] = $evento->getDataInicio();
	$a['fim'] = $evento->getDateFim();
	$a['modalidade'] = $evento->getModalidade();
	$a['valor'] = $evento->getValor();
	$a['ch'] = $evento->getCargaHoraria();
	$a['geraCert'] = $evento->getGeraCertificado();
	
	//$array[] = $a;
	
	echo json_encode($a);