<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Materia', 'doctrine');

/**
 * BaseMateria
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $id_codigo
 * @property string $nombre
 * @property Doctrine_Collection $Curso
 * 
 * @method string              getIdCodigo()  Returns the current record's "id_codigo" value
 * @method string              getNombre()    Returns the current record's "nombre" value
 * @method Doctrine_Collection getCurso()     Returns the current record's "Curso" collection
 * @method Materia             setIdCodigo()  Sets the current record's "id_codigo" value
 * @method Materia             setNombre()    Sets the current record's "nombre" value
 * @method Materia             setCurso()     Sets the current record's "Curso" collection
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     ABEJJA
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMateria extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('materia');
        $this->hasColumn('id_codigo', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('nombre', 'string', 400, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 400,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Curso', array(
             'local' => 'id_codigo',
             'foreign' => 'id_materia'));
    }
}