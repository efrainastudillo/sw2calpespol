<?php

/**
 * Tipocalificacion filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTipocalificacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detalle' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'  => new sfValidatorPass(array('required' => false)),
      'detalle' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipocalificacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tipocalificacion';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'nombre'  => 'Text',
      'detalle' => 'Text',
    );
  }
}
