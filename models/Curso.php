<?php

/**
 * Curso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Curso extends BaseCurso
{
	public function getIdCurso() {
		return $this->idCurso;
	}
	public function setIdCurso($idCurso) {
		$this->idCurso = $idCurso;
		return $this;
	}
	public function getIdEvento() {
		return $this->idEvento;
	}
	public function setIdEvento($idEvento) {
		$this->idEvento = $idEvento;
		return $this;
	}
	public function getNomeCurso() {
		return $this->nomeCurso;
	}
	public function setNomeCurso($nomeCurso) {
		$this->nomeCurso = $nomeCurso;
		return $this;
	}
	public function getConteudo() {
		return $this->conteudo;
	}
	public function setConteudo($conteudo) {
		$this->conteudo = $conteudo;
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
	public function getDataCurso() {
		return $this->dataCurso;
	}
	public function setDataCurso($dataCurso) {
		$this->dataCurso = $dataCurso;
		return $this;
	}
	public function getEvento() {
		return $this->Evento;
	}
	public function setEvento($Evento) {
		$this->Evento = $Evento;
		return $this;
	}
	public function getMatricula() {
		return $this->Matricula;
	}
	public function setMatricula($Matricula) {
		$this->Matricula = $Matricula;
		return $this;
	}
}