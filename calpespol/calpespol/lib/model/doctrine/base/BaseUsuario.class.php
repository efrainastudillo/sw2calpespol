<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Usuario', 'doctrine');

/**
 * BaseUsuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $id
 * @property string $nombre
 * @property string $mail
 * @property integer $id_rol
 * @property Rolusuario $Rolusuario
 * @property Doctrine_Collection $Asistencia
 * @property Doctrine_Collection $Ayudantecurso
 * @property Doctrine_Collection $Estudiantecurso
 * @property Doctrine_Collection $Calificacion
 * @property Doctrine_Collection $Curso
 * 
 * @method string              getId()              Returns the current record's "id" value
 * @method string              getNombre()          Returns the current record's "nombre" value
 * @method string              getMail()            Returns the current record's "mail" value
 * @method integer             getIdRol()           Returns the current record's "id_rol" value
 * @method Rolusuario          getRolusuario()      Returns the current record's "Rolusuario" value
 * @method Doctrine_Collection getAsistencia()      Returns the current record's "Asistencia" collection
 * @method Doctrine_Collection getAyudantecurso()   Returns the current record's "Ayudantecurso" collection
 * @method Doctrine_Collection getEstudiantecurso() Returns the current record's "Estudiantecurso" collection
 * @method Doctrine_Collection getCalificacion()    Returns the current record's "Calificacion" collection
 * @method Doctrine_Collection getCurso()           Returns the current record's "Curso" collection
 * @method Usuario             setId()              Sets the current record's "id" value
 * @method Usuario             setNombre()          Sets the current record's "nombre" value
 * @method Usuario             setMail()            Sets the current record's "mail" value
 * @method Usuario             setIdRol()           Sets the current record's "id_rol" value
 * @method Usuario             setRolusuario()      Sets the current record's "Rolusuario" value
 * @method Usuario             setAsistencia()      Sets the current record's "Asistencia" collection
 * @method Usuario             setAyudantecurso()   Sets the current record's "Ayudantecurso" collection
 * @method Usuario             setEstudiantecurso() Sets the current record's "Estudiantecurso" collection
 * @method Usuario             setCalificacion()    Sets the current record's "Calificacion" collection
 * @method Usuario             setCurso()           Sets the current record's "Curso" collection
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     ABEJJA
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsuario extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('usuario');
        $this->hasColumn('id', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('mail', 'string', 50, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 50,
             ));
        $this->hasColumn('id_rol', 'integer', 4, array(
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
        $this->hasOne('Rolusuario', array(
             'local' => 'id_rol',
             'foreign' => 'id'));

        $this->hasMany('Asistencia', array(
             'local' => 'id',
             'foreign' => 'id_usuario'));

        $this->hasMany('Ayudantecurso', array(
             'local' => 'id',
             'foreign' => 'id_usuario'));

        $this->hasMany('Estudiantecurso', array(
             'local' => 'id',
             'foreign' => 'id_usuario'));

        $this->hasMany('Calificacion', array(
             'local' => 'id',
             'foreign' => 'id_usuario'));

        $this->hasMany('Curso', array(
             'local' => 'id',
             'foreign' => 'profesor'));
    }
}