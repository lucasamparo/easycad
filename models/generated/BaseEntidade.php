<?php

/**
 * BaseEntidade
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idEntidade
 * @property string $nomeEntidade
 * @property string $cnpj_cpf
 * @property string $telefone
 * @property string $email
 * @property enum $tipo
 * @property Doctrine_Collection $Matricula
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEntidade extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('entidade');
        $this->hasColumn('idEntidade', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('nomeEntidade', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('cnpj_cpf', 'string', 18, array(
             'type' => 'string',
             'length' => 18,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('telefone', 'string', 11, array(
             'type' => 'string',
             'length' => 11,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('tipo', 'enum', 2, array(
             'type' => 'enum',
             'length' => 2,
             'fixed' => false,
             'unsigned' => false,
             'values' => 
             array(
              0 => 'PF',
              1 => 'PJ',
             ),
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Matricula', array(
             'local' => 'idEntidade',
             'foreign' => 'idEntidade'));
    }
}