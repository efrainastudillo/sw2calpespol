<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Literal', 'doctrine');

/**
 * BaseLiteral
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idliteral
 * @property string $nombre_literal
 * @property decimal $valor_ponderacion
 * @property integer $id_actividad
 * @property Actividad $Actividad
 * @property Doctrine_Collection $Estudianteliteral
 * 
 * @method integer             getIdliteral()         Returns the current record's "idliteral" value
 * @method string              getNombreLiteral()     Returns the current record's "nombre_literal" value
 * @method decimal             getValorPonderacion()  Returns the current record's "valor_ponderacion" value
 * @method integer             getIdActividad()       Returns the current record's "id_actividad" value
 * @method Actividad           getActividad()         Returns the current record's "Actividad" value
 * @method Doctrine_Collection getEstudianteliteral() Returns the current record's "Estudianteliteral" collection
 * @method Literal             setIdliteral()         Sets the current record's "idliteral" value
 * @method Literal             setNombreLiteral()     Sets the current record's "nombre_literal" value
 * @method Literal             setValorPonderacion()  Sets the current record's "valor_ponderacion" value
 * @method Literal             setIdActividad()       Sets the current record's "id_actividad" value
 * @method Literal             setActividad()         Sets the current record's "Actividad" value
 * @method Literal             setEstudianteliteral() Sets the current record's "Estudianteliteral" collection
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLiteral extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('literal');
        $this->hasColumn('idliteral', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('nombre_literal', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 70,
             ));
        $this->hasColumn('valor_ponderacion', 'decimal', 10, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('id_actividad', 'integer', 4, array(
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
        $this->hasOne('Actividad', array(
             'local' => 'id_actividad',
             'foreign' => 'idactividad',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Estudianteliteral', array(
             'local' => 'idliteral',
             'foreign' => 'idliteral'));
    }
}