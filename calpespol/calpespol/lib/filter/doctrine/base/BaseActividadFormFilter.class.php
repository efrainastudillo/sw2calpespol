<?php

/**
 * Actividad filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActividadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_categoria'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categoria'), 'add_empty' => true)),
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_calificacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipocalificacion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_categoria'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categoria'), 'column' => 'id')),
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'fecha'                => new sfValidatorPass(array('required' => false)),
      'id_tipo_calificacion' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipocalificacion'), 'column' => 'id')),
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
      'id'                   => 'Number',
      'id_categoria'         => 'ForeignKey',
      'nombre'               => 'Text',
      'fecha'                => 'Text',
      'id_tipo_calificacion' => 'ForeignKey',
    );
  }
}
