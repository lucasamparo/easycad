<?php

/**
 * Vinculo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Vinculo extends BaseVinculo
{
	public function getIdVinculo() {
		return $this->idVinculo;
	}
	public function setIdVinculo($idVinculo) {
		$this->idVinculo = $idVinculo;
		return $this;
	}
	public function getCodMembro() {
		return $this->codMembro;
	}
	public function setCodMembro($codMembro) {
		$this->codMembro = $codMembro;
		return $this;
	}
	public function getFuncao() {
		return $this->funcao;
	}
	public function setFuncao($funcao) {
		$this->funcao = $funcao;
		return $this;
	}
	public function getDataAdmissao() {
		return $this->dataAdmissao;
	}
	public function setDataAdmissao($dataAdmissao) {
		$this->dataAdmissao = $dataAdmissao;
		return $this;
	}
	public function getDataDemissao() {
		return $this->dataDemissao;
	}
	public function setDataDemissao($dataDemissao) {
		$this->dataDemissao = $dataDemissao;
		return $this;
	}
	public function getMembros() {
		return $this->Membros;
	}
	public function setMembros($Membros) {
		$this->Membros = $Membros;
		return $this;
	}
	
	public function inserirVinculo(){
		try{
			$this->save();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarVinculoPorId(){
		try{
			return $this->getTable()->findOneBy('idVinculo', $this->getIdVinculo());
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function terminarCiclo(){
		try{
			$v = $this->getTable()->findOneBy('idVinculo', $this->getIdVinculo());
			if($v){
				$v->setDataDemissao(date('Y-m-d'));
				$v->save();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function atualizarVinculo(){
		try{
			$tmp = $this->copy();
			$v = $this->getTable()->findOneBy('idVinculo', $this->getIdVinculo());
			if($v){
				if(!is_null($tmp->getFuncao())){
					$v->setFuncao($tmp->getFuncao());
				}
				if(!is_null($tmp->getDataAdmissao())){
					$v->setDataAdmissao($tmp->getDataAdmissao());
				}
				if(!is_null($tmp->getDataDemissao())){
					$v->setDataDemissao($tmp->getDataDemissao());
				}
				$v->save();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}