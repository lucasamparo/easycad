<?php

/**
 * Matricula
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Matricula extends BaseMatricula
{
	public function getIdMatricula() {
		return $this->idMatricula;
	}
	public function setIdMatricula($idMatricula) {
		$this->idMatricula = $idMatricula;
		return $this;
	}
	public function getIdEntidade() {
		return $this->idEntidade;
	}
	public function setIdEntidade($idEntidade) {
		$this->idEntidade = $idEntidade;
		return $this;
	}
	public function getIdCurso() {
		return $this->idCurso;
	}
	public function setIdCurso($idCurso) {
		$this->idCurso = $idCurso;
		return $this;
	}
	public function getPresenca() {
		return $this->presenca;
	}
	public function setPresenca($presenca) {
		$this->presenca = $presenca;
		return $this;
	}
	public function getDataHoraMatricula() {
		return $this->dataHoraMatricula;
	}
	public function setDataHoraMatricula($dataHoraMatricula) {
		$this->dataHoraMatricula = $dataHoraMatricula;
		return $this;
	}
	public function getCurso() {
		return $this->Curso;
	}
	public function setCurso($Curso) {
		$this->Curso = $Curso;
		return $this;
	}
	public function getEntidade() {
		return $this->Entidade;
	}
	public function setEntidade($Entidade) {
		$this->Entidade = $Entidade;
		return $this;
	}
	public function getTipo() {
		return $this->tipo;
	}
	public function setTipo($tipo) {
		$this->tipo = $tipo;
		return $this;
	}
	public function getCertificado() {
		return $this->Certificado;
	}
	public function setCertificado($Certificado) {
		$this->Certificado = $Certificado;
		return $this;
	}
	
	public function inserirMatricula(){
		try{
			$this->save();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarMatriculasPorTipo($tipo){
		try{
			return $this->getTable()->findBy('tipo', $tipo);
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarMatriculaPorIdParticipante(){
		try{
			return $this->getTable()->findBy('idEntidade', $this->getIdEntidade());
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarMatriculaPorIdCurso(){
		try{
			return $this->getTable()->findBy('idCurso', $this->getIdCurso());
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function atualizarMatricula(){
		try{
			$tmp = $this->copy();
			$m = $this->getTable()->findOneBy('idMatricula', $this->getIdMatricula());
			if($m){
				if(!is_null($tmp->getPresenca())){
					$m->setPresenca($tmp->getPresenca());
				}
				$m->save();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}