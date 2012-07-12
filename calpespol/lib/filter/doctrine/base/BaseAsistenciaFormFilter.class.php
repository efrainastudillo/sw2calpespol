<?php

/**
 * Asistencia filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsistenciaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'id_tipo_asistencia' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipoasistencia'), 'add_empty' => true)),
      'id_estudiante'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioCurso'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_tipo_asistencia' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipoasistencia'), 'column' => 'idtipoasistencia')),
      'id_estudiante'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UsuarioCurso'), 'column' => 'id_usuario_curso')),
    ));

    $this->widgetSchema->setNameFormat('asistencia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asistencia';
  }

  public function getFields()
  {
    return array(
      'idasistencia'       => 'Number',
      'fecha'              => 'Date',
      'id_tipo_asistencia' => 'ForeignKey',
      'id_estudiante'      => 'ForeignKey',
    );
  }
}
