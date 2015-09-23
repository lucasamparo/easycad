<?php

/**
 * Empresa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Empresa extends BaseEmpresa
{
	public function getIdEmpresa() {
		return $this->idEmpresa;
	}
	public function setIdEmpresa($idEmpresa) {
		$this->idEmpresa = $idEmpresa;
		return $this;
	}
	public function getNomeFantasia() {
		return $this->nomeFantasia;
	}
	public function setNomeFantasia($nomeFantasia) {
		$this->nomeFantasia = $nomeFantasia;
		return $this;
	}
	public function getRazaoSocial() {
		return $this->razaoSocial;
	}
	public function setRazaoSocial($razaoSocial) {
		$this->razaoSocial = $razaoSocial;
		return $this;
	}
	public function getResponsavel() {
		return $this->responsavel;
	}
	public function setResponsavel($responsavel) {
		$this->responsavel = $responsavel;
		return $this;
	}
	public function getLogin() {
		return $this->login;
	}
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
		return $this;
	}
	public function getCnpj() {
		return $this->cnpj;
	}
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
		return $this;
	}
	
	public function retornarEmpresa(){
		try{
			$e = $this->getTable()->findOneBy('idEmpresa', '1');
			return $e;
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function alterarEmpresa(){
		try{
			$tmp = $this->copy();
			$e = $this->getTable()->findOneBy('idEmpresa', '1');
			if($e){
				if(!is_null($tmp->getNomeFantasia())){
					$e->setNomeFantasia($tmp->getNomeFantasia());
				}
				if(!is_null($tmp->getRazaoSocial())){
					$e->setRazaoSocial($tmp->getRazaoSocial());
				}
				if(!is_null($tmp->getResponsavel())){
					$e->setResponsavel($tmp->getResponsavel());
				}
				if(!is_null($tmp->getCnpj())){
					$e->setCnpj($tmp->getCnpj());
				}
				$e->save();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function alterarSenha($novaSenha){
		try{
			$sql = "Update empresa set senha = '".md5($novaSenha)."' where idEmpresa = 1";
			Doctrine_Core::getTable('Empresa')
						->getConnection()
						->prepare($sql)
						->execute();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}