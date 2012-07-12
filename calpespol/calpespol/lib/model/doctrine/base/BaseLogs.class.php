<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Logs', 'doctrine');

/**
 * BaseLogs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_estudiante
 * @property integer $id_item
 * @property integer $id_usuario
 * @property float $nota_anterior
 * @property float $nota_nueva
 * @property TIMESTAMP $fecha
 * 
 * @method integer   getIdEstudiante()  Returns the current record's "id_estudiante" value
 * @method integer   getIdItem()        Returns the current record's "id_item" value
 * @method integer   getIdUsuario()     Returns the current record's "id_usuario" value
 * @method float     getNotaAnterior()  Returns the current record's "nota_anterior" value
 * @method float     getNotaNueva()     Returns the current record's "nota_nueva" value
 * @method TIMESTAMP getFecha()         Returns the current record's "fecha" value
 * @method Logs      setIdEstudiante()  Sets the current record's "id_estudiante" value
 * @method Logs      setIdItem()        Sets the current record's "id_item" value
 * @method Logs      setIdUsuario()     Sets the current record's "id_usuario" value
 * @method Logs      setNotaAnterior()  Sets the current record's "nota_anterior" value
 * @method Logs      setNotaNueva()     Sets the current record's "nota_nueva" value
 * @method Logs      setFecha()         Sets the current record's "fecha" value
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     ABEJJA
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLogs extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('logs');
        $this->hasColumn('id_estudiante', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_item', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_usuario', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('nota_anterior', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('nota_nueva', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('fecha', 'TIMESTAMP', null, array(
             'type' => 'TIMESTAMP',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}