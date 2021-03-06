<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Grupo', 'doctrine');

/**
 * BaseGrupo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idgrupo
 * @property integer $numero
 * @property string $nombre
 * @property Doctrine_Collection $Estudiantegrupo
 * 
 * @method integer             getIdgrupo()         Returns the current record's "idgrupo" value
 * @method integer             getNumero()          Returns the current record's "numero" value
 * @method string              getNombre()          Returns the current record's "nombre" value
 * @method Doctrine_Collection getEstudiantegrupo() Returns the current record's "Estudiantegrupo" collection
 * @method Grupo               setIdgrupo()         Sets the current record's "idgrupo" value
 * @method Grupo               setNumero()          Sets the current record's "numero" value
 * @method Grupo               setNombre()          Sets the current record's "nombre" value
 * @method Grupo               setEstudiantegrupo() Sets the current record's "Estudiantegrupo" collection
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGrupo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('grupo');
        $this->hasColumn('idgrupo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'Grupo Anonimo',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Estudiantegrupo', array(
             'local' => 'idgrupo',
             'foreign' => 'idgrupo',
             'onDelete' => 'CASCADE'));
    }
}