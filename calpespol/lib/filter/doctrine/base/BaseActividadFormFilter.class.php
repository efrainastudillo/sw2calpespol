<?php

/**
 * Actividad filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActividadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_entrega'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nota'              => new sfWidgetFormFilterInput(),
      'id_tipo_actividad' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipoactividad'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'            => new sfValidatorPass(array('required' => false)),
      'fecha_entrega'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'nota'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tipo_actividad' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipoactividad'), 'column' => 'idtipoactividad')),
    ));

    $this->widgetSchema->setNameFormat('actividad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actividad';
  }

  public function getFields()
  {
    return array(
      'idactividad'       => 'Number',
      'nombre'            => 'Text',
      'fecha_entrega'     => 'Date',
      'nota'              => 'Number',
      'id_tipo_actividad' => 'ForeignKey',
    );
  }
}
