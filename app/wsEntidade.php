<?php
require_once 'gerencia_login.php';

$e = new Entidade();
if(isset($_GET['id'])){
	$idEntidade = $_GET['id'];
	$e->setIdEntidade($idEntidade);
	$ent = $e->retornarEntidadePorId();
}
if(isset($_GET['c'])){
	$cpf = $_GET['c'];
	$e->setCnpjCpf($cpf);
	$ent = $e->retornarEntidadePorCnpjCpf();
}

if(count($ent) > 1){
	$array['nome'] = utf8_encode($ent->getNomeEntidade());
	$array['id'] = $ent->getIdEntidade();
	$array['telefone'] = $ent->getTelefone();
	$array['email'] = $ent->getEmail();
	$array['flag'] = true;
} else {
	$array['flag'] = false;
}

ob_end_clean();
echo json_encode($array);