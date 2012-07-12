<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Materia', 'doctrine');

/**
 * BaseMateria
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idmateria
 * @property string $nombre
 * @property string $codigo_materia
 * @property Doctrine_Collection $Curso
 * 
 * @method integer             getIdmateria()      Returns the current record's "idmateria" value
 * @method string              getNombre()         Returns the current record's "nombre" value
 * @method string              getCodigoMateria()  Returns the current record's "codigo_materia" value
 * @method Doctrine_Collection getCurso()          Returns the current record's "Curso" collection
 * @method Materia             setIdmateria()      Sets the current record's "idmateria" value
 * @method Materia             setNombre()         Sets the current record's "nombre" value
 * @method Materia             setCodigoMateria()  Sets the current record's "codigo_materia" value
 * @method Materia             setCurso()          Sets the current record's "Curso" collection
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMateria extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('materia');
        $this->hasColumn('idmateria', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('codigo_materia', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Curso', array(
             'local' => 'idmateria',
             'foreign' => 'id_materia'));
    }
}