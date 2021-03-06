<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Grupo', 'doctrine');

/**
 * BaseGrupo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_curso
 * @property integer $numero
 * @property Curso $Curso
 * @property Doctrine_Collection $Estudiantecurso
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method integer             getIdCurso()         Returns the current record's "id_curso" value
 * @method integer             getNumero()          Returns the current record's "numero" value
 * @method Curso               getCurso()           Returns the current record's "Curso" value
 * @method Doctrine_Collection getEstudiantecurso() Returns the current record's "Estudiantecurso" collection
 * @method Grupo               setId()              Sets the current record's "id" value
 * @method Grupo               setIdCurso()         Sets the current record's "id_curso" value
 * @method Grupo               setNumero()          Sets the current record's "numero" value
 * @method Grupo               setCurso()           Sets the current record's "Curso" value
 * @method Grupo               setEstudiantecurso() Sets the current record's "Estudiantecurso" collection
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     ABEJJA
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGrupo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('grupo');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('id_curso', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('numero', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Curso', array(
             'local' => 'id_curso',
             'foreign' => 'id'));

        $this->hasMany('Estudiantecurso', array(
             'local' => 'id',
             'foreign' => 'id_grupo'));
    }
}