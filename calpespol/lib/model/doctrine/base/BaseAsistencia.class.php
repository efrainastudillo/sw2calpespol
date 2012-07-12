<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Asistencia', 'doctrine');

/**
 * BaseAsistencia
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idasistencia
 * @property timestamp $fecha
 * @property integer $id_tipo_asistencia
 * @property integer $id_estudiante
 * @property Tipoasistencia $Tipoasistencia
 * @property UsuarioCurso $UsuarioCurso
 * 
 * @method integer        getIdasistencia()       Returns the current record's "idasistencia" value
 * @method timestamp      getFecha()              Returns the current record's "fecha" value
 * @method integer        getIdTipoAsistencia()   Returns the current record's "id_tipo_asistencia" value
 * @method integer        getIdEstudiante()       Returns the current record's "id_estudiante" value
 * @method Tipoasistencia getTipoasistencia()     Returns the current record's "Tipoasistencia" value
 * @method UsuarioCurso   getUsuarioCurso()       Returns the current record's "UsuarioCurso" value
 * @method Asistencia     setIdasistencia()       Sets the current record's "idasistencia" value
 * @method Asistencia     setFecha()              Sets the current record's "fecha" value
 * @method Asistencia     setIdTipoAsistencia()   Sets the current record's "id_tipo_asistencia" value
 * @method Asistencia     setIdEstudiante()       Sets the current record's "id_estudiante" value
 * @method Asistencia     setTipoasistencia()     Sets the current record's "Tipoasistencia" value
 * @method Asistencia     setUsuarioCurso()       Sets the current record's "UsuarioCurso" value
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAsistencia extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('asistencia');
        $this->hasColumn('idasistencia', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('fecha', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('id_tipo_asistencia', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('id_estudiante', 'integer', 4, array(
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
        $this->hasOne('Tipoasistencia', array(
             'local' => 'id_tipo_asistencia',
             'foreign' => 'idtipoasistencia'));

        $this->hasOne('UsuarioCurso', array(
             'local' => 'id_estudiante',
             'foreign' => 'id_usuario_curso'));
    }
}