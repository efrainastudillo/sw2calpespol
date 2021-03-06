<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Curso', 'doctrine');

/**
 * BaseCurso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idcurso
 * @property integer $paralelo
 * @property integer $anio
 * @property integer $termino
 * @property integer $id_materia
 * @property Materia $Materia
 * @property Doctrine_Collection $Tipoactividad
 * @property Doctrine_Collection $UsuarioCurso
 * 
 * @method integer             getIdcurso()       Returns the current record's "idcurso" value
 * @method integer             getParalelo()      Returns the current record's "paralelo" value
 * @method integer             getAnio()          Returns the current record's "anio" value
 * @method integer             getTermino()       Returns the current record's "termino" value
 * @method integer             getIdMateria()     Returns the current record's "id_materia" value
 * @method Materia             getMateria()       Returns the current record's "Materia" value
 * @method Doctrine_Collection getTipoactividad() Returns the current record's "Tipoactividad" collection
 * @method Doctrine_Collection getUsuarioCurso()  Returns the current record's "UsuarioCurso" collection
 * @method Curso               setIdcurso()       Sets the current record's "idcurso" value
 * @method Curso               setParalelo()      Sets the current record's "paralelo" value
 * @method Curso               setAnio()          Sets the current record's "anio" value
 * @method Curso               setTermino()       Sets the current record's "termino" value
 * @method Curso               setIdMateria()     Sets the current record's "id_materia" value
 * @method Curso               setMateria()       Sets the current record's "Materia" value
 * @method Curso               setTipoactividad() Sets the current record's "Tipoactividad" collection
 * @method Curso               setUsuarioCurso()  Sets the current record's "UsuarioCurso" collection
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCurso extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('curso');
        $this->hasColumn('idcurso', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('paralelo', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('anio', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('termino', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_materia', 'integer', 4, array(
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
        $this->hasOne('Materia', array(
             'local' => 'id_materia',
             'foreign' => 'idmateria',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Tipoactividad', array(
             'local' => 'idcurso',
             'foreign' => 'id_curso'));

        $this->hasMany('UsuarioCurso', array(
             'local' => 'idcurso',
             'foreign' => 'id_curso'));
    }
}