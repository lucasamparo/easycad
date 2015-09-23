<?php

/**
 * Evento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Evento extends BaseEvento
{
	public function getIdEvento() {
		return $this->idEvento;
	}
	public function setIdEvento($idEvento) {
		$this->idEvento = $idEvento;
		return $this;
	}
	public function getNomeEvento() {
		return $this->nomeEvento;
	}
	public function setNomeEvento($nomeEvento) {
		$this->nomeEvento = $nomeEvento;
		return $this;
	}
	public function getDataInicio() {
		return $this->dataInicio;
	}
	public function setDataInicio($dataInicio) {
		$this->dataInicio = $dataInicio;
		return $this;
	}
	public function getDateFim() {
		return $this->dateFim;
	}
	public function setDateFim($dateFim) {
		$this->dateFim = $dateFim;
		return $this;
	}
	public function getModalidade() {
		return $this->modalidade;
	}
	public function setModalidade($modalidade) {
		$this->modalidade = $modalidade;
		return $this;
	}
	public function getValor() {
		return $this->valor;
	}
	public function setValor($valor) {
		$this->valor = $valor;
		return $this;
	}
	public function getCargaHoraria() {
		return $this->cargaHoraria;
	}
	public function setCargaHoraria($cargaHoraria) {
		$this->cargaHoraria = $cargaHoraria;
		return $this;
	}
	public function getGeraCertificado() {
		return $this->geraCertificado;
	}
	public function setGeraCertificado($geraCertificado) {
		$this->geraCertificado = $geraCertificado;
		return $this;
	}
	public function getLiberarCertificado() {
		return $this->liberarCertificado;
	}
	public function setLiberarCertificado($liberarCertificado) {
		$this->liberarCertificado = $liberarCertificado;
		return $this;
	}
	public function getCurso() {
		return $this->Curso;
	}
	public function setCurso($Curso) {
		$this->Curso = $Curso;
		return $this;
	}
	
	public function inserirEvento(){
		try{
			$this->save();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarEventos(){
		try{
			return $this->getTable()->findAll();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornaEventoPorId(){
		try{
			return $this->getTable()->findOneBy('idEvento', $this->getIdEvento());
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function alterarEvento(){
		try{
			$tmp = $this->copy();
			$e = $this->getTable()->findOneBy('idEvento', $this->getIdEvento());
			if($e){
				if(!is_null($tmp->getNomeEvento())){
					$e->setNomeEvento($tmp->getNomeEvento());
				}
				if(!is_null($tmp->getDataInicio())){
					$e->setDataInicio($tmp->getDataInicio());
				}
				if(!is_null($tmp->getDateFim())){
					$e->setDateFim($tmp->getDateFim());
				}
				if(!is_null($tmp->getModalidade())){
					$e->setModalidade($tmp->getModalidade());
				}
				if(!is_null($tmp->getValor())){
					$e->setValor($tmp->getValor());
				}
				if(!is_null($tmp->getCargaHoraria())){
					$e->setCargaHoraria($tmp->getCargaHoraria());
				}
				if(!is_null($tmp->getGeraCertificado())){
					$e->setGeraCertificado($tmp->getGeraCertificado());
				}
				$e->save();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}