<?php

/**
 * Certificado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Certificado extends BaseCertificado
{
	public function getIdCertificado() {
		return $this->idCertificado;
	}
	public function setIdCertificado($idCertificado) {
		$this->idCertificado = $idCertificado;
		return $this;
	}
	public function getIdEntidade() {
		return $this->idEntidade;
	}
	public function setIdEntidade($idEntidade) {
		$this->idEntidade = $idEntidade;
		return $this;
	}
	public function getCodigo() {
		return $this->codigo;
	}
	public function setCodigo($codigo) {
		$this->codigo = $codigo;
		return $this;
	}
	public function getDataEmissao() {
		return $this->dataEmissao;
	}
	public function setDataEmissao($dataEmissao) {
		$this->dataEmissao = $dataEmissao;
		return $this;
	}
	public function getMatricula() {
		return $this->Matricula;
	}
	public function setMatricula($Matricula) {
		$this->Matricula = $Matricula;
		return $this;
	}
	
	public function inserirCertificado(){
		try{
			$this->save();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function excluirCertificado(){
		try{
			$c = $this->getTable()->findOneBy('codigo', $this->getCodigo());
			if($c){
				$c->delete();
			}
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function contarCertificadosPorIdCuros($idCurso){
		try{
			$tb = Doctrine_Core::getTable('Certificado')->createQuery()
										->select('COUNT(*)')
										->from('Certificado c, Matricula m')
										->where('c.idMatricula = m.idMatricula')
										->andWhere('m.idCurso = '.$idCurso);
			return $tb->execute();
		} catch (Doctrine_Exception $e){
			echo $e->getMessage();
		}
	}
}