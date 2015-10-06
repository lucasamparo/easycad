<?php

/**
 * BaseEvento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idEvento
 * @property string $nomeEvento
 * @property date $dataInicio
 * @property date $dateFim
 * @property enum $modalidade
 * @property float $valor
 * @property integer $cargaHoraria
 * @property enum $ativo
 * @property string $corTexto
 * @property enum $layout
 * @property enum $verso
 * @property enum $geraCertificado
 * @property enum $liberarCertificado
 * @property Doctrine_Collection $Curso
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEvento extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('evento');
        $this->hasColumn('idEvento', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('nomeEvento', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('dataInicio', 'date', null, array(
             'type' => 'date',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('dateFim', 'date', null, array(
             'type' => 'date',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('modalidade', 'enum', 2, array(
             'type' => 'enum',
             'length' => 2,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'P',
              1 => 'O',
              2 => 'PO',
              3 => 'N',
             ),
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('valor', 'float', null, array(
             'type' => 'float',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('cargaHoraria', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ativo', 'enum', 1, array(
             'type' => 'enum',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'S',
              1 => 'N',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('corTexto', 'string', 7, array(
             'type' => 'string',
             'length' => 7,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('layout', 'enum', 1, array(
             'type' => 'enum',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => '1',
              1 => '2',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('verso', 'enum', 1, array(
             'type' => 'enum',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'S',
              1 => 'N',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('geraCertificado', 'enum', 1, array(
             'type' => 'enum',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'S',
              1 => 'N',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('liberarCertificado', 'enum', 1, array(
             'type' => 'enum',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'S',
              1 => 'N',
             ),
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Curso', array(
             'local' => 'idEvento',
             'foreign' => 'idEvento'));
    }
}