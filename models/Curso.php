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
	public function getLocal() {
		return $this->local;
	}
	public function setLocal($local) {
		$this->local = $local;
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
	public function getDataInicio() {
		return $this->dataInicio;
	}
	public function setDataInicio($dataInicio) {
		$this->dataInicio = $dataInicio;
		return $this;
	}
	public function getDataFim() {
		return $this->dataFim;
	}
	public function setDataFim($dataFim) {
		$this->dataFim = $dataFim;
		return $this;
	}
	public function getCorTexto() {
		return $this->corTexto;
	}
	public function setCorTexto($corTexto) {
		$this->corTexto = $corTexto;
		return $this;
	}
	public function getLayout() {
		return $this->layout;
	}
	public function setLayout($layout) {
		$this->layout = $layout;
		return $this;
	}
	public function getVerso() {
		return $this->verso;
	}
	public function setVerso($verso) {
		$this->verso = $verso;
		return $this;
	}
	public function getLiberarCertificado() {
		return $this->liberarCertificado;
	}
	public function setLiberarCertificado($liberarCertificado) {
		$this->liberarCertificado = $liberarCertificado;
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
	
	public function inserirCurso(){
		try{
			$this->save();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarCursoPorId(){
		try{
			return $this->getTable()->findOneBy('idCurso', $this->getIdCurso());
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function alterarCurso(){
		try{
			$tmp = $this->copy();
			$c = $this->getTable()->findOneBy('idCurso', $this->getIdCurso());
			if($c){
				if(!is_null($tmp->getCorTexto())){
					$c->setCorTexto($tmp->getCorTexto());
				}
				if(!is_null($tmp->getLayout())){
					$c->setLayout($tmp->getLayout());
				}
				if(!is_null($tmp->getVerso())){
					$c->setVerso($tmp->getVerso());
				}
				$c->save();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function retornarAlunosOrdenados(){
		try{
			$tb = Doctrine_Core::getTable('Entidade')->createQuery()
									->select('e.nomeEntidade, e.cnpj_cpf')
									->from('Entidade e, Matricula m')
									->where('e.idEntidade = m.idEntidade')
									->andWhere('m.idCurso = '.$this->getIdCurso())
									->orderBy('e.nomeEntidade');
			//echo $tb->getSqlQuery();
			$r = $tb->execute();
			return $r;									
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}